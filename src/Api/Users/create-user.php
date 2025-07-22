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

    $fullName = trim($input['fullName'] ?? '');
    $email = trim($input['email'] ?? '');
    $roleName = trim($input['role'] ?? '');
    $hospitalId = $input['hospitalId'] ?? null;
    $specialtyId = $input['specialtyId'] ?? null;
    $teamName = trim($input['teamName'] ?? '');
    $city = trim($input['city'] ?? '');
    $addressLine = trim($input['addressLine'] ?? '');
    $password = trim($input['password'] ?? '');

    // Validate password if provided (for new users)
    if (empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Password is required for new users']);
        exit;
    }

    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long']);
        exit;
    }

    // Validate required fields
    if (empty($fullName) || empty($email) || empty($roleName)) {
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

    // SECURITY: Prevent creation of Super Admin users
    if ($roleName === 'Super Admin') {
        echo json_encode(['success' => false, 'message' => 'Cannot create Super Admin users']);
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

    // TODO: Send email notification to user about account creation
    echo json_encode([
        'success' => true,
        'message' => 'User created successfully with the provided password.',
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

/**
 * Generate a secure temporary password
 */
function generateSecurePassword($length = 12)
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*';

    $password = '';

    // Ensure at least one character from each set
    $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];
    $password .= $symbols[random_int(0, strlen($symbols) - 1)];

    // Fill the rest with random characters
    $allChars = $uppercase . $lowercase . $numbers . $symbols;
    for ($i = 4; $i < $length; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }

    // Shuffle the password
    return str_shuffle($password);
}

$conn->close();
