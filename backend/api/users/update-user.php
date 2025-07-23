<?php

require_once __DIR__ . '/../../config/db.php';

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

    // SECURITY: Check if user being updated is Super Admin
    $stmt = $conn->prepare("SELECT r.role_name FROM users u JOIN user_roles ur ON u.user_id = ur.user_id JOIN roles r ON ur.role_id = r.role_id WHERE u.user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $currentRole = $result->fetch_assoc()['role_name'];
        if ($currentRole === 'Super Admin') {
            echo json_encode(['success' => false, 'message' => 'Cannot update Super Admin users']);
            exit;
        }
    }

    // SECURITY: Prevent updating to Super Admin role
    if ($roleName === 'Super Admin') {
        echo json_encode(['success' => false, 'message' => 'Cannot assign Super Admin role']);
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

    // Clean up ambulance data (including locations)
    $stmt = $conn->prepare("DELETE al FROM ambulance_locations al 
                           INNER JOIN ambulance_teams at ON al.team_id = at.team_id 
                           WHERE at.user_id = ?");
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
            
            // Get the team_id that was just created
            $teamId = $conn->insert_id;
            
            // Create initial location entry for the ambulance team
            // Default to a central location (can be updated later via GPS)
            $defaultLat = 34.390016; // Default latitude (can be updated)
            $defaultLng = 35.8055936; // Default longitude (can be updated)
            $stmt = $conn->prepare("INSERT INTO ambulance_locations (team_id, latitude, longitude) VALUES (?, ?, ?)");
            $stmt->bind_param("idd", $teamId, $defaultLat, $defaultLng);
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