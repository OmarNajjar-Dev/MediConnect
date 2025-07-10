<?php

// Loads user session context: sets $isLoggedIn, $userName, $userEmail, $dashboardLink
require_once "./backend/middleware/session-context.php";

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
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/colors.css" />
    <link rel="stylesheet" href="css/typography.css" />
    <link rel="stylesheet" href="css/spacing.min.css" />
    <link rel="stylesheet" href="css/sizing.min.css" />
    <link rel="stylesheet" href="css/borders.css" />
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/faq.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">

            <!-- Logo -->
            <a href="./" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
                <a href="./" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="./doctors.php" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="./hospitals.php" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="./appointments.php" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Appointments</a>
            </nav>

            <!-- Right section: Auth / Dropdown / Emergency / Menu -->
            <div class="flex items-center gap-4">

                <!-- Sign In / Sign Up (visible if not logged in) -->
                <?php if (!$isLoggedIn): ?>
                    <a href="./login.php" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                        Sign In
                    </a>

                    <a href="./register.php" class="hidden md:flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all mr-4">
                        Sign Up
                    </a>
                <?php else: ?>

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

                                <a href="<?= htmlspecialchars($dashboardLink) ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-600 hover:text-medical-600 hover:bg-medical-50 transition-colors transition-200">
                                    <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                                </a>

                                <a href="./backend/auth/logout.php" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <!-- Emergency button (always visible) -->
                <a href="./emergency.php" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 lg:ml-2 rounded-lg transition-colors transition-200">
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
                    <a href="./" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="./doctors.php" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="./hospitals.php" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="./appointments.php" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <!-- Mobile: Sign In / Sign Out depending on session -->
                    <?php if (!$isLoggedIn): ?>
                        <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                            <a href="./login.php" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                            <a href="./register.php" class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
                            <a href="<?= htmlspecialchars($dashboardLink) ?>" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-medical-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i> Dashboard
                            </a>
                            <a href="./backend/auth/logout.php" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
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
                        <div class="flex flex-col gap-6">
                            <button
                                class="gap-2 whitespace-nowrap border border-solid border-input h-10 bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 rounded-sm text-lg shadow-lg flex items-center justify-center w-full md:w-auto md:max-w-[300px]">
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
                                <button
                                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-4 py-2 flex items-center justify-center h-16 pointer">
                                    <i data-lucide="phone" class="w-4 h-4 text-heading mr-2"></i>
                                    Emergency COVID-19 Hotline<br />
                                    <span class="font-bold text-heading">800-COVID-19</span>
                                </button>

                                <button
                                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-4 py-2 flex items-center justify-center h-16 pointer">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-heading mr-2"></i>
                                    Find Nearest<br />COVID-19 Treatment Center
                                </button>
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
                    <a href="./" class="inline-block mb-4">
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
                            <a href="./appointments.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="./doctors.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="./hospitals.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="./emergency.php" class="text-gray-600 hover:text-medical-600 transition-colors">
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
                            <a href="./about.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="./privacy.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="./terms.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="./faq.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="./contact.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Contact Us
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
    <script type="module" src="./js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>