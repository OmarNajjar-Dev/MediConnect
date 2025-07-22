<?php

// 1. Load system configuration
require_once ROOT . "/src/config/path.php";

// 2. Load authentication logic (login state, remember me, etc.)
require_once ROOT . "/src/auth/auth.php";

// 3. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once ROOT . "/src/middleware/session-context.php";

$role = $_SESSION['user_role'] ?? null;

switch ($role) {
    case 'super_admin':
        include 'superadmin.php';
        break;
    case 'hospital_admin':
        include 'admin.php';
        break;
    case 'doctor':
        include 'doctor.php';
        break;
    case 'patient':
        include 'patient.php';
        break;
    case 'staff':
        include 'staff.php';
        break;
    case 'ambulance_team':
        include 'ambulance.php';
        break;
    default:
        header("Location: " . $paths['errors']['unauthorized']);
        exit;
}
