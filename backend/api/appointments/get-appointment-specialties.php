<?php

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT specialty_id, name FROM specialties ORDER BY name ASC");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $specialties = [];
    while ($row = $result->fetch_assoc()) {
        $specialties[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'specialties' => $specialties
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to fetch specialties: ' . $e->getMessage()
    ]);
}

?> 