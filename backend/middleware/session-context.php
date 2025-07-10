<?php

require_once __DIR__ . '/../auth/auth.php'; // Handles session & auto-login if cookie exists
require_once __DIR__ . '/../config/db.php';   // Includes MySQLi DB connection as $conn

require_once __DIR__ . '/../config/path.php';

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
            $normalizedRole = strtolower(str_replace(' ', '', $roleRow['role_name']));
            $dashboardLink = $paths['dashboard'][$normalizedRole] ?? './';
        }
    }
}
