<?php

// 4. Define required role for this dashboard
$requiredRole = 'patient';

// 5. Protect the dashboard: redirect if user role does not match
require_once ROOT . "/src/middleware/protect-dashboard.php";

// 6. Include avatar helper
require_once ROOT . "/src/helpers/avatar-helper.php";

// 7. Fetch patient-specific information
$patientBirthdate = '';
$patientGender = '';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch patient profile data
    $stmt = $conn->prepare("
        SELECT 
            p.birthdate, 
            p.gender
        FROM patients p
        WHERE p.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($patient = $result->fetch_assoc()) {
        $patientBirthdate = $patient['birthdate'] ?? '';
        $patientGender = $patient['gender'] ?? '';
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
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/css/base.css" />
    <link rel="stylesheet" href="/assets/css/colors.css" />
    <link rel="stylesheet" href="/assets/css/typography.css" />
    <link rel="stylesheet" href="/assets/css/spacing.min.css" />
    <link rel="stylesheet" href="/assets/css/sizing.min.css" />
    <link rel="stylesheet" href="/assets/css/borders.css" />
    <link rel="stylesheet" href="/assets/css/ring.css">
    <link rel="stylesheet" href="/assets/css/layout.css" />
    <link rel="stylesheet" href="/assets/css/animations.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/responsive.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css">

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">

            <!-- Logo -->
            <a href="<?= $paths['home']['index'] ?>" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
                <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Home</a>
                <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Doctors</a>
                <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Hospitals</a>
                <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Appointments</a>
            </nav>

            <!-- Right section: Dropdown / Emergency / Auth -->
            <div class="flex items-center gap-4">

                <!-- User dropdown (visible if logged in) -->
                <div class="hidden md:flex items-center gap-3 md:mr-4">
                    <div class="dropdown relative">
                        <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 cursor-pointer rounded-lg">
                            <?= generateAvatar($userProfileImage, $userName, 'w-8 h-8', 'text-sm lg:text-base') ?>
                            <span class="hidden lg:block text-sm lg:text-base font-medium slate-700 max-w-24 truncate">
                                <?= htmlspecialchars($userName) ?>
                            </span>
                            <i data-lucide="chevron-down" class="w-4 h-4 slate-500"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div class="dropdown-content overflow-hidden hidden animate-fade-in absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-solid border-gray-100 z-50">
                            <div class="px-3 py-2 border-b border-solid border-medical-100">
                                <p class="text-sm font-medium slate-700"><?= htmlspecialchars($userName) ?></p>
                                <p class="text-xs slate-500"><?= htmlspecialchars($userEmail) ?></p>
                            </div>
                            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-primary hover:bg-medical-50 transition-colors transition-200">
                                <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                            </a>
                            <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none cursor-pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
                        <a href="#" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i> Dashboard
                        </a>
                        <a href="<?= $paths['auth']['logout'] ?>" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                        </a>
                    </div>
                </nav>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Logged in as: <span class="font-medium">PATIENT</span></p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, <?= htmlspecialchars($userName) ?></h1>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user" class="h-8 w-8 text-blue-600"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Patient Portal</h1>
                            <p class="text-gray-600">Welcome back, <?= htmlspecialchars($userName) ?></p>
                        </div>
                    </div>
                    <div>

                        <!-- Tab Navigation -->
                        <div
                            class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground cursor-pointer">
                            <button
                                type="button"
                                data-target="appointments"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium cursor-pointer">
                                Appointments
                            </button>

                            <button
                                type="button"
                                data-target="medical-history"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                                Medical history
                            </button>

                            <button
                                type="button"
                                data-target="my-profile"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                                My Profile
                            </button>
                        </div>

                        <!-- Appointments Section -->
                        <div data-section="appointments" class="mt-2">
                            <!-- Appointment Summary Cards: Upcoming, Completed, This Month -->
                            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Upcoming</p>
                                            <p class="text-2xl font-bold">2</p>
                                        </div>
                                        <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Completed</p>
                                            <p class="text-2xl font-bold">3</p>
                                        </div>
                                        <i data-lucide="file-text" class="h-8 w-8 text-green-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">This Month</p>
                                            <p class="text-2xl font-bold">2</p>
                                        </div>
                                        <i data-lucide="clock" class="h-8 w-8 text-purple-600"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Upcoming Appointments + Quick Actions -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Upcoming Appointments -->
                                <div class="glass-card rounded-xl p-6">
                                    <div class="mb-4 flex items-center justify-between">
                                        <h3 class="text-xl font-bold">Upcoming Appointments</h3>
                                        <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-transparent transition-colors bg-primary px-3 text-sm font-medium text-white hover:bg-medical-400 cursor-pointer gap-2 whitespace-nowrap">
                                            <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                            Book New
                                        </button>
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <!-- Appointment Card 1 -->
                                        <div class="rounded-lg bg-gray-50 p-4">
                                            <div class="mb-3 flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium">Dr. Sarah Johnson</p>
                                                    <p class="text-sm text-gray-600">Cardiology</p>
                                                    <p class="text-sm text-gray-600">Al Noor Medical Center</p>
                                                    <p class="mt-1 text-sm font-medium">2025-07-08 at 10:00</p>
                                                </div>
                                                <div class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                                    confirmed
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-input bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500 cursor-pointer gap-2 whitespace-nowrap transition-200">
                                                    <i data-lucide="square-pen" class="mr-1 h-4 w-4"></i>
                                                    Reschedule
                                                </button>
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-red-200 bg-background px-3 text-sm font-medium text-red-600 hover:bg-red-50 cursor-pointer gap-2 whitespace-nowrap transition-200">
                                                    <i data-lucide="x" class="mr-1 h-4 w-4"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Appointment Card 2 -->
                                        <div class="rounded-lg bg-gray-50 p-4">
                                            <div class="mb-3 flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium">Dr. Ahmed Hassan</p>
                                                    <p class="text-sm text-gray-600">General Medicine</p>
                                                    <p class="text-sm text-gray-600">City Hospital</p>
                                                    <p class="mt-1 text-sm font-medium">2025-07-12 at 14:30</p>
                                                </div>
                                                <div class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors hover:bg-primary/80">
                                                    scheduled
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-input bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500 cursor-pointer gap-2 whitespace-nowrap transition-colors transition-200">
                                                    <i data-lucide="square-pen" class="mr-1 h-4 w-4"></i>
                                                    Reschedule
                                                </button>
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-red-200 bg-background px-3 text-sm font-medium text-red-600 hover:bg-red-50 cursor-pointer gap-2 whitespace-nowrap transition-colors transition-200">
                                                    <i data-lucide="x" class="mr-1 h-4 w-4"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="glass-card rounded-xl p-6">
                                    <h3 class="mb-4 text-xl font-bold">Quick Actions</h3>
                                    <div class="flex flex-col gap-3">
                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 cursor-pointer gap-2 whitespace-nowrap transition-colors transition-200">
                                            <i data-lucide="calendar" class="mr-2 h-4 w-4"></i>
                                            Book New Appointment
                                        </button>
                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 cursor-pointer gap-2 whitespace-nowrap transition-colors transition-200">
                                            <i data-lucide="file-text" class="mr-2 h-4 w-4"></i>
                                            View Test Results
                                        </button>
                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 cursor-pointer gap-2 whitespace-nowrap transition-colors transition-200">
                                            <i data-lucide="clock" class="mr-2 h-4 w-4"></i>
                                            Request Prescription Refill
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical History Section -->
                        <div data-section="medical-history" class="mt-2">
                            <div class="glass-card rounded-xl p-6">
                                <h3 class="mb-4 text-xl font-bold">Appointment History</h3>
                                <div class="flex flex-col gap-3">
                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                        <div>
                                            <p class="font-medium">Dr. Sarah Johnson</p>
                                            <p class="mt-1 text-sm text-gray-600">Cardiology</p>
                                            <p class="mt-1 text-sm text-gray-500">ECG normal, continue medication</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">2025-06-15</p>
                                            <div class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors hover:bg-primary/80">
                                                completed
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                        <div>
                                            <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                            <p class="mt-1 text-sm text-gray-600">Dermatology</p>
                                            <p class="mt-1 text-sm text-gray-500">Skin condition treated successfully</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">2025-05-20</p>
                                            <div class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                                completed
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                        <div>
                                            <p class="font-medium">Dr. Mohammed Ali</p>
                                            <p class="mt-1 text-sm text-gray-600">Orthopedics</p>
                                            <p class="mt-1 text-sm text-gray-500">Joint pain assessment, recommended PT</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">2025-04-10</p>
                                            <div class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                                completed
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- My Profile Section -->
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
                                                <p data-profile-name class="text-gray-700 text-sm sm:text-base truncate"><?= htmlspecialchars($userName) ?></p>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm">Email</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate"><?= htmlspecialchars($userEmail) ?></p>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm">Date of Birth</label>
                                                <p data-profile-birthdate class="text-gray-700 text-sm sm:text-base truncate"><?= $patientBirthdate ? htmlspecialchars($patientBirthdate) : 'Not specified' ?></p>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm">Gender</label>
                                                <p data-profile-gender class="text-gray-700 text-sm sm:text-base truncate"><?= $patientGender ? htmlspecialchars($patientGender) : 'Not specified' ?></p>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm">City</label>
                                                <p data-profile-city class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                                    <?= htmlspecialchars($userCity) ?>
                                                </p>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm">Address</label>
                                                <p data-profile-address class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                                    <?= htmlspecialchars($userAddress) ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical history section showing past appointment details -->
                    <div data-section="medical-history" class="mt-2">
                        <div class="glass-card rounded-xl p-6">
                            <h3 class="mb-4 text-xl font-bold">Appointment History</h3>
                            <div class="flex flex-col gap-3">

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="mt-1 text-sm text-gray-600">Cardiology</p>
                                        <p class="mt-1 text-sm text-gray-500">ECG normal, continue medication</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-06-15</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors hover:bg-primary/80">
                                            completed
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                        <p class="mt-1 text-sm text-gray-600">Dermatology</p>
                                        <p class="mt-1 text-sm text-gray-500">Skin condition treated successfully</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-05-20</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                            completed
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Mohammed Ali</p>
                                        <p class="mt-1 text-sm text-gray-600">Orthopedics</p>
                                        <p class="mt-1 text-sm text-gray-500">Joint pain assessment, recommended PT</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-04-10</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                            completed
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
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                        <!-- Profile Birthdate  -->
                                        <div class="flex flex-col gap-2 mt-1.5">
                                            <label for="profile-birthdate" class="text-sm font-medium leading-none">Date of Birth</label>
                                            <input id="profile-birthdate" name="birthdate" type="date"
                                                class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                        </div>

                                        <div id="profile-gender" class="flex flex-col gap-2" data-dropdown="container">
                                            <!-- Select Gender -->
                                            <div class="relative">
                                                <label for="gender" class="block mb-2 text-sm text-heading font-medium">
                                                    Gender
                                                </label>

                                                <!-- Button that toggles dropdown -->
                                                <button type="button" role="combobox" data-dropdown="button"
                                                    class="flex h-10 w-full items-center justify-between cursor-pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
                                                    <span>Select gender</span>
                                                    <i data-lucide="chevron-down" class="w-4 h-4 opacity-50"></i>
                                                </button>

                                                <!-- Custom Dropdown Menu -->
                                                <ul data-dropdown="menu"
                                                    class="absolute z-10 mt-1.5 p-1 border border-solid border-input w-full bg-white rounded-md shadow-xl hidden">
                                                    <li>
                                                        <button type="button" data-dropdown="option"
                                                            class="w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-medical-50 hover:text-primary rounded-md cursor-pointer"
                                                            data-value="male">
                                                            <span>Male</span>
                                                            <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" data-dropdown="option"
                                                            class="w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-medical-50 hover:text-primary rounded-md cursor-pointer"
                                                            data-value="female">
                                                            <span>Female</span>
                                                            <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="gender" id="gender-input">
                                        </div>

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
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="<?= $paths['home']['index'] ?>" class="inline-block mb-4">
                        <span class="text-medical-700 font-semibold text-2xl">
                            Medi<span class="text-medical-500">Connect</span>
                        </span>
                    </a>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Connecting patients with healthcare professionals for better care
                        and outcomes.
                    </p>
                    <div class="footer-socials flex gap-4 transition-all">
                        <a href="#"
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="instagram" class="h-4 w-4"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Services
                    </h4>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Emergency Services
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Quick Links
                    </h4>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Blood Bank System
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Contact
                    </h4>
                    <ul class="flex flex-col gap-3">
                        <li class="flex gap-1">
                            <i data-lucide="map-pin" class="h-7 w-7 text-medical-500 pr-2"></i>
                            <span class="text-gray-600">
                                123 Healthcare Avenue, Medical District, City, Country
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="h-4 w-4 text-medical-500"></i>
                            <span class="text-gray-600">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="h-4 w-4 text-medical-500"></i>
                            <span class="text-gray-600">contact@mediconnect.example</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-solid separator text-center text-gray-600 text-sm">
                <p>&copy; 2025 MediConnect. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- External JavaScript -->
    <script type="module" src="/assets/js/common/index.js"></script>
    <script type="module" src="/assets/js/dashboard/patient/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>