<?php

// Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../config/path.php";

// Load session configuration
require_once __DIR__ . "/../config/session-config.php";

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    startSecureSession();
};

// Ensure we have a clean session start
session_regenerate_id(true);

// Debug mode
$debug = isset($_GET['debug']) && $_GET['debug'] == '1';

if ($debug) {
    echo "<h1>Logout Debug</h1>";
    echo "<p>Session before logout:</p>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Remove remember_token cookie (set with past expiration date)
setcookie("remember_token", "", time() - 3600, "/");

// Also remove any other session-related cookies
setcookie("MediConnect_Session", "", time() - 3600, "/");
setcookie("user_role_backup", "", time() - 3600, "/");

// Force session cleanup
if (function_exists('session_gc')) {
    session_gc();
}

// Ensure session is completely destroyed
if (session_status() !== PHP_SESSION_NONE) {
    session_destroy();
}

if ($debug) {
    echo "<p>Session after logout:</p>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    echo "<p>Redirecting to: " . $paths['auth']['login'] . "</p>";
    echo "<p><a href='" . $paths['auth']['login'] . "'>Click here to continue</a></p>";
    exit;
}

// Redirect directly to login page
header("Location: " . $paths['auth']['login']);
exit;
