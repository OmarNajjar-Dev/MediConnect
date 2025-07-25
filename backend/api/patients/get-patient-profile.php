<?php

// Enhanced session handling for InfinityFree
require_once __DIR__ . '/../../config/session-config.php';
startSecureSession();

// Load database connection
require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

// Debug session state (remove in production)
$debug = [
    'session_id' => session_id(),
    'session_status' => session_status(),
    'user_id_exists' => isset($_SESSION['user_id']),
    'user_id_value' => $_SESSION['user_id'] ?? 'not_set'
];

// Check if user is logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([
        'success' => false, 
        'message' => 'Unauthorized: No valid session found',
        'debug' => $debug
    ]);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    // Check if user has patient role
    $roleCheck = $conn->prepare("SELECT r.role_name FROM users u JOIN user_roles ur ON u.user_id = ur.user_id JOIN roles r ON ur.role_id = r.role_id WHERE u.user_id = ?");
    if (!$roleCheck) {
        throw new Exception('Failed to prepare role check statement');
    }
    
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
        echo json_encode([
            'success' => false, 
            'message' => 'Unauthorized: Patient role required',
            'debug' => $debug
        ]);
        exit;
    }

    // Fetch patient profile data
    $stmt = $conn->prepare("
        SELECT 
            u.first_name,
            u.last_name,
            u.email,
            u.profile_image,
            u.city,
            u.address_line,
            p.birthdate,
            p.gender
        FROM users u
        LEFT JOIN patients p ON u.user_id = p.user_id
        WHERE u.user_id = ?
    ");
    
    if (!$stmt) {
        throw new Exception('Failed to prepare profile select statement');
    }
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        $data = [
            'name' => trim($user['first_name'] . ' ' . $user['last_name']),
            'email' => $user['email'],
            'profile_image' => $user['profile_image'],
            'birthdate' => $user['birthdate'],
            'gender' => $user['gender'],
            'city' => $user['city'],
            'address' => $user['address_line']
        ];
        
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found',
            'debug' => $debug
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage(),
        'debug' => $debug
    ]);
} finally {
    // Close the database connection
    if (isset($conn)) {
        $conn->close();
    }
}

?> 