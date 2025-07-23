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
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Unauthorized Access Page Wrapper -->
    <main id="unauthorized-error" class="overflow-hidden flex justify-center flex-grow bg-gray-50 pt-20 pb-16">
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
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>