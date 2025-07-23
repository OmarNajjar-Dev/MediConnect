<?php

session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/registration-helpers.php';

header('Content-Type: application/json'); // Important for AJAX

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $rememberMe = !empty($_POST["remember_me"]);

    // Get user and password from users table
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["user_id"];

            // Fetch user role
            $roleStmt = $conn->prepare("
                SELECT r.role_name AS role_name
                FROM user_roles ur
                JOIN roles r ON ur.role_id = r.role_id
                WHERE ur.user_id = ?
                LIMIT 1
            ");
            $roleStmt->bind_param("i", $user["user_id"]);
            $roleStmt->execute();
            $roleResult = $roleStmt->get_result();

            // Store user role in session
            if ($roleResult->num_rows === 1) {
                $roleData = $roleResult->fetch_assoc();
                $roleName = $roleData["role_name"];
                storeUserRoleInSession($roleName);  // e.g., "super_admin", "doctor"
            }

            $roleStmt->close();

            // Handle Remember Me
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32));
                setcookie("remember_token", $token, time() + 86400 * 30, "/");

                $updateStmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE user_id = ?");
                $updateStmt->bind_param("si", $token, $user["user_id"]);
                $updateStmt->execute();
                $updateStmt->close();
            }

            // Always redirect to dashboard index, which will handle role-based routing
            echo json_encode([
                "success" => true,
                "redirect" => $paths['dashboard']['index']
            ]);
            exit();
        }
    }

    // Failed login
    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password"
    ]);
    exit();
}

echo json_encode([
    "success" => false,
    "message" => "Invalid request method"
]);
exit();
