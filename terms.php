<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail)
require_once __DIR__ . "/backend/middleware/session-context.php";

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
                <a href="<?= $paths['home']['index'] ?>" class="text-medical-700 text-sm lg:text-base font-medium hover:text-primary transition-colors">Home</a>
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
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home']['index'] ?>" class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
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
        <div class="container mx-auto px-4 py-12 md:px-6">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>
                <div class="text-sm text-gray-500 mb-8">
                    Last updated: May 1, 2025
                </div>
                <div class="max-w-none">
                    <p class="mb-6">
                        Please read these Terms of Service ("Terms", "Terms of Service")
                        carefully before using the MediConnect platform operated by
                        MediConnect, Inc. ("us", "we", "our").
                    </p>
                    <p class="mb-6">
                        By accessing or using our service, you agree to be bound by these
                        Terms. If you disagree with any part of the terms, you may not
                        access the service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">1. Service Description</h2>
                    <p class="mb-6">
                        MediConnect is a healthcare platform designed to connect patients
                        with medical professionals, hospitals, pharmacies, and emergency
                        services. Our platform facilitates appointment booking, medical
                        report sharing, healthcare provider ratings, and other
                        healthcare-related services.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">2. User Accounts</h2>
                    <p class="mb-4">
                        When you create an account with us, you must provide information
                        that is accurate, complete, and current at all times.
                    </p>
                    <p class="mb-6">
                        You are responsible for maintaining the confidentiality of your
                        account and password and for restricting access to your computer
                        or device. You agree to accept responsibility for all activities
                        that occur under your account or password.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">3. User Conduct</h2>
                    <p class="mb-4">As a user, you agree not to:</p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">
                            Use the service for any illegal purpose or in violation of any
                            laws.
                        </li>
                        <li class="mb-2">
                            Impersonate any person or entity or falsely state or
                            misrepresent your affiliation with a person or entity.
                        </li>
                        <li class="mb-2">
                            Interfere with or disrupt the service or servers or networks
                            connected to the service.
                        </li>
                        <li class="mb-2">
                            Post false, misleading, or dishonest reviews of healthcare
                            providers or services.
                        </li>
                        <li class="mb-2">
                            Use the service to distribute unsolicited promotional or
                            commercial content.
                        </li>
                    </ul>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        4. Healthcare Provider Relationships
                    </h2>
                    <p class="mb-6">
                        MediConnect is a platform that facilitates connections between
                        patients and healthcare providers. We are not a healthcare
                        provider and do not provide medical advice, diagnosis, or
                        treatment.
                    </p>
                    <p class="mb-6">
                        All medical information, advice, and services are provided solely
                        by the healthcare providers you connect with through our platform.
                        We are not responsible for the quality, accuracy, or
                        appropriateness of any medical care or advice you receive.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        5. Appointments and Cancellations
                    </h2>
                    <p class="mb-6">
                        By booking an appointment through our platform, you agree to
                        attend the appointment or cancel it within the timeframe specified
                        by the healthcare provider. Repeated no-shows or late
                        cancellations may result in restrictions on your ability to book
                        future appointments.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">6. Ratings and Reviews</h2>
                    <p class="mb-6">
                        When you submit ratings or reviews on our platform, you grant us a
                        non-exclusive, royalty-free, perpetual, irrevocable right to use,
                        reproduce, modify, adapt, publish, translate, create derivative
                        works from, distribute, and display such content throughout the
                        world in any media.
                    </p>
                    <p class="mb-6">
                        You represent and warrant that your ratings and reviews are
                        accurate, honest, and based on your personal experience with the
                        healthcare provider or service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        7. Limitation of Liability
                    </h2>
                    <p class="mb-6">
                        To the maximum extent permitted by law, MediConnect, its
                        affiliates, and their directors, employees, agents, and licensors
                        shall not be liable for any indirect, incidental, special,
                        consequential, or punitive damages, including without limitation,
                        loss of profits, data, use, goodwill, or other intangible losses,
                        resulting from your access to or use of or inability to access or
                        use the service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        8. Modifications to the Service
                    </h2>
                    <p class="mb-6">
                        We reserve the right, at our sole discretion, to modify or replace
                        these Terms at any time. We will provide notice of any changes by
                        posting the new Terms on this page and updating the "Last updated"
                        date.
                    </p>
                    <p class="mb-6">
                        Your continued use of the service after any such changes
                        constitutes your acceptance of the new Terms.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">9. Contact Us</h2>
                    <p>
                        If you have any questions about these Terms, please contact us at:
                    </p>
                    <p class="mt-2">
                        <strong>Email:</strong> legal@mediconnect.com<br /><strong>Postal Address:</strong>
                        123 Health Street, Medical District, MD 12345
                    </p>
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

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
