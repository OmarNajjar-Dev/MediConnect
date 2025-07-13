<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../backend/config/path.php";

// 2. Load authentication logic (login state, remember me, etc.)
require_once __DIR__ . "/../backend/auth/auth.php";

// 3. Load user session context (sets $isLoggedIn, $userName, $userEmail, $dashboardLink)
require_once __DIR__ . "/../backend/middleware/session-context.php";

// 4. Define required role for this dashboard
$requiredRole = 'doctor';

// 5. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../backend/middleware/protect-dashboard.php";

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
    <link rel="stylesheet" href="../css/base.css" />
    <link rel="stylesheet" href="../css/colors.css" />
    <link rel="stylesheet" href="../css/typography.css" />
    <link rel="stylesheet" href="../css/spacing.min.css" />
    <link rel="stylesheet" href="../css/sizing.min.css" />
    <link rel="stylesheet" href="../css/borders.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/animations.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">

            <!-- Logo -->
            <a href="<?= $paths['home'] ?>" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
                <a href="<?= $paths['home'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Appointments</a>
            </nav>

            <!-- Right section: Auth / Dropdown / Emergency / Menu -->
            <div class="flex items-center gap-4">

                <!-- User dropdown (visible if logged in) -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="dropdown relative">
                        <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 pointer rounded-lg">
                            <div class="w-8 h-8 rounded-full bg-medical-100 flex items-center justify-center text-medical-700 text-sm lg:text-base font-medium">
                                <?= strtoupper(substr($userName, 0, 2)) ?>
                            </div>
                            <span class="hidden lg:block text-sm lg:text-base font-medium text-slate-700 max-w-24 truncate">
                                <?= htmlspecialchars($userName) ?>
                            </span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500"></i>
                        </button>

                        <!-- Dropdown menu content -->
                        <div class="dropdown-content overflow-hidden hidden animate-fade-in absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-solid border-gray-100 z-50">
                            <div class="px-3 py-2 border-b border-solid border-medical-100">
                                <p class="text-sm font-medium text-slate-700"><?= htmlspecialchars($userName) ?></p>
                                <p class="text-xs text-slate-500"><?= htmlspecialchars($userEmail) ?></p>
                            </div>

                            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-600 hover:text-medical-600 hover:bg-medical-50 transition-colors transition-200">
                                <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                            </a>

                            <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 lg:ml-2 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="../" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href=".<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href=".<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href=".<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
                        <a href="#" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-medical-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
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
                        <p class="text-sm text-gray-600 mb-1">Logged in as: <span class="font-medium">DOCTOR</span></p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Dr. Sarah Johnson</h1>
                        <p class="text-sm text-medical-600 mt-1">Al Noor Medical Center</p>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3"><i data-lucide="user" class="h-8 w-8 text-green-600"></i>

                        <div>
                            <h1 class="text-3xl font-bold">Doctor Panel</h1>
                            <p class="text-gray-600">Welcome, Dr. Sarah Johnson</p>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div
                        class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground pointer">
                        <button
                            type="button"
                            data-target="my-appointments"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium pointer">
                            My Appointments
                        </button>

                        <button
                            type="button"
                            data-target="schedule"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Schedule
                        </button>

                        <button
                            type="button"
                            data-target="profile"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Profile
                        </button>
                    </div>

                    <!-- My Appointments Section -->
                    <div data-section="my-appointments" class="hidden glass-card rounded-xl p-6">

                        <!-- Dashboard Stats Cards Section -->
                        <div class="mb-6 flex flex-col gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Today's Total</p>
                                            <p class="text-2xl font-bold">4</p>
                                        </div>
                                        <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Pending</p>
                                            <p class="text-2xl font-bold">2</p>
                                        </div>
                                        <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Completed</p>
                                            <p class="text-2xl font-bold">0</p>
                                        </div>
                                        <i data-lucide="file-text" class="h-8 w-8 text-green-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">In Progress</p>
                                            <p class="text-2xl font-bold">1</p>
                                        </div>
                                        <i data-lucide="user" class="h-8 w-8 text-purple-600"></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <h3 class="text-xl font-bold mb-4">Today's Appointments</h3>
                        <div class="flex flex-col gap-3">

                            <!-- Appointment 1 -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg">
                                <!-- Left Side: Patient Info -->
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-2 h-2 rounded-full bg-blue-600 mt-1"></div>
                                    <div>
                                        <p class="font-medium">John Smith</p>
                                        <p class="text-sm text-gray-600">consultation • 30 min</p>
                                        <p class="text-sm text-gray-500">Regular checkup - chest pain complaints</p>
                                    </div>
                                </div>

                                <!-- Right Side: Time, Status, Buttons -->
                                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 md:text-end">
                                    <div>
                                        <p class="font-medium text-end md:text-right">09:00</p>
                                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 inline-block w-fit">confirmed</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                            Update
                                        </button>
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                            Complete
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 2 -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-2 h-2 rounded-full bg-blue-600 mt-1"></div>
                                    <div>
                                        <p class="font-medium">Mary Johnson</p>
                                        <p class="text-sm text-gray-600">follow-up • 45 min</p>
                                        <p class="text-sm text-gray-500">Follow-up on ECG results</p>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 md:text-end">
                                    <div>
                                        <p class="font-medium text-end md:text-right">10:30</p>
                                        <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800 inline-block w-fit">in progress</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                            Update
                                        </button>
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                            Complete
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 3 -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-2 h-2 rounded-full bg-blue-600 mt-1"></div>
                                    <div>
                                        <p class="font-medium">Ahmed Al-Rashid</p>
                                        <p class="text-sm text-gray-600">consultation • 30 min</p>
                                        <p class="text-sm text-gray-500">New patient - hypertension concerns</p>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 md:text-end">
                                    <div>
                                        <p class="font-medium text-end md:text-right">11:15</p>
                                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800 inline-block w-fit">scheduled</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                            Update
                                        </button>
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                            Complete
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 4 -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-2 h-2 rounded-full bg-blue-600 mt-1"></div>
                                    <div>
                                        <p class="font-medium">Fatima Hassan</p>
                                        <p class="text-sm text-gray-600">routine-checkup • 60 min</p>
                                        <p class="text-sm text-gray-500">Annual cardiac screening</p>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 md:text-end">
                                    <div>
                                        <p class="font-medium text-end md:text-right">14:00</p>
                                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800 inline-block w-fit">scheduled</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                            Update
                                        </button>
                                        <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                            Complete
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 📅 Schedule Section - July 8 -->
                    <div data-section="schedule" class="mt-4 sm:mt-6">
                        <div class="glass-card rounded-xl p-4 sm:p-6">
                            <div class="mb-6">
                                <h3 class="text-lg sm:text-xl font-bold mb-2">Today's Schedule</h3>
                                <p class="text-sm text-gray-600">July 8, 2025</p>
                            </div>

                            <div class="flex flex-col gap-3">
                                <!-- Morning Clinic -->
                                <div class="rounded-lg border-2 border-solid border-green-200 bg-green-100 p-4 text-green-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="clock" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">09:00 - 12:00</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">Morning Clinic</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Patients</p>
                                            <p class="text-lg font-bold">8</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lunch Break -->
                                <div class="rounded-lg border-2 border-solid border-gray-200 bg-gray-100 p-4 text-gray-600">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="clock" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">12:00 - 13:00</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">Lunch Break</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Afternoon Clinic -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="clock" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">13:00 - 17:00</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">Afternoon Clinic</p>
                                        </div>
                                        <div class="ml-7 text-right sm:ml-0">
                                            <p class="text-xs text-gray-600">Patients</p>
                                            <p class="text-lg font-bold">6</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Administrative Work -->
                                <div class="rounded-lg border-2 border-solid border-blue-200 bg-blue-100 p-4 text-blue-800">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mb-1 flex items-center gap-3">
                                                <i data-lucide="clock" class="w-4 h-4 text-current"></i>
                                                <span class="text-sm sm:text-base font-medium">17:00 - 18:00</span>
                                            </div>
                                            <p class="ml-7 text-sm text-gray-700">Administrative Work</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="mt-6 rounded-lg bg-blue-50 p-4">
                                <div class="grid grid-cols-2 gap-4 text-center sm:grid-cols-3">
                                    <div>
                                        <p class="text-lg font-bold text-blue-600">14</p>
                                        <p class="text-xs text-gray-600">Total Patients</p>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-green-600">8</p>
                                        <p class="text-xs text-gray-600">Working Hours</p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-lg font-bold text-purple-600">1</p>
                                        <p class="text-xs text-gray-600">Break Hour</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Management Section -->
                    <div data-section="profile" class="hidden mt-4 sm:mt-6">
                        <div class="glass-card rounded-xl p-4 sm:p-6">

                            <!-- Header: Title and Edit Button -->
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                                <h3 class="text-lg sm:text-xl font-bold">Profile Management</h3>
                                <button class="w-full sm:w-auto h-10 px-4 py-2 rounded-md text-sm font-medium pointer inline-flex items-center justify-center gap-2 bg-medical-500 text-white hover:bg-medical-400 disabled:opacity-50 disabled:pointer-events-none border border-transparent">
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
                                            <span class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24">
                                                <span class="flex h-full w-full items-center justify-center rounded-full text-lg bg-medical-100 text-medical-700">
                                                    <?= strtoupper(substr($userName, 0, 2)) ?>
                                                </span>
                                            </span>
                                            <div class="w-full">
                                                <label for="profile-upload" class="text-sm font-medium leading-none pointer">
                                                    <div class="new-image flex items-center justify-center w-full p-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-medical-400 transition-colors">
                                                        <div class="flex flex-col text-center">
                                                            <i data-lucide="camera" class="mx-auto h-6 w-6 text-gray-400 mb-2"></i>
                                                            <span class="text-sm text-gray-600">Upload new image</span>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input type="file" id="profile-upload" accept="image/*" class="hidden">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Profile Details -->
                                <div class="lg:col-span-2 flex flex-col gap-4">

                                    <!-- Basic Info Grid -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">Full Name</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">Dr. Sarah Johnson</p>
                                        </div>
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">Email</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">sarah.johnson@alnoor.hospital</p>
                                        </div>
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">Phone</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">+1-555-0101</p>
                                        </div>
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">Hospital</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">Al Noor Medical Center</p>
                                        </div>
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">License Number</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">MD-12345</p>
                                        </div>
                                        <div class="min-w-0">
                                            <label class="font-medium text-sm">Experience</label>
                                            <p class="text-gray-700 text-sm sm:text-base truncate">8 years</p>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <label class="font-medium text-sm">Education</label>
                                            <p class="text-gray-700 text-sm sm:text-base">MD from Johns Hopkins University</p>
                                        </div>
                                        <div>
                                            <label class="font-medium text-sm">Bio</label>
                                            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                                Experienced cardiologist with over 8 years of practice. Specializing in interventional cardiology and heart disease prevention.
                                            </p>
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

    <!-- Footer -->
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="<?= $paths['home'] ?>" class="inline-block mb-4">
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
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
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
                            <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
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
                            <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['blood_donation'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Blood Donation
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
    <script type="module" src="../js/common/index.js"></script>
    <script type="module" src="../js/dashboard/doctors/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>