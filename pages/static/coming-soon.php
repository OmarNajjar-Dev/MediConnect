<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 3. Include avatar helper
require_once __DIR__ . "/../../backend/helpers/avatar-helper.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Lucide Icons -->
    <?php require_once __DIR__ . '/../../backend/config/apis.php'; ?>
    <script src="<?= LUCIDE_CDN_URL ?>"></script>

    <!-- Base Styles -->
    <link rel="stylesheet" href="/assets/css/base/base.css" />
    <link rel="stylesheet" href="/assets/css/base/typography.css" />

    <!-- Design System -->
    <link rel="stylesheet" href="/assets/css/utils/colors.css" />
    <link rel="stylesheet" href="/assets/css/utils/spacing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/sizing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/borders.css" />

    <!-- Layout & Components -->
    <link rel="stylesheet" href="/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/assets/css/components/animations.css" />
    <link rel="stylesheet" href="/assets/css/components/components.css" />

    <!-- Custom Styles (Overrides) -->
    <link rel="stylesheet" href="/assets/css/base/style.css" />

    <!-- Responsive Design -->
    <link rel="stylesheet" href="/assets/css/layout/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Main Content -->
    <main id="coming-soon" class="overflow-hidden flex justify-center flex-grow pt-20 pb-16">
        <section class="relative overflow-hidden w-full">

            <div class="container mx-auto px-4 py-20 text-center relative z-10">
                <div class="mb-8 animate-fade-in">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary rounded-2xl mb-6 shadow-lg">
                        <i data-lucide="heart" class="w-10 h-10 text-white"></i>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-4">MediConnect</h1>
                    <p class="text-xl md:text-2xl text-primary font-medium">Connecting Hearts with Healthcare</p>
                </div>

                <div class="max-w-4xl mx-auto mb-12 animate-fade-in delay-200">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                        Revolutionary Healthcare Platform<br><span class="text-medical-500">Coming Soon</span>
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        We're building the future of healthcare connectivity. Join thousands of patients, doctors, and hospitals preparing for a seamless healthcare experience.
                    </p>
                </div>

                <div class="mb-12">
                    <h3 class="text-xl font-semibold text-gray-700 mb-6">Launch Countdown</h3>
                    <div class="flex justify-center gap-4 md:gap-8" id="countdown">
                        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 min-w-20 md:min-w-25 text-center">
                            <div class="text-2xl md:text-4xl font-bold text-medical-500 mb-2" id="days">--</div>
                            <div class="text-sm md:text-base text-gray-600 font-medium">Days</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 min-w-20 md:min-w-25 text-center">
                            <div class="text-2xl md:text-4xl font-bold text-medical-500 mb-2" id="hours">--</div>
                            <div class="text-sm md:text-base text-gray-600 font-medium">Hours</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 min-w-20 md:min-w-25 text-center">
                            <div class="text-2xl md:text-4xl font-bold text-medical-500 mb-2" id="minutes">--</div>
                            <div class="text-sm md:text-base text-gray-600 font-medium">Minutes</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 min-w-20 md:min-w-25 text-center">
                            <div class="text-2xl md:text-4xl font-bold text-medical-500 mb-2" id="seconds">--</div>
                            <div class="text-sm md:text-base text-gray-600 font-medium">Seconds</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto animate-fade-in delay-800">
                    <div class="bg-white rounded-xl p-6 shadow-lg hover-scale">
                        <i data-lucide="stethoscope" class="w-12 h-12 text-medical-500 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Expert Care</h3>
                        <p class="text-gray-600 text-sm">Connect with certified healthcare professionals and specialists</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-lg hover-scale">
                        <i data-lucide="calendar" class="w-12 h-12 text-medical-500 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Easy Booking</h3>
                        <p class="text-gray-600 text-sm">Schedule appointments seamlessly with real-time availability</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-lg hover-scale">
                        <i data-lucide="phone" class="w-12 h-12 text-medical-500 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">24/7 Support</h3>
                        <p class="text-gray-600 text-sm">Emergency services and round-the-clock healthcare assistance</p>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/assets/js/common/index.js"></script>
    <script type="module" src="/assets/js/coming-soon.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>