<?php

require_once ROOT . '/src/config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $name = trim($input['name'] ?? '');
    $address = trim($input['address'] ?? '');
    $contact = trim($input['contact'] ?? '');
    $city = trim($input['city'] ?? '');
    $availableBeds = $input['availableBeds'] ?? 0;
    $emergencyServices = $input['emergencyServices'] ?? false;
    $imageUrl = trim($input['imageUrl'] ?? '');

    // Validate required fields
    if (empty($name) || empty($address) || empty($contact)) {
        echo json_encode(['success' => false, 'message' => 'Name, address, and contact are required']);
        exit;
    }

    // Check if hospital name already exists
    $stmt = $conn->prepare("SELECT hospital_id FROM hospitals WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Hospital name already exists']);
        exit;
    }

    // Insert hospital
    $stmt = $conn->prepare("INSERT INTO hospitals (name, address, contact, available_beds, emergency_services, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $emergencyServicesInt = $emergencyServices ? 1 : 0;
    $stmt->bind_param("ssssis", $name, $address, $contact, $availableBeds, $emergencyServicesInt, $imageUrl);
    $stmt->execute();
    
    $hospitalId = $conn->insert_id;

    echo json_encode([
        'success' => true,
        'message' => 'Hospital created successfully',
        'hospitalId' => $hospitalId
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to create hospital: ' . $e->getMessage()
    ]);
}

$conn->close(); 