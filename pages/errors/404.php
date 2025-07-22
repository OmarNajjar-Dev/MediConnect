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

    <!-- 404 Page Not Found Wrapper -->
    <main class="overflow-hidden pt-20 flex-grow bg-gray-50">

        <!-- Fullscreen Centered Container -->
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center px-4 max-w-md">

                <!-- Icon Section -->
                <div class="inline-block mx-auto">
                    <i data-lucide="help-circle" class="w-24 h-24 mx-auto mb-6 text-medical-500"></i>
                </div>

                <!-- Error Code & Title -->
                <h1 class="text-5xl font-bold text-gray-800 mb-4">404</h1>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    Page Not Found
                </h2>

                <!-- Description -->
                <p class="text-gray-600 mb-8">
                    We couldn't find the page you were looking for. The page may have
                    been moved, deleted, or never existed.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">

                    <!-- Return to Home Button -->
                    <a
                        href="<?= $paths['home']['index'] ?>"
                        class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-medical-600 text-white whitespace-nowrap rounded-sm text-sm font-medium transition-colors outline-none h-10 px-4 py-2 w-full">
                        <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
                        Return to Home
                    </a>

                    <!-- Contact Support Button -->
                    <a
                        href="<?= $paths['static']['contact'] ?>"
                        class="inline-flex items-center justify-center gap-2 text-medical-500 hover:bg-medical-50 hover:text-gray-900 whitespace-nowrap rounded-sm text-sm font-medium transition-colors outline-none border border-solid h-10 px-4 py-2 w-full">
                        Contact Support
                    </a>

                </div>

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