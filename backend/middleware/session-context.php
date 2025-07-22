<?php

// 1. Start session and auto-login logic
require_once __DIR__ . '/../auth/auth.php';

// 2. Load database connection
require_once __DIR__ . '/../config/db.php';

$isLoggedIn = false;
$userName = '';
$userEmail = '';
$userProfileImage = '';
$userAddress = '';
$userCity = '';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user's basic information including profile image
    $stmt = $conn->prepare("SELECT first_name, last_name, email, profile_image, address_line, city FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $isLoggedIn = true;
        $userName = $user['first_name'] . ' ' . $user['last_name'];
        $userEmail = $user['email'];
        $userProfileImage = $user['profile_image'];
        $userAddress = $user['address_line'];
        $userCity = $user['city'];
    }
}
