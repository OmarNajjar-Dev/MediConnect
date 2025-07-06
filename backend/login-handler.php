<?php

session_start();
require_once './db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $rememberMe = !empty($_POST["remember_me"]);

    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["user_id"];

            // Handle "Remember Me"
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32));
                setcookie("remember_token", $token, time() + 86400 * 30, "/"); // valid for 30 days

                $updateStmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE user_id = ?");
                $updateStmt->bind_param("si", $token, $user["user_id"]);
                $updateStmt->execute();
                $updateStmt->close();
            }

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        }
    }

    // Failed login
    header("Location: login.php?error=1");
    exit();
}

// Invalid request (non-POST)
header("Location: login.php");
exit();
