<?php

// Load session configuration
require_once __DIR__ . '/../../config/session-config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    startSecureSession();
}

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
        exit;
    }

    $file = $_FILES['profile_image'];
    $userId = $_SESSION['user_id'];

    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed.']);
        exit;
    }

    // Validate file size (5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'File too large. Maximum size is 5MB.']);
        exit;
    }

    // Create uploads directory if it doesn't exist
    // Use absolute path from project root
    $projectRoot = __DIR__ . '/../../../';
    $uploadsDir = $projectRoot . 'uploads/profile_images/';
    
    // Ensure directory exists with proper permissions
    if (!is_dir($uploadsDir)) {
        if (!mkdir($uploadsDir, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'Failed to create upload directory']);
            exit;
        }
    }

    // Check if directory is writable
    if (!is_writable($uploadsDir)) {
        echo json_encode(['success' => false, 'message' => 'Upload directory is not writable']);
        exit;
    }

    // Get current profile image to delete old one
    $stmt = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentImage = $result->fetch_assoc();
    
    // Delete old profile image if it exists
    if ($currentImage && $currentImage['profile_image']) {
        $oldImagePath = $projectRoot . ltrim($currentImage['profile_image'], '/');
        if (file_exists($oldImagePath) && is_file($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'profile_' . $userId . '_' . time() . '.' . $extension;
    $filePath = $uploadsDir . $filename;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to save uploaded file']);
        exit;
    }

    // Generate web-accessible URL - this should match the database storage format
    $imageUrl = '/uploads/profile_images/' . $filename;

    // Update database
    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
    $stmt->bind_param("si", $imageUrl, $userId);

    if ($stmt->execute()) {
        // Update session with new profile image
        $_SESSION['profile_image'] = $imageUrl;
        
        echo json_encode([
            'success' => true,
            'message' => 'Profile image updated successfully',
            'imageUrl' => $imageUrl
        ]);
    } else {
        // Delete uploaded file if database update fails
        unlink($filePath);
        echo json_encode(['success' => false, 'message' => 'Failed to update database']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
