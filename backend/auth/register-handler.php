<?php

// 1. Show all errors during development (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Load configuration and helpers
require_once __DIR__ . '/../config/path.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/registration-helpers.php';

// 4. Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 5. Get data from POST request
    $userData = [
        'email'        => $_POST["email"]        ?? '',
        'password'     => $_POST["password"]     ?? '',
        'first_name'   => $_POST["first_name"]   ?? '',
        'last_name'    => $_POST["last_name"]    ?? '',
        'city'         => $_POST["city"]         ?? '',
        'address'      => $_POST["address"]      ?? '',
        'hospital_id'  => $_POST["hospital_id"]  ?? null,
        'specialty_id' => $_POST["specialty_id"] ?? null,
        'team_name'    => $_POST["team_name"]    ?? null
    ];

    $slugRole = $_POST["role"] ?? '';

    // 6. Convert slug to role title
    $roleName = slugToTitle($slugRole);

    // 7. Validate role
    if (!validateRole($roleName)) {
        header("Location: " . $paths['auth']['register'] . "?error=invalid_role");
        exit();
    }

    // 8. Validate email format
    if (!validateEmail($userData['email'])) {
        header("Location: " . $paths['auth']['register'] . "?error=invalid_email");
        exit();
    }

    // 9. Check if email already exists
    if (emailExists($conn, $userData['email'])) {
        header("Location: " . $paths['auth']['register'] . "?error=email_exists");
        exit();
    }

    // 10. Create user account
    $result = createUserAccount($conn, $userData, $roleName);

    if ($result['success']) {
        // 11. Initialize user session
        initializeUserSession($result['user_id'], $roleName);

        // 12. Redirect to dashboard
        header("Location: " . $paths['dashboard']['index']);
        exit();
    } else {
        // 13. Redirect with error
        header("Location: " . $paths['auth']['register'] . "?error=" . urlencode($result['error']));
        exit();
    }
}

// 14. If not POST method
header("Location: " . $paths['auth']['register']);
exit();
