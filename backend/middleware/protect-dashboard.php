<?php

$paths = require_once __DIR__ . '/../config/path.php';

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . $paths['login']);
    exit;
}

// Stop if the required role is not defined in the page
if (!isset($requiredRole)) {
    header("Location: " . $paths['errors']['500']);

    exit;
}

// Get the user's role from the session
$userRole = $_SESSION['user_role'] ?? null;

// Redirect to unauthorized page if user role doesn't match
if ($userRole !== $requiredRole) {
    header("Location: " . $paths['unauthorized']);
    exit;
}
