<?php

// 1. Load system configuration
require_once ROOT . "/src/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once ROOT . "/src/middleware/session-context.php";

// 3. Include avatar helper
require_once ROOT . "/src/helpers/avatar-helper.php";

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
    <link rel="stylesheet" href="/assets/css/layout.css" />
    <link rel="stylesheet" href="/assets/css/animations.css" />
    <link rel="stylesheet" href="/assets/css/components.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/responsive.css" />

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

            <!-- Right section: Emergency / Auth / Menu -->
            <div class="flex items-center gap-4">

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- Sign In / Sign Up (visible on desktop) -->
                <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all md:ml-4">
                    Sign In
                </a>

                <a href="<?= $paths['auth']['register'] ?>" class="hidden md:flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                    Sign Up
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

                    <!-- Mobile: Sign In / Sign Out -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                        <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
                    </div>
                </nav>
            </div>

        </div>
    </header>

    <!-- Unauthorized Access Page Wrapper -->
    <main class="overflow-hidden flex justify-center flex-grow bg-gray-50 pt-20 pb-16">
        <!-- Centered Content Container -->
        <div class="max-w-lg w-full flex flex-col gap-8 text-center animate-fade-in pt-20 pb-16">

            <!-- Lock Icon Section -->
            <div class="flex justify-center">
                <div class="relative">
                    <!-- Icon Circle -->
                    <div class="w-28 h-28 bg-white rounded-full shadow-xl flex items-center justify-center border border-solid border-transparent border-gray-100 hover-scale hover-scale:hover">
                        <i data-lucide="lock" class="w-12 h-12 text-medical-500"></i>
                    </div>
                    <!-- Optional Blurred Background -->
                    <div class="absolute inset-0 w-28 h-28 rounded-full blur-xl -z-10 pulse"></div>
                </div>
            </div>

            <!-- Message Box -->
            <div class="bg-white rounded-3xl shadow-2xl border border-solid border-gray-100 p-8 sm:p-12 relative z-10">

                <!-- Title and Subtitle -->
                <div class="flex flex-col gap-5">
                    <h1 class="text-5xl sm:text-6xl font-bold text-gray-900 tracking-tight">401</h1>
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 leading-tight">Unauthorized Access</h2>
                </div>

                <!-- Description -->
                <div class="flex flex-col gap-4 mt-8">
                    <p class="text-gray-700 text-lg sm:text-xl leading-relaxed font-medium">
                        You don't have permission to access this page.
                    </p>
                    <p class="text-gray-500 text-base leading-relaxed max-w-md mx-auto">
                        Please contact your system administrator if you believe this is a mistake.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-10">
                    <!-- Contact Support Button -->
                    <a
                        href="<?= $paths['auth']['login'] ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap flex-grow rounded-md text-sm font-medium h-10 px-5 py-2 flex-grow bg-primary hover:bg-medical-400 text-white shadow-lg hover:shadow-xl transition-all transition-200">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Go to Login
                    </a>

                    <!-- Back to Home Button -->
                    <a
                        href="<?= $paths['home']['index'] ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border border-solid border-card-soft bg-background hover:bg-neutral-100 hover:text-medical-500 h-10 px-4 py-2 flex-grow text-heading transition-all transition-200">
                        <i data-lucide="house" class="w-4 h-4"></i>
                        Back to Home
                    </a>
                </div>
            </div>

            <!-- Contact Note -->
            <div class="text-center flex flex-col gap-3 relative z-10">
                <p class="text-gray-500 text-sm">
                    Need help?
                    <a href="mailto:contact@mediconnect.example" class="text-primary hover:text-medical-700 transition-colors transition-200 font-medium">
                        contact@mediconnect.example
                    </a>
                </p>
            </div>

            <!-- Animated Pulsing Dots -->
            <div class="flex justify-center gap-3 opacity-30">
                <div class="w-2 h-2 bg-medical-400 rounded-full pulse"></div>
                <div class="w-2 h-2 bg-medical-400 rounded-full pulse delay-200"></div>
                <div class="w-2 h-2 bg-medical-400 rounded-full pulse delay-400"></div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer id="unauthorized-error" class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
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

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>