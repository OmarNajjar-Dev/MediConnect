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

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false, 
        'message' => 'Method not allowed',
        'debug' => $debug
    ]);
    exit;
}

$userId = $_SESSION['user_id'];

// Form Data
$name = trim($_POST['name'] ?? '');
$birthday = trim($_POST['birthdate'] ?? '');
$city = trim($_POST['city'] ?? '');
$address = trim($_POST['address'] ?? '');

// Validation
if (empty($name)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Full name is required',
        'debug' => $debug
    ]);
    exit;
}

$nameParts = explode(' ', $name, 2);
$firstName = $nameParts[0];
$lastName = $nameParts[1] ?? '';

// Database Transaction
$conn->begin_transaction();

try {
    // Check if connection exists
    if (!$conn) {
        throw new Exception('Database connection failed');
    }

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

    // Update users table
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, city = ?, address_line = ? WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare user update statement');
    }
    $stmt->bind_param("ssssi", $firstName, $lastName, $city, $address, $userId);
    $stmt->execute();

    // Update patients table
    $stmt = $conn->prepare("UPDATE patients SET birthdate = ?, gender = ? WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare patient update statement');
    }
    $gender = trim($_POST['gender'] ?? '');
    $stmt->bind_param("ssi", $birthday, $gender, $userId);
    $stmt->execute();

    // Initialize imageUrl variable
    $imageUrl = null;
    $updatedImageUrl = null;

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/profile_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Remove old image if it exists
        $stmt = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception('Failed to prepare image check statement');
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if ($row['profile_image']) {
                // Extract filename from the full path
                $oldImagePath = $uploadDir . basename($row['profile_image']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Generate unique filename
        $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $newFileName = 'profile_' . $userId . '_' . time() . '.' . $extension;
        $uploadPath = $uploadDir . $newFileName;

        // Generate web-accessible URL (like Super Admin implementation)
        $imageUrl = '/uploads/profile_images/' . $newFileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
            // Update database with full web path (not just filename)
            $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
            if (!$stmt) {
                throw new Exception('Failed to prepare image update statement');
            }
            $stmt->bind_param("si", $imageUrl, $userId);
            $stmt->execute();
            $updatedImageUrl = $imageUrl;
        } else {
            throw new Exception("Failed to upload profile image");
        }
    } else {
        // Get current image URL if no new image was uploaded
        $stmt = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception('Failed to prepare image select statement');
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $updatedImageUrl = $row['profile_image'];
        }
    }

    $conn->commit();
    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully',
        'data' => [
            'name' => $firstName . ' ' . $lastName,
            'birthdate' => $birthday,
            'gender' => $gender,
            'city' => $city,
            'address' => $address,
            'profile_image' => $updatedImageUrl
        ]
    ]);
} catch (Exception $e) {
    $conn->rollback();
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
