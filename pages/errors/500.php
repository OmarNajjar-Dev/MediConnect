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

    <!-- Page Specific Styles -->
    <link rel="stylesheet" href="/assets/css/pages/dashboard.css" />

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

    <!-- Server Error Page Wrapper -->
    <main id="server-error" class="overflow-hidden flex justify-center flex-grow bg-gray-50 pt-20 pb-16">
        <!-- Centered Content Container -->
        <div class="max-w-lg w-full flex flex-col gap-8 text-center animate-fade-in pt-20 pb-16">

            <!-- Error Icon Section -->
            <div class="flex justify-center relative z-10">
                <div class="relative">
                    <!-- Icon Circle -->
                    <div class="w-28 h-28 bg-white rounded-full shadow-xl flex items-center justify-center border border-solid border-transparent border-red-100 hover-scale hover-scale:hover">
                        <i data-lucide="triangle-alert" class="w-12 h-12 text-red-500"></i>
                    </div>
                    <!-- Blurred Pulse Background -->
                    <div class="absolute inset-0 w-28 h-28 rounded-full blur-xl -z-10 pulse"></div>
                </div>
            </div>

            <!-- Error Message Box -->
            <div class="bg-white rounded-3xl shadow-2xl border border-solid border-gray-100 p-8 sm:p-12 relative z-10">
                <div class="flex flex-col gap-5">
                    <!-- Error Code -->
                    <h1 class="text-5xl sm:text-6xl font-bold text-gray-900 tracking-tight">500</h1>
                    <!-- Error Title -->
                    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800 leading-tight">Server Error</h2>
                </div>

                <!-- Description Paragraphs -->
                <div class="flex flex-col gap-4 mt-8">
                    <p class="text-gray-700 text-lg sm:text-xl leading-relaxed font-medium">
                        Oops! Something went wrong on our side.
                    </p>
                    <p class="text-gray-500 text-base leading-relaxed max-w-md mx-auto">
                        Please try again later, or contact support if the issue persists. Our technical team has been notified.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-10">
                    <!-- Back to Home Button -->
                    <a
                        href="<?= $paths['home']['index'] ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 flex-grow bg-danger hover:bg-red-700 text-white shadow-lg hover:shadow-xl transition-all transition-200">
                        <i data-lucide="house" class="w-4 h-4"></i>
                        Back to Home
                    </a>

                    <!-- Retry Button -->
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium cursor-pointer border border-solid border-transparent bg-background hover:text-medical-500 h-10 px-4 py-2 flex-grow border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 shadow-lg hover:shadow-xl transition-all transition-200">
                        <i data-lucide="rotate-ccw" class="w-4 h-4 mr-2"></i>
                        Try Again
                    </button>
                </div>
            </div>

            <!-- Support Contact -->
            <div class="text-center flex flex-col gap-3 relative z-10">
                <p class="text-gray-500 text-sm">
                    Need immediate assistance?
                    <a
                        href="mailto:contact@mediconnect.example"
                        class="text-red-600 hover:text-red-700 transition-colors transition-200 font-medium">
                        Contact our support team
                    </a>
                </p>
            </div>

            <!-- Animated Pulsing Dots -->
            <div class="flex justify-center gap-3 opacity-30">
                <div class="w-2 h-2 bg-red-400 rounded-full pulse"></div>
                <div class="w-2 h-2 bg-red-400 rounded-full pulse delay-200"></div>
                <div class="w-2 h-2 bg-red-400 rounded-full pulse delay-400"></div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/assets/js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>