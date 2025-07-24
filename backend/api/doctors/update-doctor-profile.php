<?php

// Turn off error reporting to prevent HTML output
error_reporting(0);
ini_set('display_errors', 0);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

// Form Data
$name = trim($_POST['name'] ?? '');
$bio = trim($_POST['bio'] ?? '');

// Validation
if (empty($name)) {
    echo json_encode(['success' => false, 'message' => 'Full name is required']);
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
        echo json_encode(['success' => false, 'message' => 'Unauthorized: Doctor role required']);
        exit;
    }

    // Update users table
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare user update statement');
    }
    $stmt->bind_param("ssi", $firstName, $lastName, $userId);
    $stmt->execute();

    // Update doctors table
    $stmt = $conn->prepare("UPDATE doctors SET bio = ? WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare doctor update statement');
    }
    $stmt->bind_param("si", $bio, $userId);
    $stmt->execute();

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../uploads/profile_images/';
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
        $imageUrl = '/mediconnect/uploads/profile_images/' . $newFileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
            // Update database with full web path (not just filename)
            $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
            if (!$stmt) {
                throw new Exception('Failed to prepare image update statement');
            }
            $stmt->bind_param("si", $imageUrl, $userId);
            $stmt->execute();
        } else {
            throw new Exception("Failed to upload profile image");
        }
    }

    $conn->commit();
    // Prepare full name
    $fullName = trim($firstName . ' ' . $lastName);

    // Prepare image path from DB (in case it was updated)
    $profileImageResult = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
    $profileImageResult->bind_param("i", $userId);
    $profileImageResult->execute();
    $imageResult = $profileImageResult->get_result();
    $profileImageUrl = null;

    if ($row = $imageResult->fetch_assoc()) {
        $profileImageUrl = $row['profile_image'] ?? null;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully',
        'data' => [
            'name' => $fullName,
            'bio' => $bio,
            'profile_image' => $profileImageUrl
        ]
    ]);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
