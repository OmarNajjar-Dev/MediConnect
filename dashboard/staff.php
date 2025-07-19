<?php

// 4. Define required role for this dashboard
$requiredRole = 'staff';

// 5. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../backend/middleware/protect-dashboard.php";

// 6. Include avatar helper
require_once __DIR__ . "/../backend/helpers/avatar-helper.php";

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
    <link rel="stylesheet" href="/mediconnect/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/css/responsive.css" />
    <link rel="stylesheet" href="/mediconnect/css/dashboard.css">

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
                        <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 pointer rounded-lg">
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
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
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

                <!-- Staff Greeting & Panel Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">
                            Logged in as: <span class="font-medium">STAFF</span>
                        </p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Mary Williams</h1>
                        <p class="mt-1 text-sm text-primary">Al Noor Medical Center</p>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="calendar" class="h-8 w-8 text-purple-600 calendar-icon"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Staff Panel</h1>
                            <p class="text-gray-600">Appointment Management System</p>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div
                        class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground pointer">
                        <button
                            type="button"
                            data-target="Manage-Appointments"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium pointer">
                            Manage Appointments
                        </button>

                        <button
                            type="button"
                            data-target="Available-Doctors"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Available Doctors
                        </button>

                        <button
                            type="button"
                            data-target="Daily-Schedule"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Daily Schedule
                        </button>
                    </div>

                    <div class="mt-2 flex flex-col gap-6" style="animation-duration: 0s">
                        <!-- Quick statistics summary cards for today's overview -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

                            <!-- Today's Total -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Today's Total</p>
                                        <p class="text-2xl font-bold">4</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                </div>
                            </div>

                            <!-- Pending -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Pending</p>
                                        <p class="text-2xl font-bold">2</p>
                                    </div>
                                    <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                                </div>
                            </div>

                            <!-- Completed -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Completed</p>
                                        <p class="text-2xl font-bold">0</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-green-600"></i>
                                </div>
                            </div>

                            <!-- Available Doctors -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Available Doctors</p>
                                        <p class="text-2xl font-bold">3</p>
                                    </div>
                                    <i data-lucide="users" class="h-8 w-8 text-purple-600"></i>
                                </div>
                            </div>

                        </div>

                        <!-- Section to manage appointments with edit, delete, and assign options -->
                        <div data-section="Manage-Appointments" class="hidden glass-card rounded-xl p-6">
                            <!-- Header -->
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-xl font-bold">Appointment Management</h3>
                                <button
                                    class="pointer inline-flex h-10 items-center justify-center gap-2 rounded-md border border-input border-solid bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-medical-400 transition-colors">
                                    <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                    Create Appointment
                                </button>
                            </div>

                            <!-- Appointments List -->
                            <div class="flex flex-col gap-3">

                                <!-- Appointment: Ahmed Al-Rashid -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-success"></div>
                                        <div>
                                            <p class="font-medium">Ahmed Al-Rashid</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">Regular checkup - chest pain complaints</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 09:00</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                            confirmed
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Fatima Hassan -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Fatima Hassan</p>
                                            <p class="text-sm text-gray-600">follow-up • 45 min</p>
                                            <p class="text-sm text-gray-500">Follow-up on previous consultation</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Ahmed Hassan</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 10:30</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                            pending
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Mohammed Ali -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-info"></div>
                                        <div>
                                            <p class="font-medium">Mohammed Ali</p>
                                            <p class="text-sm text-gray-600">routine-checkup • 60 min</p>
                                            <p class="text-sm text-gray-500">Annual health screening</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 11:15</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors">
                                            in progress
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Layla Ibrahim -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Layla Ibrahim</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">New patient - needs doctor assignment</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Unassigned</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 14:00</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                            pending
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500">
                                            <i data-lucide="user" class="mr-1 h-4 w-4"></i>
                                            Assign
                                        </button>
                                        <button
                                            class="pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Section displaying currently available doctors and their specialties -->
                <div data-section="Available-Doctors" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold">Available Doctors</h3>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Sarah Johnson</p>
                                    <p class="text-sm text-gray-600">Cardiology</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Ahmed Hassan</p>
                                    <p class="text-sm text-gray-600">General Medicine</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">
                                    busy
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                    <p class="text-sm text-gray-600">Dermatology</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Mohammed Ali</p>
                                    <p class="text-sm text-gray-600">Orthopedics</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                    </div>
                </div>


                <!-- Section displaying today's scheduled appointments with status and timing -->
                <div data-section="Daily-Schedule" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold">Daily Schedule Overview</h3>

                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-1 gap-4">

                            <!-- 09:00 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">09:00</div>
                                    <div>
                                        <p class="font-medium">Ahmed Al-Rashid</p>
                                        <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    confirmed
                                </div>
                            </div>

                            <!-- 10:30 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">10:30</div>
                                    <div>
                                        <p class="font-medium">Fatima Hassan</p>
                                        <p class="text-sm text-gray-600">Dr. Ahmed Hassan</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                    pending
                                </div>
                            </div>

                            <!-- 11:15 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">11:15</div>
                                    <div>
                                        <p class="font-medium">Mohammed Ali</p>
                                        <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors">
                                    in progress
                                </div>
                            </div>

                            <!-- 14:00 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">14:00</div>
                                    <div>
                                        <p class="font-medium">Layla Ibrahim</p>
                                        <p class="text-sm text-gray-600">Unassigned</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                    pending
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
    <script type="module" src="/mediconnect/js/common/index.js"></script>
    <script type="module" src="/mediconnect/js/dashboard/staff/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>