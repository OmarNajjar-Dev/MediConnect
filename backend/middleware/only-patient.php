<?php

require_once __DIR__ . '/../config/path.php';
require_once __DIR__ . '/../auth/auth.php';

// If the user is registered but not of type "patient", block them
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] !== 'patient') {
    header("Location: " . $paths['errors']['forbidden']);
    exit;
}
