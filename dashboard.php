<?php
session_start();

// Redirect if not logged in
$_SESSION['user'] = [
    'username' => 'mariom',
    'role' => 'super_admin'
];
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['user']['role'];
$username = $_SESSION['user']['username'];

// Role groups
$can_manage_appointments = in_array($role, ['admin', 'doctor', 'nurse', 'staff', 'patient']);
$can_manage_users = in_array($role, ['super_admin', 'admin']);
$can_view_reports = in_array($role, ['super_admin', 'admin', 'viewer']);
$can_access_medical_records = in_array($role, ['doctor', 'nurse', 'patient']);
$can_access_pharmacy = ($role === 'pharmacist');
$can_access_emergency = ($role === 'ambulance_team');
$can_access_settings = in_array($role, ['super_admin', 'admin']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - <?= ucfirst($role) ?></title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <header style="padding: 1rem; background: #f5f5f5; display: flex; justify-content: space-between; align-items: center;">
        <h2>Welcome, <?= htmlspecialchars($username) ?> (<?= ucfirst($role) ?>)</h2>
        <a href="logout.php" style="text-decoration: underline;">Logout</a>
    </header>

    <main class="flex-1" style="padding: 2rem;">
        <div class="flex flex-col space-y-4">

            <?php if ($can_manage_appointments): ?>
                <section class="card">
                    <h3>Appointment Management</h3>
                    <p>You have access to manage or view appointments.</p>
                    <!-- Include your appointment logic/UI here -->
                </section>
            <?php endif; ?>

            <?php if ($can_manage_users): ?>
                <section class="card">
                    <h3>User Management</h3>
                    <p>Manage system users and assign roles.</p>
                    <!-- User management UI -->
                </section>
            <?php endif; ?>

            <?php if ($can_view_reports): ?>
                <section class="card">
                    <h3>Reports & Analytics</h3>
                    <p>View system usage statistics, health reports, and dashboards.</p>
                    <!-- Reporting UI -->
                </section>
            <?php endif; ?>

            <?php if ($can_access_medical_records): ?>
                <section class="card">
                    <h3>Medical Records</h3>
                    <p>Access or update patient medical information.</p>
                    <!-- Medical record UI -->
                </section>
            <?php endif; ?>

            <?php if ($can_access_pharmacy): ?>
                <section class="card">
                    <h3>Pharmacy Operations</h3>
                    <p>Manage prescriptions and stock medicine.</p>
                    <!-- Pharmacy logic -->
                </section>
            <?php endif; ?>

            <?php if ($can_access_emergency): ?>
                <section class="card">
                    <h3>Emergency Operations</h3>
                    <p>Handle emergency COVID-19 response or ambulance requests.</p>
                    <?php include 'sections/emergency_request.php'; ?>
                </section>
            <?php endif; ?>

            <?php if ($can_access_settings): ?>
                <section class="card">
                    <h3>System Settings</h3>
                    <p>Access configuration settings for the platform.</p>
                    <!-- Settings UI -->
                </section>
            <?php endif; ?>

            <?php if (!$can_manage_appointments && !$can_manage_users && !$can_view_reports && !$can_access_medical_records && !$can_access_pharmacy && !$can_access_emergency && !$can_access_settings): ?>
                <section class="card">
                    <h3>No Access</h3>
                    <p>Your role does not have access to any dashboard modules.</p>
                </section>
            <?php endif; ?>

        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>