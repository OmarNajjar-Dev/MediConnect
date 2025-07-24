<?php

// Load fallback helper
require_once __DIR__ . '/../helpers/session-fallback.php';

// Redirect to unauthorized page if user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: " . $paths['errors']["unauthorized"]);
    exit;
}

// Stop if the required role is not defined in the page
if (!isset($requiredRole)) {
    header("Location: " . $paths["errors"]["server"]);
    exit;
}

// Get the user's role using fallback system
$userRole = getCurrentUserRole($conn, $_SESSION['user_id']);

// Debug logging for session issues
if (!$userRole) {
    error_log("Session debug - User ID: " . $_SESSION['user_id'] . ", Required Role: " . $requiredRole);
    error_log("Session debug - All session data: " . print_r($_SESSION, true));
}

// Redirect to unauthorized page if user role doesn't match
if ($userRole !== $requiredRole) {
    header("Location: " . $paths["errors"]["forbidden"]);
    exit;
}
