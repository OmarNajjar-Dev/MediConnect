<?php

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $sql = "SELECT h.*, GROUP_CONCAT(s.label_for_hospital) AS specialties
            FROM hospitals h
            LEFT JOIN hospital_specialties hs ON h.hospital_id = hs.hospital_id
            LEFT JOIN specialties s ON hs.specialty_id = s.specialty_id
            GROUP BY h.hospital_id";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Database query failed: " . $conn->error);
    }

    $hospitals = [];

    while ($row = $result->fetch_assoc()) {
        $row['specialties'] = $row['specialties'] ? explode(',', $row['specialties']) : [];
        $hospitals[] = $row;
    }

    echo json_encode([
        'success' => true,
        'hospitals' => $hospitals
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to fetch hospitals: ' . $e->getMessage()
    ]);
}

?>
