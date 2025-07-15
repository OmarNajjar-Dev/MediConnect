<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $dashboardLink)
require_once __DIR__ . "/../backend/middleware/session-context.php";

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

            <!-- Right section: Emergency / Auth / Dropdown / Menu -->
            <div class="flex items-center gap-4">

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 lg:ml-2 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- User dropdown (visible if logged in) -->
                <div class="hidden md:flex items-center gap-3 md:order-last">
                    <div class="dropdown relative">
                        <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 pointer rounded-lg">
                            <div class="w-8 h-8 rounded-full bg-medical-100 flex items-center justify-center text-medical-700 text-sm lg:text-base font-medium">
                                <?= strtoupper(substr($userName, 0, 2)) ?>
                            </div>
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

                            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-medical-600 hover:bg-medical-50 transition-colors transition-200">
                                <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                            </a>

                            <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

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

    <!-- Forbidden Access Page Wrapper -->
    <main id="forbidden-error" class="overflow-hidden flex justify-center flex-grow bg-gray-50 pt-20 pb-16">
        <!-- Centered Content Container -->
        <div class="max-w-lg w-full flex flex-col gap-8 text-center animate-fade-in pt-20 pb-16">

            <!-- Shield Icon Section -->
            <div class="flex justify-center">
                <div class="relative">
                    <!-- Icon Circle -->
                    <div class="w-28 h-28 bg-white rounded-full shadow-xl flex items-center justify-center border border-solid border-transparent border-orange-100 hover-scale hover-scale:hover">
                        <i data-lucide="shield" class="w-12 h-12 text-orange-500"></i>
                    </div>
                    <!-- Blurred Pulse Background -->
                    <div class="absolute inset-0 w-28 h-28 rounded-full blur-xl -z-10 pulse"></div>
                </div>
            </div>

            <!-- Message Box -->
            <div class="bg-white rounded-3xl shadow-2xl border border-solid border-gray-100 p-8 sm:p-12 relative z-10">

                <!-- Title and Subtitle -->
                <div class="flex flex-col gap-5">
                    <h1 class="text-5xl sm:text-6xl font-bold text-gray-900 tracking-tight">403</h1>
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 leading-tight">Access Denied</h2>
                </div>

                <!-- Description -->
                <div class="flex flex-col gap-4 mt-8">
                    <p class="text-gray-700 text-lg sm:text-xl leading-relaxed font-medium">
                        You don't have permission to view this page.
                    </p>
                    <p class="text-gray-500 text-base leading-relaxed max-w-md mx-auto">
                        This content may require special permissions or a different user role. Please log in with an authorized account or contact support.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-10">
                    <!-- Contact Support Button -->
                    <a
                        href="<?= $paths['static']['contact'] ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 flex-grow bg-orange-600 hover:bg-orange-700 text-white shadow-lg hover:shadow-xl transition-all transition-200">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        Contact Support
                    </a>

                    <!-- Back to Home Button -->
                    <a
                        href="<?= $paths['home'] ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border border-solid border-card-soft bg-background hover:bg-gray-100 hover:text-accent-foreground h-10 px-4 py-2 flex-grow text-heading transition-all transition-200">
                        <i data-lucide="house" class="w-4 h-4"></i>
                        Back to Home
                    </a>
                </div>
            </div>

            <!-- Contact Note -->
            <div class="text-center flex flex-col gap-3 relative z-10">
                <p class="text-gray-500 text-sm">
                    Need help?
                    <a href="mailto:contact@mediconnect.example" class="text-orange-600 hover:text-orange-700 transition-colors transition-200 font-medium">
                        contact@mediconnect.example
                    </a>
                </p>
            </div>

            <!-- Animated Pulsing Dots -->
            <div class="flex justify-center gap-3 opacity-30">
                <div class="w-2 h-2 bg-orange-400 rounded-full pulse"></div>
                <div class="w-2 h-2 bg-orange-400 rounded-full pulse delay-200"></div>
                <div class="w-2 h-2 bg-orange-400 rounded-full pulse delay-400"></div>
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
                            <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
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
        lucide.createIcons();
    </script>

</body>

</html>