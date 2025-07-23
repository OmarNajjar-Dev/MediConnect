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

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center py-8 md:py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <section class="flex flex-col items-center text-center px-4 md:px-8 py-10 md:py-16">
                <div class="mb-6">
                    <i data-lucide="droplet" class="h-16 w-16 md:h-20 md:w-20 text-medical-500 animate-bounce"></i>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">Save Lives.
                    <span class="text-medical-500">Donate Blood Today.</span>
                </h1>
            </section>
            <div class="max-w-2xl mx-auto px-4 text-center mb-10">
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed">Your single donation can save up to three lives. There is no substitute for human blood—it can only come from generous donors like you.</p>
            </div>
            <div class="flex justify-center mt-8 mb-16">
                <div>
                    <a href="https://external-bloodbank.example" target="_blank" onclick="return false;" title="Coming Soon" class="inline-block bg-primary transition-colors hover:bg-medical-600 text-white font-medium py-4 px-8 rounded-full shadow-lg text-lg md:text-xl">Go to Blood Bank System</a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto mt-8 mb-12">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-medical-500 mb-2">4.5M</div>
                    <p class="text-gray-600">People need blood in the U.S. every year</p>
                </div>
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-medical-500 mb-2">3</div>
                    <p class="text-gray-600">Lives saved with each donation</p>
                </div>
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-medical-500 mb-2">30 min</div>
                    <p class="text-gray-600">Average donation time</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>