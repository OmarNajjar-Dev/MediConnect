<?php

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $requestId = intval($_GET['request_id'] ?? 0);
    
    if (!$requestId) {
        echo json_encode(['success' => false, 'message' => 'Invalid request_id provided']);
        exit;
    }
    
    // Get the emergency request details
    $stmt = $conn->prepare("
        SELECT 
            er.request_id,
            er.patient_id,
            er.location,
            er.status,
            er.requested_at,
            er.completed_at,
            er.canceled_at,
            er.estimated_time_minutes
        FROM emergency_requests er
        WHERE er.request_id = ?
    ");
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Emergency request not found']);
        exit;
    }
    
    $request = $result->fetch_assoc();
    
    // Calculate remaining time if still pending
    $remainingMinutes = 0;
    if ($request['status'] === 'Pending') {
        $requestedTime = strtotime($request['requested_at']);
        $currentTime = time();
        $elapsedMinutes = floor(($currentTime - $requestedTime) / 60);
        
        // Default estimated time if not set
        $estimatedMinutes = $request['estimated_time_minutes'] ?? 10;
        $remainingMinutes = max(0, $estimatedMinutes - $elapsedMinutes);
    }
    
    echo json_encode([
        'success' => true,
        'request' => [
            'request_id' => $request['request_id'],
            'status' => $request['status'],
            'requested_at' => $request['requested_at'],
            'completed_at' => $request['completed_at'],
            'canceled_at' => $request['canceled_at'],
            'remaining_minutes' => $remainingMinutes,
            'location' => json_decode($request['location'], true)
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

$conn->close();
?> 