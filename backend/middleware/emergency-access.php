<?php

require_once __DIR__ . '/../config/path.php';

// Allow access if user is not logged in (guest)
if (!isset($_SESSION['user_id'])) {
    return; // Allow access for guests
}

// Allow access if user is a patient
if ($_SESSION['user_role'] === 'patient') {
    return; // Allow access for patients
}

// Block access for all other roles (doctors, admin, etc.)
header("Location: " . $paths['errors']['forbidden']);
exit; 