<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

header('Content-Type: application/json');
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    $requestId = intval($input['request_id'] ?? 0);
    
    if (!$requestId) {
        echo json_encode(['success' => false, 'message' => 'Invalid request_id provided']);
        exit;
    }
    
    // Verify the emergency request exists and is in pending status
    $stmt = $conn->prepare("SELECT request_id, status FROM emergency_requests WHERE request_id = ?");
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Emergency request not found']);
        exit;
    }
    
    $request = $result->fetch_assoc();
    
    if ($request['status'] === 'Completed') {
        echo json_encode(['success' => false, 'message' => 'Request already completed']);
        exit;
    }
    
    if ($request['status'] === 'Canceled') {
        echo json_encode(['success' => false, 'message' => 'Cannot complete canceled request']);
        exit;
    }
    
    // Update the emergency request to completed status
    $stmt = $conn->prepare("UPDATE emergency_requests SET status = 'Completed', completed_at = NOW() WHERE request_id = ?");
    $stmt->bind_param("i", $requestId);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Emergency request marked as completed',
                'request_id' => $requestId,
                'completed_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes made to request']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
