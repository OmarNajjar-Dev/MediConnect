<?php

require_once __DIR__ . '/../auth/auth.php'; // Handles session & auto-login if cookie exists
require_once __DIR__ . '/../config/db.php';   // Includes MySQLi DB connection as $conn

// Default state (not logged in)
$isLoggedIn = false;
$userName = '';
$userEmail = '';
$dashboardLink = './login.php'; // Fallback if user is not authenticated

// Check if user is logged in via session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user's basic information
    $stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $isLoggedIn = true;
        $userName = $user['first_name'] . ' ' . $user['last_name'];
        $userEmail = $user['email'];

        // Fetch user's role from user_roles → roles
        $roleStmt = $conn->prepare("
      SELECT r.role_name 
      FROM roles r
      JOIN user_roles ur ON ur.role_id = r.role_id
      WHERE ur.user_id = ?
      LIMIT 1
    ");
        $roleStmt->bind_param("i", $userId);
        $roleStmt->execute();
        $roleResult = $roleStmt->get_result();

        if ($roleRow = $roleResult->fetch_assoc()) {
            $role = $roleRow['role_name'];

            // Set dashboard link based on user's role
            switch ($role) {
                case 'Super Admin':
                    $dashboardLink = './dashboard/superadmin.php';
                    break;
                case 'Admin':
                    $dashboardLink = './dashboard/admin.php';
                    break;
                case 'Doctor':
                    $dashboardLink = './dashboard/doctor.php';
                    break;
                case 'Patient':
                    $dashboardLink = './dashboard/patient.php';
                    break;
                case 'Staff':
                    $dashboardLink = './dashboard/staff.php';
                    break;
                case 'Ambulance Team':
                    $dashboardLink = './dashboard/ambulance.php';
                    break;
                default:
                    $dashboardLink = './dashboard/index.php'; // Fallback for unknown roles
            }
        }
    }
}
