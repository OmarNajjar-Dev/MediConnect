<?php

session_start();
require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    // Check if user has patient role
    $roleCheck = $conn->prepare("SELECT r.role_name FROM users u JOIN user_roles ur ON u.user_id = ur.user_id JOIN roles r ON ur.role_id = r.role_id WHERE u.user_id = ?");
    $roleCheck->bind_param("i", $userId);
    $roleCheck->execute();
    $roleResult = $roleCheck->get_result();
    
    $isPatient = false;
    while ($row = $roleResult->fetch_assoc()) {
        if ($row['role_name'] === 'Patient') {
            $isPatient = true;
            break;
        }
    }
    
    if (!$isPatient) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized: Patient role required']);
        exit;
    }

    // Fetch patient profile data
    $stmt = $conn->prepare("
        SELECT 
            u.first_name,
            u.last_name,
            u.email,
            u.profile_image,
            p.birthdate,
            p.gender
        FROM users u
        LEFT JOIN patients p ON u.user_id = p.user_id
        WHERE u.user_id = ?
    ");
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        $data = [
            'name' => trim($user['first_name'] . ' ' . $user['last_name']),
            'email' => $user['email'],
            'profile_image' => $user['profile_image'],
            'birthdate' => $user['birthdate'],
            'gender' => $user['gender']
        ];
        
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

$conn->close();
?> 