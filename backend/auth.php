<?php
session_start();

if (!isset($_SESSION["user_id"]) && isset($_COOKIE["remember_token"])) {
    require_once __DIR__ . '/db.php';
    $token = $_COOKIE["remember_token"];

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["user_id"];
    }

    $stmt->close();
}
