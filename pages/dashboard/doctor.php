<?php

// 1. Start session and load user context
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 2. Load path configuration
require_once __DIR__ . "/../../backend/config/path.php";

// 3. Define required role for this dashboard
$requiredRole = 'doctor';

// 4. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../../backend/middleware/protect-dashboard.php";

// 6. Include avatar helper
require_once __DIR__ . "/../../backend/helpers/avatar-helper.php";

// 7. Include doctor appointment helper
require_once __DIR__ . "/../../backend/helpers/doctor-appointment-helper.php";

// 8. Fetch doctor-specific information
$doctorBio = '';
$doctorHospital = '';
$doctorSpecialty = '';
$doctorId = null;
$todayAppointments = [];
$todayStats = [];

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $doctorId = getDoctorIdFromUserId($userId);

    // Fetch doctor profile data
    $stmt = $conn->prepare("
        SELECT 
            d.bio, 
            h.name AS hospital_name, 
            s.name AS specialty_name 
        FROM doctors d
        LEFT JOIN hospitals h ON d.hospital_id = h.hospital_id
        LEFT JOIN specialties s ON d.specialty_id = s.specialty_id
        WHERE d.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($doctor = $result->fetch_assoc()) {
        $doctorBio = $doctor['bio'] ?? '';
        $doctorHospital = $doctor['hospital_name'] ?? 'Hospital not assigned';
        $doctorSpecialty = $doctor['specialty_name'] ?? 'Specialty not assigned';
    }

    // Fetch upcoming appointments and stats (next 7 days)
    if ($doctorId) {
        $today = date('Y-m-d');
        $nextWeek = date('Y-m-d', strtotime('+7 days'));
        $todayAppointments = getDoctorAppointments($doctorId, null, null); // Get all upcoming appointments
        $todayStats = getDoctorAppointmentStats($doctorId, $today);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Lucide Icons -->
    <?php require_once __DIR__ . '/../../backend/config/apis.php'; ?>
    <script src="<?= LUCIDE_CDN_URL ?>"></script>

    <!-- Base Styles -->
    <link rel="stylesheet" href="/assets/css/base/base.css" />
    <link rel="stylesheet" href="/assets/css/base/typography.css" />

    <!-- Design System -->
    <link rel="stylesheet" href="/assets/css/utils/colors.css" />
    <link rel="stylesheet" href="/assets/css/utils/spacing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/sizing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/borders.css" />
    <link rel="stylesheet" href="/assets/css/utils/ring.css" />

    <!-- Layout & Components -->
    <link rel="stylesheet" href="/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/assets/css/components/animations.css" />

    <!-- Page Specific Styles -->
    <link rel="stylesheet" href="/assets/css/pages/dashboard.css" />

    <!-- Custom Styles (Overrides) -->
    <link rel="stylesheet" href="/assets/css/base/style.css" />

    <!-- Responsive Design -->
    <link rel="stylesheet" href="/assets/css/layout/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Logged in as: <span class="font-medium">DOCTOR</span></p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Dr. <?= $userName ?></h1>
                        <p class="text-sm text-primary mt-1"><?= htmlspecialchars($doctorHospital) ?></p>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3"><i data-lucide="user" class="h-8 w-8 text-green-600"></i>

                        <div>
                            <h1 class="text-3xl font-bold">Doctor Panel</h1>
                            <p class="text-gray-600">Welcome, Dr. <?= $userName ?></p>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div
                        class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground cursor-pointer">
                        <button
                            type="button"
                            data-target="my-appointments"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium cursor-pointer">
                            My Appointments
                        </button>

                        <button
                            type="button"
                            data-target="schedule"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                            Schedule
                        </button>

                        <button
                            type="button"
                            data-target="my-profile"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                            My Profile
                        </button>
                    </div>

                    <!-- My Appointments Section -->
                    <div data-section="my-appointments" class="glass-card rounded-xl p-6">

                        <!-- Dashboard Stats Cards Section -->
                        <div class="mb-6 flex flex-col gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Today's Total</p>
                                            <p class="text-2xl font-bold"><?= $todayStats['total'] ?? 0 ?></p>
                                        </div>
                                        <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Scheduled</p>
                                            <p class="text-2xl font-bold"><?= $todayStats['scheduled'] ?? 0 ?></p>
                                        </div>
                                        <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Completed</p>
                                            <p class="text-2xl font-bold"><?= $todayStats['completed'] ?? 0 ?></p>
                                        </div>
                                        <i data-lucide="file-text" class="h-8 w-8 text-green-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Cancelled</p>
                                            <p class="text-2xl font-bold"><?= $todayStats['cancelled'] ?? 0 ?></p>
                                        </div>
                                        <i data-lucide="x-circle" class="h-8 w-8 text-red-600"></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <h3 class="text-xl font-bold mb-4">Upcoming Appointments</h3>
                        <div id="appointments-container" class="flex flex-col gap-3">
                            <?php if (empty($todayAppointments)): ?>
                                <div class="text-center py-8 text-gray-500">
                                    <i data-lucide="calendar-x" class="h-12 w-12 mx-auto mb-4 text-gray-300"></i>
                                    <p class="text-lg font-medium">No upcoming appointments</p>
                                    <p class="text-sm">You have no scheduled appointments in the next 7 days.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($todayAppointments as $appointment): ?>
                                    <div class="appointment-item flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg" data-appointment-id="<?= $appointment['appointment_id'] ?>">
                                        <!-- Left Side: Patient Info -->
                                        <div class="flex items-start gap-4 flex-1">
                                            <div class="w-2 h-2 rounded-full bg-info mt-1"></div>
                                            <div>
                                                <p class="font-medium"><?= htmlspecialchars($appointment['patient_name']) ?></p>
                                                <p class="text-sm text-gray-600">consultation • 30 min</p>
                                                <p class="text-sm text-gray-500"><?= htmlspecialchars($appointment['notes'] ?: 'No additional notes') ?></p>
                                            </div>
                                        </div>

                                        <!-- Right Side: Time, Status, Buttons -->
                                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 md:text-end">
                                            <div>
                                                <p class="font-medium text-end md:text-right"><?= formatAppointmentDateTime($appointment['appointment_date']) ?></p>
                                                <span class="text-xs px-2 py-1 rounded-full <?= getAppointmentStatusClasses($appointment['status']) ?> inline-block w-fit">
                                                    <?= getAppointmentStatusText($appointment['status']) ?>
                                                </span>
                                            </div>
                                            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                                <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-gray-100 text-gray-500 h-9 rounded-md px-3 cursor-not-allowed opacity-50" title="Update functionality coming soon">
                                                    <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                                    Update
                                                </button>
                                                <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-gray-300 text-gray-500 h-9 rounded-md px-3 cursor-not-allowed opacity-50" title="Complete functionality coming soon">
                                                    Complete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- 📅 Schedule Section -->
                    <div data-section="schedule" class="hidden mt-4 sm:mt-6">
                        <div class="glass-card rounded-xl p-4 sm:p-6">
                            <div class="mb-6">
                                <h3 class="text-lg sm:text-xl font-bold mb-2">Weekly Schedule</h3>
                                <p class="text-sm text-gray-600"><?= date('F j, Y') ?> - <?= date('F j, Y', strtotime('+6 days')) ?></p>
                            </div>

                            <div class="flex flex-col gap-3">
                                <!-- Monday -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Monday</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">General Clinic Hours: 9:00 AM - 5:00 PM</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-green-600">Available</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tuesday -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Tuesday</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">General Clinic Hours: 9:00 AM - 5:00 PM</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-green-600">Available</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Wednesday -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Wednesday</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">General Clinic Hours: 9:00 AM - 5:00 PM</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-green-600">Available</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thursday -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Thursday</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">General Clinic Hours: 9:00 AM - 5:00 PM</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-green-600">Available</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Friday -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Friday</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">General Clinic Hours: 9:00 AM - 5:00 PM</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-green-600">Available</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Weekend -->
                                <div class="rounded-lg border-2 border-solid border-gray-200 bg-gray-100 p-4 text-gray-600">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="calendar" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">Weekend</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">Saturday & Sunday - Emergency Only</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Status</p>
                                            <p class="text-sm font-bold text-orange-600">Emergency</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="mt-6 rounded-lg bg-blue-50 p-4">
                                <div class="grid grid-cols-2 gap-4 text-center sm:grid-cols-3">
                                    <div>
                                        <p class="text-lg font-bold text-blue-600">5</p>
                                        <p class="text-xs text-gray-600">Working Days</p>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-green-600">40</p>
                                        <p class="text-xs text-gray-600">Hours/Week</p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-lg font-bold text-orange-600">2</p>
                                        <p class="text-xs text-gray-600">Emergency Days</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Management Section -->
                    <div data-section="my-profile" class="hidden mt-4 sm:mt-6">
                        <div class="glass-card rounded-xl p-4 sm:p-6">

                            <!-- Header: Title and Edit Button -->
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                                <h3 class="text-lg sm:text-xl font-bold">Profile Management</h3>
                                <button id="edit-profile-btn" class="w-full sm:w-auto h-10 px-4 py-2 rounded-md text-sm font-medium cursor-pointer inline-flex items-center justify-center gap-2 bg-primary text-white hover:bg-medical-400 border border-transparent">
                                    <i data-lucide="square-pen" class="h-4 w-4 mr-2"></i>
                                    Edit Profile
                                </button>
                            </div>

                            <!-- Profile Content Grid -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                                <!-- Profile Picture Upload -->
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                                    <div class="flex flex-col gap-1.5 p-6">
                                        <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                                            <i data-lucide="camera" class="h-5 w-5"></i>
                                            Profile Picture
                                        </h3>
                                        <p class="text-sm text-muted-foreground">Update your profile image</p>
                                    </div>
                                    <div class="px-6 pb-6 flex flex-col gap-4">
                                        <div class="flex flex-col gap-4 items-center">
                                            <div class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24">
                                                <?= generateAvatar($userProfileImage, $userName, 'w-24 h-24', 'text-lg') ?>
                                            </div>
                                            <div class="w-full">
                                                <div class="flex items-center justify-center w-full p-3 border border-gray-200 rounded-lg bg-gray-50">
                                                    <div class="flex flex-col text-center">
                                                        <i data-lucide="info" class="mx-auto h-5 w-5 text-gray-400 mb-2"></i>
                                                        <span class="text-xs text-gray-500">Click "Edit Profile" to change your image</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Profile Details -->
                                <div class="lg:col-span-2 flex flex-col gap-4">

                                    <!-- Basic Info Grid -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="font-medium text-sm">Full Name</label>
                                            <p data-profile-name class="text-gray-700 text-sm sm:text-base truncate">Dr. <?= htmlspecialchars($userName) ?></p>
                                        </div>
                                        <div>
                                            <label class="font-medium text-sm">Email</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate"><?= htmlspecialchars($userEmail) ?></p>
                                        </div>
                                        <div>
                                            <label class="font-medium text-sm">Hospital</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate"><?= htmlspecialchars($doctorHospital) ?></p>
                                        </div>
                                        <div>
                                            <label class="font-medium text-sm">Specialty</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate"><?= htmlspecialchars($doctorSpecialty) ?></p>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <label class="font-medium text-sm">Professional Bio</label>
                                            <?php if ($doctorBio): ?>
                                                <p data-profile-bio class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                                    <?= htmlspecialchars($doctorBio) ?>
                                                </p>
                                            <?php else: ?>
                                                <p data-profile-bio class="text-gray-500 text-sm sm:text-base leading-relaxed italic">
                                                    No bio available. Click "Edit Profile" to add your professional background.
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <!-- ==================== Edit Profile Modal ==================== -->
    <div id="edit-profile-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Overlay -->
            <div id="edit-profile-overlay" class="fixed inset-0 bg-black/80"></div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-lg shadow-lg w-full max-w-5xl animate-fade-in-up">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-6 border-b border-solid border-gray-200">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user" class="h-6 w-6 text-primary"></i>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Edit Profile</h2>
                            <p class="text-sm text-muted-foreground">Update your personal information and profile picture</p>
                        </div>
                    </div>
                    <button id="close-profile-modal-btn" class="flex items-center text-gray-500 hover:text-gray-800 cursor-pointer bg-transparent border-none rounded-full transition-colors focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="edit-profile-form" novalidate>
                    <div class="p-6">
                        <!-- Profile Picture & Personal Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                            <!-- Profile Picture Upload -->
                            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                                <div class="flex flex-col gap-1.5 p-6">
                                    <h3 class="text-xl font-semibold leading-none tracking-tight flex items-center gap-2">
                                        <i data-lucide="camera" class="h-5 w-5"></i>
                                        Profile Picture
                                    </h3>
                                    <p class="text-sm text-muted-foreground">Update your profile image</p>
                                </div>
                                <div class="px-6 pb-6 flex flex-col gap-4">
                                    <div class="flex flex-col gap-4 items-center">
                                        <div id="profile-image-preview-container" class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24">
                                            <?= generateAvatar($userProfileImage, $userName, 'w-24 h-24', 'text-lg') ?>
                                        </div>
                                        <div class="w-full">
                                            <label for="profile-upload" class="text-sm font-medium leading-none cursor-pointer">
                                                <div id="new-image-profile" class="flex items-center justify-center w-full p-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-medical-400 transition-colors">
                                                    <div class="flex flex-col text-center">
                                                        <i data-lucide="camera" class="mx-auto h-6 w-6 text-gray-400 mb-2"></i>
                                                        <span class="text-sm text-gray-600">Upload new image</span>
                                                    </div>
                                                </div>
                                            </label>
                                            <input type="file" id="profile-upload" name="profile_image" accept="image/*" class="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="rounded-lg border bg-card text-card-foreground shadow-sm lg:col-span-2">
                                <div class="flex flex-col gap-1.5 p-6">
                                    <h3 class="text-xl font-semibold leading-none tracking-tight flex items-center gap-2">
                                        <i data-lucide="user" class="h-5 w-5"></i>
                                        Personal Information
                                    </h3>
                                    <p class="text-sm text-muted-foreground">Update your basic information</p>
                                </div>
                                <div class="px-6 pb-6 flex flex-col gap-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="flex flex-col gap-2">
                                            <label for="profile-name" class="text-sm font-medium leading-none">Full Name</label>
                                            <input id="profile-name" name="name" placeholder="Enter your full name"
                                                class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white" required>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="profile-email" class="text-sm font-medium leading-none">Email Address</label>
                                            <input id="profile-email" name="email" type="email" placeholder="Enter your email" disabled
                                                class="flex h-10 w-full rounded-md border border-solid border-input bg-gray-50 px-3 py-2 text-base md:text-sm text-gray-600 cursor-not-allowed">
                                            <p class="text-xs text-gray-500 mt-1">
                                                <i data-lucide="shield" class="h-3 w-3 inline mr-1"></i>
                                                Email cannot be changed for security reasons
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="profile-bio" class="text-sm font-medium leading-none">Professional Bio</label>
                                        <textarea id="profile-bio" name="bio" rows="4" placeholder="Tell us about your medical background, specialties, and experience..."
                                            class="flex w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"></textarea>
                                        <p class="text-xs text-gray-500 mt-1">This information will be displayed to patients and colleagues.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 p-6 border-t border-solid border-gray-200 bg-gray-50">
                        <button type="button" id="cancel-profile-edit-btn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-white hover:bg-gray-100 h-10 px-6 py-2 cursor-pointer hover:bg-medical-50 hover:text-primary">
                            <i data-lucide="x" class="h-4 w-4"></i>
                            Cancel
                        </button>
                        <button type="button" id="discard-profile-changes-btn" class="hidden inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors text-yellow-700 border border-solid border-warning hover:bg-yellow-100 bg-yellow-50 hover:bg-yellow-100 h-10 px-6 py-2 cursor-pointer">
                            <i data-lucide="undo" class="h-4 w-4"></i>
                            Discard Changes
                        </button>
                        <button type="submit" id="save-profile-changes-btn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors text-white h-10 px-6 py-2 bg-primary hover:bg-medical-600 border border-solid border-transparent cursor-pointer">
                            <span id="save-profile-text">Save Changes</span>
                            <div id="save-profile-loading" class="hidden animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Universal Toast Container -->
    <div
        id="toast"
        class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg">
        <p id="toast-title" class="font-semibold"></p>
        <p id="toast-message" class="text-sm"></p>
    </div>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/assets/js/common/index.js"></script>
    <script type="module" src="/assets/js/dashboard/doctor/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>