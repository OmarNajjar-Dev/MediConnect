<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['request_id'])) {
    echo json_encode(["success" => false, "message" => "Missing request_id"]);
    exit;
}

$request_id = intval($data['request_id']);

// Update the emergency_requests row to set status and canceled_at
$update_sql = "
    UPDATE emergency_requests
    SET status = 'Canceled', canceled_at = NOW()
    WHERE request_id = ? AND status = 'pending'
";

$stmt = $conn->prepare($update_sql);
$stmt->bind_param("i", $request_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Request canceled successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Request already processed or not found"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
}
?>
