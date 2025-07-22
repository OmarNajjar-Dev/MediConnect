<?php

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

// Check if specialty_id is provided
$specialty_id = isset($_GET['specialty_id']) ? (int)$_GET['specialty_id'] : null;

// Build the SQL query
$sql = "SELECT 
            d.doctor_id,
            u.first_name,
            u.last_name,
            s.name AS specialty
        FROM doctors d
        INNER JOIN users u ON d.user_id = u.user_id
        LEFT JOIN specialties s ON d.specialty_id = s.specialty_id";

// Add specialty filter if provided
if ($specialty_id) {
    $sql .= " WHERE d.specialty_id = ?";
}

$sql .= " ORDER BY u.first_name, u.last_name";

try {
    if ($specialty_id) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $specialty_id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    echo json_encode([
        'success' => true,
        'doctors' => $doctors
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch doctors: ' . $e->getMessage()
    ]);
}

?> 