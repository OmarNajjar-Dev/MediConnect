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
    <main id="about" class="overflow-hidden pt-20 flex-grow min-h-screen pb-16">
        <div class="container mx-auto px-4">

            <!-- 🔹 Intro Section -->
            <div class="py-12">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="bg-medical-100 text-medical-700 text-sm font-medium px-4 py-1.5 rounded-full inline-block mb-4">
                        About MediConnect
                    </span>
                    <h1 class="text-4xl font-bold mb-6 text-gray-900 tracking-tight">
                        Making Healthcare Accessible to Everyone
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Since 2010, MediConnect has been transforming healthcare delivery through technology and
                        compassion.
                        Our mission is simple: make quality healthcare accessible to all.
                    </p>
                </div>

                <!-- 🔹 Vision Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
                    <!-- Vision Image + Stats -->
                    <div class="order-1 lg:order-2 relative">
                        <div class="glass-card rounded-xl overflow-hidden">
                            <div class="relative w-full max-h-62.5 sm:max-h-125 overflow-hidden">
                                <img id="about-image"
                                    src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=880&auto=format&fit=crop"
                                    alt="Medical team"
                                    class="w-full h-full max-h-62.5 sm:max-h-125 object-cover transition-transform transition-700" />
                            </div>
                        </div>
                        <div id="about-trust"
                            class="absolute bg-white p-6 shadow-xl rounded-xl border border-solid border-input flex items-center">
                            <div class="flex items-center justify-center mr-4 bg-medical-100 rounded-full p-3">
                                <i data-lucide="heart-pulse" class="h-8 w-8 text-medical-700"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Trusted by</p>
                                <p class="text-3xl font-bold text-medical-700">500,000+</p>
                                <p class="text-sm font-medium text-gray-600">patients nationwide</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vision Text & Cards -->
                    <div class="order-2 lg:order-1">
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 tracking-tight">Our Vision</h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            We envision a world where quality healthcare is within everyone's reach. Through our
                            innovative digital platform, we're breaking down barriers and creating a healthcare
                            ecosystem that puts patients first.
                        </p>
                        <!-- Vision Cards Placeholder -->
                        <div id="vision-cards-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6"></div>
                    </div>
                </div>

                <!-- 🔹 Journey Section -->
                <div class="mb-24">
                    <div class="text-center mb-12">
                        <h2 class="text-heading text-3xl font-bold mb-4">Our Journey</h2>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            From our humble beginnings to becoming a leader in digital healthcare, every step of our
                            journey has been driven by our commitment to improving lives.
                        </p>
                    </div>
                    <!-- Journey Cards Placeholder -->
                    <div id="journey-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    </div>
                </div>

                <!-- 🔹 Leadership Section -->
                <div class="mb-24">
                    <div class="max-w-5xl mx-auto">
                        <div class="w-full flex flex-col gap-12">

                            <!-- Section Heading -->
                            <div class="text-center">
                                <h2 class="text-3xl font-bold mb-4 text-gray-900">Visionary Leadership</h2>
                                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                                    Meet the exceptional team guiding MediConnect's mission to transform healthcare
                                    access through innovation, compassion, and expertise.
                                </p>
                            </div>

                            <!-- Leadership Cards Placeholder -->
                            <div id="leadership-cards-container" class="flex flex-col gap-14"></div>

                            <!-- CTA -->
                            <div class="flex justify-center">
                                <a href="coming-soon.php"
                                    id="leadership-cta"
                                    class="inline-flex items-center justify-center gap-2 text-sm font-medium border border-solid border-input bg-background hover:bg-medical-50 text-heading hover:text-medical-500 h-11 rounded-md px-8 transition-colors cursor-pointer">
                                    <span>View Full Leadership Team</span>
                                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4 transition-transform"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- 🔹 CTA Section -->
                <div class="my-24 max-w-6xl m-auto">
                    <div class="relative overflow-hidden rounded-3xl">
                        <div id="background-overlay" class="absolute inset-0 opacity-95"></div>
                        <div id="background-overlay-image" class="absolute inset-0 opacity-10 bg-cover bg-center"></div>

                        <div class="relative px-6 sm:px-8 md:px-16 py-12 sm:py-16 md:py-20">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">

                                <!-- Left CTA Text -->
                                <div>
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-6">
                                        Join Our Healthcare Community
                                    </h2>
                                    <p class="text-medical-100 text-base sm:text-lg mb-8 leading-relaxed">
                                        At MediConnect, we're not just providing services - we're building a community
                                        dedicated to health and wellbeing. Whether you're a patient, healthcare
                                        provider, or potential partner, we invite you to be part of our journey toward a
                                        healthier tomorrow.
                                    </p>
                                    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                                        <a href="coming-soon.php"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors outline-none border border-solid border-white h-11 rounded-lg px-8 bg-white text-medical-700 hover:bg-neutral-100 shadow-lg cursor-pointer">
                                            Become a Partner
                                        </a>
                                        <a href="coming-soon.php"
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors outline-none border border-solid border-white h-11 rounded-lg px-8 text-white bg-medical-600/30 cursor-pointer">
                                            Learn More About Our Mission
                                        </a>
                                    </div>
                                </div>

                                <!-- Right Features -->
                                <div class="flex flex-col gap-6 w-full max-w-full sm:max-w-md mx-auto lg:mx-0">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-solid border-card-light shadow-xl">
                                        <div class="flex items-start">
                                            <div
                                                class="flex items-center justify-center bg-white/20 rounded-full p-3 mr-4">
                                                <i data-lucide="users"
                                                    class="lucide lucide-users h-6 w-6 text-white"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">
                                                    Patient-Centered Care
                                                </h3>
                                                <p class="text-medical-100">
                                                    Our healthcare approach revolves around your needs, preferences, and
                                                    values, ensuring you receive personalized care.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-solid border-card-light shadow-xl">
                                        <div class="flex items-start">
                                            <div
                                                class="flex items-center justify-center bg-white/20 rounded-full p-3 mr-4">
                                                <i data-lucide="shield"
                                                    class="lucide lucide-shield h-6 w-6 text-white"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">
                                                    Advanced Protection
                                                </h3>
                                                <p class="text-medical-100">
                                                    Your health data is secured with industry-leading encryption and
                                                    privacy standards that exceed regulatory requirements.
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
    <script type="module" src="/mediconnect/js/about/index.js"></script>

</body>

</html>