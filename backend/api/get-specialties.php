<?php

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT specialty_id, name, label_for_doctor FROM specialties ORDER BY name";
    $result = $conn->query($sql);

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

$conn->close(); 