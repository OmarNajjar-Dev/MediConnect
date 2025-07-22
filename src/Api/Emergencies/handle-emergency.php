<?php
header('Content-Type: application/json');

// Include the database connection file (assumes $conn is defined there)
require_once ROOT . '/src/config/db.php';

// Get JSON input from JavaScript (latitude and longitude)
$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.txt", print_r($data, true));

// Check if latitude and longitude are received
if (!isset($data['latitude']) || !isset($data['longitude'])) {
    echo json_encode([
        "success" => false,
        "message" => "Missing coordinates"
    ]);
    exit;
}

// Clean and store coordinates
$latitude = floatval($data['latitude']);
$longitude = floatval($data['longitude']);

// Find the nearest ambulance team using a simple distance formula
$query = "
    SELECT team_id,
           latitude,
           longitude,
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
        "message" => "No ambulance found"
    ]);
    exit;
}

$ambulance = $result->fetch_assoc();
$team_id = $ambulance['team_id'];

// Dummy patient_id for now (you can replace with session or auth logic)
$patient_id = 1;

// Save emergency request
$location_json = json_encode([
    "lat" => $latitude,
    "lng" => $longitude
]);

$request_sql = "
    INSERT INTO emergency_requests (patient_id, location, status, requested_at)
    VALUES (?, ?, 'pending', NOW())
";
$request_stmt = $conn->prepare($request_sql);
$request_stmt->bind_param("is", $patient_id, $location_json);
$request_stmt->execute();
$request_id = $request_stmt->insert_id;

// Save ambulance team response
$response_sql = "
    INSERT INTO emergency_responses (request_id, team_id, dispatched_at)
    VALUES (?, ?, NOW())
";
$response_stmt = $conn->prepare($response_sql);
$response_stmt->bind_param("ii", $request_id, $team_id);
$response_stmt->execute();

// Return success response
echo json_encode([
    "success" => true,
    "message" => "Emergency request saved successfully",
    "ambulance_team_id" => $team_id
]);
?>
