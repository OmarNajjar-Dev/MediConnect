<?php

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $hospitalId = $input['hospitalId'] ?? null;
    $name = trim($input['name'] ?? '');
    $address = trim($input['address'] ?? '');
    $contact = trim($input['contact'] ?? '');
    $availableBeds = $input['availableBeds'] ?? 0;
    $emergencyServices = $input['emergencyServices'] ?? false;
    $imageUrl = trim($input['imageUrl'] ?? '');

    // Validate required fields
    if (!$hospitalId || empty($name) || empty($address) || empty($contact)) {
        echo json_encode(['success' => false, 'message' => 'Hospital ID, name, address, and contact are required']);
        exit;
    }

    // Check if hospital name already exists for other hospitals
    $stmt = $conn->prepare("SELECT hospital_id FROM hospitals WHERE name = ? AND hospital_id != ?");
    $stmt->bind_param("si", $name, $hospitalId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Hospital name already exists']);
        exit;
    }

    // Update hospital
    $stmt = $conn->prepare("UPDATE hospitals SET name = ?, address = ?, contact = ?, available_beds = ?, emergency_services = ?, image_url = ? WHERE hospital_id = ?");
    $emergencyServicesInt = $emergencyServices ? 1 : 0;
    $stmt->bind_param("sssissi", $name, $address, $contact, $availableBeds, $emergencyServicesInt, $imageUrl, $hospitalId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Hospital not found or no changes made']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Hospital updated successfully'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update hospital: ' . $e->getMessage()
    ]);
}

$conn->close(); 