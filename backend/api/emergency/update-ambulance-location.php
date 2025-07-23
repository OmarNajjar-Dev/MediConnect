<?php

session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

// Check if user is logged in and is an ambulance team
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Ambulance Team') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied. Ambulance team access required.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $latitude = floatval($input['latitude'] ?? 0);
    $longitude = floatval($input['longitude'] ?? 0);
    
    // Validate coordinates
    if ($latitude === 0 || $longitude === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid coordinates provided']);
        exit;
    }
    
    $userId = $_SESSION['user_id'];
    
    // Get the team_id for this user
    $stmt = $conn->prepare("SELECT team_id FROM ambulance_teams WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Ambulance team not found']);
        exit;
    }
    
    $teamId = $result->fetch_assoc()['team_id'];
    
    // Update the location
    $stmt = $conn->prepare("UPDATE ambulance_locations SET latitude = ?, longitude = ?, updated_at = NOW() WHERE team_id = ?");
    $stmt->bind_param("ddi", $latitude, $longitude, $teamId);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Location updated successfully',
            'team_id' => $teamId,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update location']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

$conn->close();
