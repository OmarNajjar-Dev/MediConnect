<?php

// 4. Define required role for this dashboard
$requiredRole = 'ambulance_team';

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
    <main class="pt-16 sm:pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-xl">
            <div class="py-8">

                <!-- Header Section -->
                <div class="mb-8">
                    <p class="mb-1 text-sm text-gray-600">
                        Logged in as: <span class="font-medium">AMBULANCE TEAM</span>
                    </p>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        Welcome back, Emergency Response Team Alpha
                    </h1>
                    <p class="mt-1 text-sm text-primary">
                        City Emergency Services
                    </p>
                </div>

                <!-- Panel Title -->
                <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <i data-lucide="truck" class="h-8 w-8 text-red-600"></i>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-heading">
                            Emergency Response Panel
                        </h1>
                        <p class="text-gray-600">Ambulance Team Dashboard</p>
                    </div>
                </div>

                <!-- Emergency Alert Box -->
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-6 glass-card">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <i data-lucide="circle-alert" class="h-6 w-6 text-red-600"></i>
                            <div>
                                <h1 class="font-bold text-red-900">2 New Emergency Alert(s)</h1>
                                <p class="text-red-700">Immediate attention required</p>
                            </div>
                        </div>
                        <button
                            class="pointer rounded-md border border-solid border-input bg-danger transition-colors px-4 py-2 text-sm font-medium text-white hover:bg-red-500 w-full sm:w-auto">
                            View Alerts
                        </button>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="grid grid-cols-1 md:grid-cols-3 w-full gap-2 md:gap-0 md:h-10 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground outline-none">
                    <button
                        type="button"
                        data-target="active-emergencies"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 text-sm font-medium text-gray-900 transition-all pointer">
                        Active Emergencies
                    </button>

                    <button
                        type="button"
                        data-target="notifications"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 text-sm font-medium transition-all pointer">
                        Notifications
                        <div id="notification-count"
                            class="ml-2 inline-flex items-center rounded-full bg-red-500 px-2.5 py-0.5 text-xs font-semibold text-white">
                            2
                        </div>
                    </button>

                    <button
                        type="button"
                        data-target="team-status"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 text-sm font-medium transition-all pointer">
                        Team Status
                    </button>
                </div>

                <!-- Dashboard Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6 mt-2">
                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Requests</p>
                                <p class="text-2xl font-bold text-heading">2</p>
                            </div>
                            <i data-lucide="circle-alert" class="h-8 w-8 text-red-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pending</p>
                                <p class="text-2xl font-bold text-heading">1</p>
                            </div>
                            <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">In Progress</p>
                                <p class="text-2xl font-bold text-heading">0</p>
                            </div>
                            <i data-lucide="truck" class="h-8 w-8 text-blue-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Resolved</p>
                                <p class="text-2xl font-bold text-heading">0</p>
                            </div>
                            <i data-lucide="check-circle" class="h-8 w-8 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Emergency Requests List -->
                <div data-section="active-emergencies" class="glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Emergency Requests</h3>

                    <!-- Request Card 1 -->
                    <div class="mb-4 rounded-lg border border-solid border-card-soft bg-gray-50 p-4">
                        <div class="mb-3">
                            <div class="mb-2 flex flex-wrap items-center gap-2">
                                <h4 class="font-medium text-heading">Ahmed Al-Rashid</h4>
                                <span
                                    class="rounded-full border border-solid border-red-200 bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">CRITICAL</span>
                                <span
                                    class="rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800">PENDING</span>
                            </div>
                            <div class="mb-2 flex items-center gap-2 text-sm text-gray-600">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                                <span>123 Main Street, Downtown</span>
                            </div>
                            <p class="mb-2 text-gray-700">Chest pain and difficulty breathing</p>
                            <div class="text-xs text-gray-500">Reported: 18h ago</div>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button class="pointer rounded-md border border-solid border-input bg-medical-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary">Accept & Assign</button>
                            <button class="pointer rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">Update Status</button>
                            <button class="pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="map-pin" class="h-4 w-4"></i> View Location
                            </button>
                            <button class="pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="phone" class="h-4 w-4"></i> Call Patient
                            </button>
                        </div>
                    </div>

                    <!-- Request Card 2 -->
                    <div class="rounded-lg border border-solid border-card-soft bg-gray-50 p-4">
                        <div class="mb-3">
                            <div class="mb-2 flex flex-wrap items-center gap-2">
                                <h4 class="font-medium text-heading">Fatima Hassan</h4>
                                <span
                                    class="rounded-full border border-solid border-orange-200 bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800">HIGH</span>
                                <span
                                    class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">ASSIGNED</span>
                            </div>
                            <div class="mb-2 flex items-center gap-2 text-sm text-gray-600">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                                <span>456 Oak Avenue, North District</span>
                            </div>
                            <p class="mb-2 text-gray-700">Severe allergic reaction</p>
                            <div class="text-xs text-gray-500">Reported: 19h ago &nbsp; | &nbsp; ETA: 6:00 PM</div>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button class="pointer rounded-md border border-solid border-input bg-medical-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary">Start Response</button>
                            <button class="pointer rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">Update Status</button>
                            <button class="pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="map-pin" class="h-4 w-4"></i> View Location
                            </button>
                            <button class="pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="phone" class="h-4 w-4"></i> Call Patient
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Emergency Notifications -->
                <div data-section="notifications" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Emergency Notifications</h3>

                    <div class="flex flex-col gap-3">
                        <!-- Notification 1 -->
                        <div class="notification-card p-4 rounded-lg border border-solid border-red-200 bg-red-50 pointer">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-medium text-heading">Critical Emergency Alert</h4>
                                    <p class="mt-1 text-gray-700">New critical emergency reported at 123 Main Street</p>
                                    <p class="mt-2 text-xs text-gray-500">18h ago</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="red-dot w-2 h-2 rounded-full bg-danger"></div>
                                    <div class="new-badge inline-flex items-center rounded-full border border-transparent bg-danger px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-red-500">
                                        NEW
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notification 2 -->
                        <div class="notification-card p-4 rounded-lg border border-solid border-red-200 bg-red-50 pointer">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-medium text-heading">Emergency Assignment</h4>
                                    <p class="mt-1 text-gray-700">You have been assigned to emergency case #2</p>
                                    <p class="mt-2 text-xs text-gray-500">19h ago</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="red-dot w-2 h-2 rounded-full bg-danger"></div>
                                    <div class="new-badge inline-flex items-center rounded-full border border-transparent bg-danger px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-red-500">
                                        NEW
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Status -->
                <div data-section="team-status" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Team Status</h3>

                    <div class="flex flex-col gap-4">
                        <!-- Team Alpha -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-green-200 bg-green-50 p-4">
                            <div>
                                <p class="font-medium text-green-900">Team Alpha (Your Team)</p>
                                <p class="text-sm text-green-700">Available - On Standby</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                READY
                            </div>
                        </div>

                        <!-- Team Beta -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-blue-200 bg-blue-50 p-4">
                            <div>
                                <p class="font-medium text-blue-900">Team Beta</p>
                                <p class="text-sm text-blue-700">En Route - ETA 8 minutes</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors hover:bg-primary/80">
                                ACTIVE
                            </div>
                        </div>

                        <!-- Team Gamma -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-gray-200 bg-gray-50 p-4">
                            <div>
                                <p class="font-medium text-gray-900">Team Gamma</p>
                                <p class="text-sm text-gray-700">Off Duty - Maintenance</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-neutral-100 px-2.5 py-0.5 text-xs font-semibold text-gray-800 transition-colors hover:bg-primary/80">
                                OFFLINE
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
    <script type="module" src="/mediconnect/js/dashboard/ambulance/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>
