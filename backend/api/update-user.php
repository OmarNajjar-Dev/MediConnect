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
    
    $userId = $input['userId'] ?? null;
    $fullName = trim($input['fullName'] ?? '');
    $email = trim($input['email'] ?? '');
    $roleName = trim($input['role'] ?? '');
    $hospitalId = $input['hospitalId'] ?? null;
    $specialtyId = $input['specialtyId'] ?? null;
    $teamName = trim($input['teamName'] ?? '');
    $city = trim($input['city'] ?? '');
    $addressLine = trim($input['addressLine'] ?? '');

    // Validate required fields
    if (!$userId || empty($fullName) || empty($email) || empty($roleName)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Split full name into first and last name
    $nameParts = explode(' ', $fullName, 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    // Check if email already exists for other users
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
    $stmt->bind_param("si", $email, $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        exit;
    }

    // Get role ID
    $stmt = $conn->prepare("SELECT role_id FROM roles WHERE role_name = ?");
    $stmt->bind_param("s", $roleName);
    $stmt->execute();
    $roleResult = $stmt->get_result();
    if ($roleResult->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid role']);
        exit;
    }
    $roleId = $roleResult->fetch_assoc()['role_id'];

    // Start transaction
    $conn->begin_transaction();

    // Update user
    $stmt = $conn->prepare("UPDATE users SET email = ?, first_name = ?, last_name = ?, city = ?, address_line = ? WHERE user_id = ?");
    $stmt->bind_param("sssssi", $email, $firstName, $lastName, $city, $addressLine, $userId);
    $stmt->execute();

    // Update user role
    $stmt = $conn->prepare("DELETE FROM user_roles WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $roleId);
    $stmt->execute();

    // Clean up old role-specific data
    $stmt = $conn->prepare("DELETE FROM doctors WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM patients WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM ambulance_teams WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Insert new role-specific data
    switch ($roleName) {
        case 'Doctor':
            if (!$hospitalId || !$specialtyId) {
                throw new Exception('Hospital and specialty are required for doctors');
            }
            $stmt = $conn->prepare("INSERT INTO doctors (user_id, specialty_id, hospital_id, is_verified) VALUES (?, ?, ?, 0)");
            $stmt->bind_param("iii", $userId, $specialtyId, $hospitalId);
            $stmt->execute();
            break;

        case 'Patient':
            $stmt = $conn->prepare("INSERT INTO patients (user_id) VALUES (?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            break;

        case 'Ambulance Team':
            $teamNameToUse = $teamName ?: ($firstName . "'s Team");
            $stmt = $conn->prepare("INSERT INTO ambulance_teams (user_id, team_name) VALUES (?, ?)");
            $stmt->bind_param("is", $userId, $teamNameToUse);
            $stmt->execute();
            break;

        // Hospital Admin and Staff don't need additional tables
        case 'Hospital Admin':
        case 'Staff':
            break;
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'User updated successfully'
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update user: ' . $e->getMessage()
    ]);
}

$conn->close(); 