<?php
session_start();  // Start session to check login info
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

// Decode input data
$data = json_decode(file_get_contents("php://input"), true);

// Check if coordinates are received
if (!isset($data['latitude']) || !isset($data['longitude'])) {
    echo json_encode(["success" => false, "message" => "Missing coordinates"]);
    exit;
}

$latitude = floatval($data['latitude']);
$longitude = floatval($data['longitude']);

// Determine patient_id: get from session if logged in, else null
if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']);

    // Fetch patient_id linked to this user_id
    $patient_stmt = $conn->prepare("SELECT patient_id FROM patients WHERE user_id = ?");
    $patient_stmt->bind_param("i", $user_id);
    $patient_stmt->execute();
    $patient_result = $patient_stmt->get_result();

    if ($patient_result->num_rows === 0) {
        // User logged in but not a patient, can decide to reject or set NULL
        $patient_id = null;
    } else {
        $patient_row = $patient_result->fetch_assoc();
        $patient_id = $patient_row['patient_id'];
    }
} else {
    // User not logged in — patient_id is null
    $patient_id = null;
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
    echo json_encode(["success" => false, "message" => "No ambulance found"]);
    exit;
}

$ambulance = $result->fetch_assoc();
$team_id = $ambulance['team_id'];
$ambulance_lat = $ambulance['latitude'];
$ambulance_lng = $ambulance['longitude'];

// Prepare location JSON
$location_json = json_encode(["lat" => $latitude, "lng" => $longitude]);

// Insert emergency request, allowing patient_id to be null
if ($patient_id === null) {
    $request_sql = "
        INSERT INTO emergency_requests (patient_id, location, status, requested_at)
        VALUES (NULL, ?, 'pending', NOW())
    ";
    $request_stmt = $conn->prepare($request_sql);
    $request_stmt->bind_param("s", $location_json);
} else {
    $request_sql = "
        INSERT INTO emergency_requests (patient_id, location, status, requested_at)
        VALUES (?, ?, 'pending', NOW())
    ";
    $request_stmt = $conn->prepare($request_sql);
    $request_stmt->bind_param("is", $patient_id, $location_json);
}

$request_stmt->execute();
$request_id = $request_stmt->insert_id;

// Save ambulance dispatch
$response_sql = "
    INSERT INTO emergency_responses (request_id, team_id, dispatched_at)
    VALUES (?, ?, NOW())
";
$response_stmt = $conn->prepare($response_sql);
$response_stmt->bind_param("ii", $request_id, $team_id);
$response_stmt->execute();

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

echo json_encode([
    "success" => true,
    "message" => "Emergency request saved successfully",
    "ambulance_team_id" => $team_id,
    "estimated_time_minutes" => $estimated_time_minutes,
    "request_id" => $request_id,
]);
?>
