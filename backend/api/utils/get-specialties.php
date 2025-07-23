<?php

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT specialty_id, name, label_for_doctor FROM specialties ORDER BY name ASC");
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