<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail)
require_once __DIR__ . "/backend/middleware/session-context.php";

// 3. Include avatar helper
require_once __DIR__ . "/backend/helpers/avatar-helper.php";

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
    <link rel="stylesheet" href="/mediconnect/css/components.css" />
    <link rel="stylesheet" href="/mediconnect/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/css/responsive.css" />

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

            <!-- Right section: Auth / Dropdown / Emergency / Menu -->
            <div class="flex items-center gap-4">

                <?php if ($isLoggedIn): ?>
                    <!-- User dropdown (visible if logged in) -->
                    <div class="hidden md:flex items-center gap-3 mr-4">
                        <div class="dropdown relative">
                            <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 cursor-pointer rounded-lg">
                                <?= generateAvatar($userProfileImage, $userName, 'w-8 h-8', 'text-sm lg:text-base') ?>
                                <span class="hidden lg:block text-sm lg:text-base font-medium slate-700 max-w-24 truncate">
                                    <?= htmlspecialchars($userName) ?>
                                </span>
                                <i data-lucide="chevron-down" class="w-4 h-4 slate-500"></i>
                            </button>

                            <!-- Dropdown menu content -->
                            <div class="dropdown-content overflow-hidden hidden animate-fade-in absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-solid border-gray-100 z-50">
                                <div class="px-3 py-2 border-b border-solid border-medical-100">
                                    <p class="text-sm font-medium slate-700"><?= htmlspecialchars($userName) ?></p>
                                    <p class="text-xs slate-500"><?= htmlspecialchars($userEmail) ?></p>
                                </div>

                                <a href="<?= $paths['dashboard']['index'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-primary hover:bg-medical-50 transition-colors transition-200">
                                    <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                                </a>

                                <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <?php if (!$isLoggedIn): ?>
                    <!-- Sign In / Sign Up (visible if not logged in) -->
                    <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all md:ml-4">
                        Sign In
                    </a>

                    <a href="<?= $paths['auth']['register'] ?>" class="hidden lg:flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                        Sign Up
                    </a>
                <?php endif; ?>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none cursor-pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href=" <?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <!-- Mobile: Sign In / Sign Out depending on session -->
                    <?php if (!$isLoggedIn): ?>
                        <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                            <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                            <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
                            <a href="<?= $paths['dashboard']['index'] ?>" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i> Dashboard
                            </a>
                            <a href="<?= $paths['auth']['logout'] ?>" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                            </a>
                        </div>
                    <?php endif; ?>
                </nav>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="overflow-hidden pt-20 flex-grow">
        <div class="flex flex-col">
            <section class="bg-red-50 py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h1 class="text-heading text-3xl md:text-4xl font-bold mb-4">
                            COVID-19 Emergency Response
                        </h1>
                        <p class="text-lg text-gray-700 mb-8">
                            Request immediate medical assistance for COVID-19 related emergencies
                        </p>
                        <div id="request-help-wrapper" class="flex flex-col gap-6">
                            <button
                                id="request-help-btn"
                                class="gap-2 whitespace-nowrap border border-solid border-input h-10 bg-danger hover:bg-red-700 text-white font-bold py-4 px-8 rounded-sm text-lg shadow-lg flex items-center justify-center w-full md:w-auto md:max-w-[310px] cursor-pointer transition-colors">
                                <i data-lucide="ambulance" class="mr-2 h-4 w-4"></i>
                                Request Emergency Help
                            </button>
                            <p class="text-sm text-gray-600">
                                For COVID-19 emergencies only. Tap above to connect with specialized medical responders.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="status-section" class="hidden py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-8">
                            <div class="flex flex-col gap-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none text-heading tracking-tight flex items-center">
                                    <i data-lucide="ambulance" class="mr-2 text-medical-500"></i>
                                    Emergency Response Status
                                </h3>
                                <p class="text-sm text-muted-foreground">COVID-19 specialized medical team status and location</p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="flex flex-col gap-6">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="text-center">
                                            <div
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent text-white hover:bg-medical-400 bg-medical-500 mb-2">
                                                EN ROUTE TO YOUR LOCATION</div>
                                            <div class="mb-4"><i data-lucide="ambulance" class="h-16 w-16 mx-auto text-medical-500"></i>
                                            </div>
                                            <h3 class="text-xl text-heading font-bold">COVID-19 Response Team En Route</h3>
                                            <div class="flex items-center justify-center mt-2"><i data-lucide="clock" class="mr-2 text-medical-500"></i>

                                                <p class="text-gray-800 font-semibold">Estimated arrival: 10 minutes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-lg overflow-hidden h-62.5">
                                        <div class="h-full flex items-center justify-center bg-gray-100 p-4">
                                            <p class="text-center text-gray-600">Please set your Mapbox token in the Contact page
                                                to enable emergency map tracking.</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-4">
                                        <h4 class="font-semibold text-heading text-lg">What to expect:</h4>
                                        <ul class="flex flex-col gap-2">
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>

                                                <p class="text-heading">
                                                    Ambulance staff will be wearing full COVID-19 protective equipment</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    You may be asked screening questions about your symptoms</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    Please wear a mask if available</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pt-4 border-t">
                                        <h4 class="font-semibold text-heading text-center">Emergency Contact Options</h4>
                                        <div class="flex justify-center gap-4 mt-4"><button
                                                class="justify-center gap-2 whitespace-nowrap rounded-md text-sm text-heading font-medium border border-solid border-card-soft bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center cursor-pointer">
                                                <i data-lucide="phone" class="mr-2 h-4 w-4"></i>
                                                Call Dispatch</button><button
                                                class="justify-center gap-2 whitespace-nowrap rounded-md text-sm text-heading font-medium border border-solid border-card-soft bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center cursor-pointer">Cancel
                                                Request</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Drawer (location access UI) -->
            <div id="drawer" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white w-full max-w-md mx-auto rounded-lg overflow-hidden shadow-lg">
                    <!-- Drawer Header -->
                    <div class="p-4 relative border-b">
                        <h2 class="text-lg text-heading font-semibold">Requesting Emergency Help</h2>
                        <p class="text-sm text-gray-500">Please wait while we access your location</p>

                        <!-- X Close Button -->
                        <button onclick="closeDrawer()" class="absolute right-4 top-4 border-none bg-transparent text-gray-500 hover:text-heading">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>

                    </div>


                    <!-- Drawer Body -->
                    <div class="p-4 text-center">
                        <div class="animate-pulse">
                            <i data-lucide="map-pin" class="h-16 w-16 mx-auto text-medical-500"></i>
                        </div>
                        <p class="mt-4 text-heading">Accessing your location to send help...</p>
                        <p class="text-sm text-gray-500 mt-2">
                            This helps our emergency teams find you quickly
                        </p>
                    </div>

                    <!-- Drawer Footer -->
                    <div class="p-4 border-t text-right">
                        <button onclick="cancelRequest()" class="px-4 py-2 border border-solid border-card-soft rounded-sm bg-transparent text-heading rounded text-sm font-medium hover:bg-gray-100 cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <section class="py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="grid gap-6 md:grid-cols-2">

                            <!-- Emergency Signs Card -->
                            <div class="flex flex-col gap-6 p-6 glass-card border-card-soft rounded-lg">

                                <h3 class="text-heading text-2xl font-semibold leading-none tracking-tight">COVID-19 Emergency
                                    Signs</h3>

                                <ul class="flex flex-col gap-2">
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Severe difficulty breathing</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Persistent chest pain or pressure</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Bluish lips or face</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Confusion or inability to wake/stay awake</p>
                                    </li>
                                </ul>

                                <p class="text-sm text-muted-foreground">If experiencing these symptoms, request
                                    emergency help immediately</p>

                            </div>

                            <!-- Preparation Card -->
                            <div class="flex flex-col gap-6 p-6 rounded-lg glass-card border-card-soft">

                                <h3 class="text-heading text-2xl font-semibold leading-none tracking-tight">What To Prepare</h3>

                                <ul class="flex flex-col gap-2">
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">ID and insurance information (if available)</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">List of current medications</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Mask or face covering</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Phone and charger</p>
                                    </li>
                                </ul>

                                <p class="text-sm text-muted-foreground">Having these items ready helps speed up the
                                    admission process</p>

                            </div>
                        </div>

                        <!-- Alternative Contact -->
                        <div class="mt-8 p-6 glass-card border-card-soft rounded-lg bg-gray-50">
                            <h3 class="text-heading text-lg font-semibold mb-4 text-center">Alternative Contact Options</h3>
                            <div class="grid gap-4 sm:grid-cols-2">

                                <!-- Disabled Button with Tooltip wrapper -->
                                <div class="group relative cursor-not-allowed">
                                    <button
                                        class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background px-4 py-2 flex items-center justify-center h-16 pointer-events-none w-full"
                                        disabled>
                                        <i data-lucide="phone" class="w-4 h-4 text-heading mr-2"></i>
                                        Emergency COVID-19 Hotline<br />
                                        <span class="font-bold text-heading">800-COVID-19</span>
                                    </button>
                                    <div
                                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                        Coming Soon!
                                    </div>
                                </div>

                                <!-- Link to Coming Soon Page -->
                                <a href="coming-soon.php"
                                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-4 py-2 flex items-center justify-center h-16 cursor-pointer w-full">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-heading mr-2"></i>
                                    Find Nearest<br />COVID-19 Treatment Center
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
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

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>
    <script type="module" src="js/emergency/emergency.js">
    </script>

    <!-- Confirmation Message -->
    <div id="confirmationMessage" class="fixed bottom-6 right-6 z-50 px-6 py-4 bg-white border border-solid border-card-soft shadow-md rounded-lg text-sm max-w-sm">
        <p class="font-semibold text-heading mb-1">Emergency request sent.</p>
        <p class="text-heading">Help is on the way.Please stay where you are!</p>
    </div>


</body>

</html>