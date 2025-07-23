<?php
require_once 'db_connection.php'; // your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['request_id'];

    if (!empty($requestId)) {
        $stmt = $conn->prepare("UPDATE emergency_requests SET status = 'completed', completed_at = NOW() WHERE request_id = ?");
        $stmt->bind_param("i", $requestId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'DB error']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request_id']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid method']);
}
?>
