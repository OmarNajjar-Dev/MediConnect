<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load authentication logic (login state, remember me, etc.)
require_once __DIR__ . "/../../backend/auth/auth.php";

// 3. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

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

    case 'ambulance_team':
        include 'ambulance.php';
        break;
    default:
        header("Location: " . $paths['errors']['unauthorized']);
        exit;
}
