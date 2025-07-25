<?php

// Enhanced session handling for InfinityFree
require_once __DIR__ . '/../../config/session-config.php';
startSecureSession();

// Turn off error reporting to prevent HTML output
error_reporting(0);
ini_set('display_errors', 0);

// Load database connection
require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

// Debug session state (remove in production)
$debug = [
    'session_id' => session_id(),
    'session_status' => session_status(),
    'user_id_exists' => isset($_SESSION['user_id']),
    'user_id_value' => $_SESSION['user_id'] ?? 'not_set',
    'request_method' => $_SERVER['REQUEST_METHOD']
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
    // Check if connection exists
    if (!$conn) {
        throw new Exception('Database connection failed');
    }
    
    // Check if user has doctor role
    $roleCheck = $conn->prepare("SELECT r.role_name FROM users u JOIN user_roles ur ON u.user_id = ur.user_id JOIN roles r ON ur.role_id = r.role_id WHERE u.user_id = ?");
    if (!$roleCheck) {
        throw new Exception('Failed to prepare role check statement');
    }
    
    $roleCheck->bind_param("i", $userId);
    $roleCheck->execute();
    $roleResult = $roleCheck->get_result();
    
    $isDoctor = false;
    while ($row = $roleResult->fetch_assoc()) {
        if ($row['role_name'] === 'Doctor') {
            $isDoctor = true;
            break;
        }
    }
    
    if (!$isDoctor) {
        http_response_code(403);
        echo json_encode([
            'success' => false, 
            'message' => 'Unauthorized: Doctor role required',
            'debug' => $debug
        ]);
        exit;
    }
    
    // Get doctor profile data
    $stmt = $conn->prepare("SELECT u.first_name, u.last_name, u.email, u.profile_image, d.bio FROM users u JOIN doctors d ON u.user_id = d.user_id WHERE u.user_id = ?");
    
    if (!$stmt) {
        throw new Exception('Failed to prepare statement');
    }
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $doctorData = $result->fetch_assoc();
        $doctorData['name'] = trim($doctorData['first_name'] . ' ' . $doctorData['last_name']);
        
        // Clean up response
        unset($doctorData['first_name']);
        unset($doctorData['last_name']);
        
        echo json_encode(['success' => true, 'data' => $doctorData]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false, 
            'message' => 'Doctor profile not found',
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