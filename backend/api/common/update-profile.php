<?php

session_start();
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
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $_SESSION['user_id'];

    $name = trim($input['name'] ?? '');
    $city = trim($input['city'] ?? '');
    $address = trim($input['address'] ?? '');
    $currentPassword = $input['currentPassword'] ?? '';
    $newPassword = $input['newPassword'] ?? '';

    // Validate required fields
    if (empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Name is required']);
        exit;
    }

    // Get current user data (to retrieve fixed email)
    $stmt = $conn->prepare("SELECT email, password FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    $userData = $result->fetch_assoc();
    $email = $userData['email']; // Always use current email

    // Split name into first and last name
    $nameParts = explode(' ', $name, 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

    // Start transaction
    $conn->begin_transaction();

    // Handle password change if provided
    if (!empty($currentPassword) && !empty($newPassword)) {
        // Verify current password
        if (!password_verify($currentPassword, $userData['password'])) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            exit;
        }

        // Update with new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, city = ?, address_line = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi", $firstName, $lastName, $city, $address, $hashedPassword, $userId);
    } else {
        // Update without password change
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, city = ?, address_line = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $firstName, $lastName, $city, $address, $userId);
    }

    if ($stmt->execute()) {
        $conn->commit();
        echo json_encode([
            'success' => true,
            'message' => 'Profile updated successfully'
        ]);
    } else {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
    }
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
