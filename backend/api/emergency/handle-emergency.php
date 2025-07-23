<?php

session_start();  // Start session to check login info
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Decode input data
$data = json_decode(file_get_contents("php://input"), true);

// Check if coordinates are received
if (!isset($data['latitude']) || !isset($data['longitude'])) {
    echo json_encode([
        "success" => false, 
        "message" => "Missing coordinates",
        "debug" => "No latitude/longitude provided in request"
    ]);
    exit;
}

$latitude = floatval($data['latitude']);
$longitude = floatval($data['longitude']);

// Debug: Log user session info
$debug_info = [
    "session_user_id" => $_SESSION['user_id'] ?? "NOT_SET",
    "session_user_role" => $_SESSION['user_role'] ?? "NOT_SET",
    "coordinates" => ["lat" => $latitude, "lng" => $longitude]
];

// Determine patient_id: get from session if logged in, else null
$patient_id = null;
$user_role = "guest";

if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']);
    $user_role = $_SESSION['user_role'] ?? "unknown";
    
    // Only fetch patient_id if user role is 'patient'
    if ($user_role === 'patient') {
        // Fetch patient_id linked to this user_id
        $patient_stmt = $conn->prepare("SELECT patient_id FROM patients WHERE user_id = ?");
        $patient_stmt->bind_param("i", $user_id);
        $patient_stmt->execute();
        $patient_result = $patient_stmt->get_result();

        if ($patient_result->num_rows > 0) {
            $patient_row = $patient_result->fetch_assoc();
            $patient_id = $patient_row['patient_id'];
            $debug_info["patient_id_found"] = $patient_id;
        } else {
            $debug_info["patient_id_found"] = "NO_PATIENT_RECORD";
        }
        $patient_stmt->close();
    } else {
        $debug_info["patient_id_found"] = "USER_NOT_PATIENT_ROLE";
    }
} else {
    $debug_info["patient_id_found"] = "GUEST_USER_NULL";
}

// Find the nearest ambulance
$query = "
    SELECT team_id, latitude, longitude,
        SQRT(
            POW(69.1 * (latitude - ?), 2) +
            POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)
        ) AS distance
    FROM ambulance_locations
    ORDER BY distance ASC
    LIMIT 1
";

$stmt = $conn->prepare($query);
$stmt->bind_param("dd", $latitude, $longitude);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false, 
        "message" => "No ambulance found in your area",
        "debug" => $debug_info
    ]);
    exit;
}

$ambulance = $result->fetch_assoc();
$team_id = $ambulance['team_id'];
$ambulance_lat = $ambulance['latitude'];
$ambulance_lng = $ambulance['longitude'];
$stmt->close();

// Prepare location JSON
$location_json = json_encode(["lat" => $latitude, "lng" => $longitude]);

// Insert emergency request with proper error handling
try {
    if ($patient_id === null) {
        // Guest user or non-patient user
        $request_sql = "
            INSERT INTO emergency_requests (patient_id, location, status, requested_at)
            VALUES (NULL, ?, 'Pending', NOW())
        ";
        $request_stmt = $conn->prepare($request_sql);
        $request_stmt->bind_param("s", $location_json);
    } else {
        // Patient user
        $request_sql = "
            INSERT INTO emergency_requests (patient_id, location, status, requested_at)
            VALUES (?, ?, 'Pending', NOW())
        ";
        $request_stmt = $conn->prepare($request_sql);
        $request_stmt->bind_param("is", $patient_id, $location_json);
    }

    $insert_success = $request_stmt->execute();
    
    if (!$insert_success) {
        throw new Exception("Failed to insert emergency request: " . $conn->error);
    }
    
    $request_id = $request_stmt->insert_id;
    $request_stmt->close();
    
    $debug_info["request_id"] = $request_id;
    $debug_info["insert_success"] = true;
    
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage(),
        "debug" => $debug_info,
        "sql_error" => $conn->error ?? "No SQL error info"
    ]);
    exit;
}

// Save ambulance dispatch
try {
    $response_sql = "
        INSERT INTO emergency_responses (request_id, team_id, dispatched_at)
        VALUES (?, ?, NOW())
    ";
    $response_stmt = $conn->prepare($response_sql);
    $response_stmt->bind_param("ii", $request_id, $team_id);
    
    $dispatch_success = $response_stmt->execute();
    
    if (!$dispatch_success) {
        throw new Exception("Failed to dispatch ambulance: " . $conn->error);
    }
    
    $response_stmt->close();
    $debug_info["dispatch_success"] = true;
    
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Dispatch error: " . $e->getMessage(),
        "debug" => $debug_info
    ]);
    exit;
}

// Calculate estimated time of arrival (ETA)
function calculateETA($lat1, $lon1, $lat2, $lon2, $speed_kmh = 40) {
    $earthRadius = 6371; // km
    $lat1_rad = deg2rad($lat1);
    $lon1_rad = deg2rad($lon1);
    $lat2_rad = deg2rad($lat2);
    $lon2_rad = deg2rad($lon2);

    $dlat = $lat2_rad - $lat1_rad;
    $dlon = $lon2_rad - $lon1_rad;

    $a = sin($dlat/2) * sin($dlat/2) +
         cos($lat1_rad) * cos($lat2_rad) *
         sin($dlon/2) * sin($dlon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));

    $distance = $earthRadius * $c;
    $eta_minutes = ceil(($distance / $speed_kmh) * 60);
    return $eta_minutes;
}

$estimated_time_minutes = calculateETA(
    $ambulance_lat, $ambulance_lng, $latitude, $longitude
);

$debug_info["eta_minutes"] = $estimated_time_minutes;
$debug_info["ambulance_team_id"] = $team_id;

echo json_encode([
    "success" => true,
    "message" => "Emergency request saved successfully",
    "ambulance_team_id" => $team_id,
    "estimated_time_minutes" => $estimated_time_minutes,
    "request_id" => $request_id,
    "user_role" => $user_role,
    "debug" => $debug_info
]);
?>
