<?php

session_start();

if (!isset($_SESSION["user_id"]) && isset($_COOKIE["remember_token"])) {
    require_once __DIR__ . '/../config/db.php';

    $token = $_COOKIE["remember_token"];

    // Step 1: Find user by token
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["user_id"];
        $userId = $user["user_id"];

        // Step 2: Get role_name from user_roles → roles
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
            $_SESSION["user_role"] = $roleRow["role_name"];
        }

        $roleStmt->close();
    }

    $stmt->close();
}
