<?php

// Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Remove remember_token cookie (set with past expiration date)
setcookie("remember_token", "", time() - 3600, "/");

// Redirect to login page
header("Location: " . $paths['auth']['login']);
exit;
