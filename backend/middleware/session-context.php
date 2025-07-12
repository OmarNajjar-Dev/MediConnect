<?php

// 1. Start session and auto-login logic
require_once __DIR__ . '/../auth/auth.php';

// 2. Load database connection
require_once __DIR__ . '/../config/db.php';

$isLoggedIn = false;
$userName = '';
$userEmail = '';
$dashboardLink = $paths['auth']['login']; // Default link if not authenticated

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user's basic information
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $isLoggedIn = true;
        $userName = $user['first_name'] . ' ' . $user['last_name'];
        $userEmail = $user['email'];

        // Fetch user's role
        $roleStmt = $conn->prepare("
            SELECT r.role_name 
            FROM roles r
            JOIN user_roles ur ON ur.role_id = r.role_id
            WHERE ur.user_id = ?
            LIMIT 1
        ");
        $roleStmt->bind_param("i", $userId);
        $roleStmt->execute();
        $roleResult = $roleStmt->get_result();

        if ($roleRow = $roleResult->fetch_assoc()) {
            $roleName = trim($roleRow['role_name']);

            if (str_contains($roleName, ' ')) {
                $normalizedRole = strtolower(str_replace(' ', '_', $roleName));
            } else {
                $normalizedRole = strtolower($roleName);
            }

            $dashboardLink = $paths['dashboard'][$normalizedRole] ?? $paths['errors']['unauthorized'];
        }
    }
}
