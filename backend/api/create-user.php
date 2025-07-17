<?php

require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $fullName = trim($input['fullName'] ?? '');
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $roleName = trim($input['role'] ?? '');
    $hospitalId = $input['hospitalId'] ?? null;
    $specialtyId = $input['specialtyId'] ?? null;
    $teamName = trim($input['teamName'] ?? '');
    $city = trim($input['city'] ?? '');
    $addressLine = trim($input['addressLine'] ?? '');

    // Validate required fields
    if (empty($fullName) || empty($email) || empty($password) || empty($roleName)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Split full name into first and last name
    $nameParts = explode(' ', $fullName, 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
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

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, city, address_line) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $hashedPassword, $firstName, $lastName, $city, $addressLine);
    $stmt->execute();
    $userId = $conn->insert_id;

    // Insert user role
    $stmt = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $roleId);
    $stmt->execute();

    // Insert role-specific data
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
        'message' => 'User created successfully',
        'userId' => $userId
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to create user: ' . $e->getMessage()
    ]);
}

$conn->close(); 