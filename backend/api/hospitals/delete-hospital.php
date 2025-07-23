<?php

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $hospitalId = $input['hospitalId'] ?? null;

    if (!$hospitalId) {
        echo json_encode(['success' => false, 'message' => 'Hospital ID is required']);
        exit;
    }

    // Check if hospital exists
    $stmt = $conn->prepare("SELECT hospital_id FROM hospitals WHERE hospital_id = ?");
    $stmt->bind_param("i", $hospitalId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Hospital not found']);
        exit;
    }

    // Start transaction
    $conn->begin_transaction();

    // Delete hospital (CASCADE will handle related records)
    $stmt = $conn->prepare("DELETE FROM hospitals WHERE hospital_id = ?");
    $stmt->bind_param("i", $hospitalId);
    $stmt->execute();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Hospital deleted successfully'
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to delete hospital: ' . $e->getMessage()
    ]);
}

$conn->close(); 