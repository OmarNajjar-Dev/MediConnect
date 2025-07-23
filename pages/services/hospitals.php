<?php

$currentPage = "hospitals";

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
    <link rel="stylesheet" href="/mediconnect/assets/css/base/base.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/base/typography.css" />
    
    <!-- Design System -->
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/colors.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/borders.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/ring.css" />
    
    <!-- Layout & Components -->
    <link rel="stylesheet" href="/mediconnect/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/components.css" />
    
    <!-- Custom Styles (Overrides) -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base/style.css" />
    
    <!-- Responsive Design -->
    <link rel="stylesheet" href="/mediconnect/assets/css/layout/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="overflow-hidden pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <h1 class="text-3xl font-bold mb-2 tracking-tight text-heading">
                    Hospitals
                </h1>
                <p clas s="text-gray-600">
                    Find hospitals, check bed availability, and view services
                </p>
            </div>

            <div class="input-container flex flex-col lg:flex-row gap-6 mb-8">
                <div class="flex-grow">
                    <div class="relative">
                        <!-- Search Icon (Lucide) -->
                        <i data-lucide="search" class="search-icon absolute text-gray-500"></i>
                        <input type="text" placeholder="Search hospitals by name or location"
                            class="search-input text-heading px-10 h-12 flex w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white" />
                    </div>
                </div>

                <!-- FIXED BUTTONS HERE -->
                <div class="flex flex-row gap-3">
                    <button id="emergency-btn"
                        class="flex items-center gap-2 justify-center whitespace-nowrap rounded-md border border-solid border-input bg-background text-heading px-4 py-2 h-10 text-sm font-medium transition-colors hover:bg-medical-50 hover:text-medical-500 cursor-pointer">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>Emergency Services</span>
                    </button>

                    <button id="beds-btn"
                        class="flex items-center gap-2 rounded-md border border-solid border-input text-heading bg-background h-10 px-4 py-2 text-sm font-medium whitespace-nowrap hover:bg-medical-50 transition-colors hover:text-medical-500 cursor-pointer">
                        <i data-lucide="bed" class="w-4 h-4"></i>
                        <span>Available Beds</span>
                    </button>
                </div>
                <!-- END FIXED BUTTONS -->
            </div>

            <!-- No Hospitals Found Message -->
            <div class="no-results hidden glass-card rounded-xl p-6 py-16 text-center">
                <div class="mx-auto w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="triangle-alert" class="w-7 h-7 text-gray-400"></i>
                </div>
                <h2 class="text-xl font-medium mb-2 tracking-tight text-heading">No hospitals found</h2>
                <p class="text-gray-600 mb-4">Try adjusting your search criteria</p>
                <button
                    class="clear-filters inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md border border-solid border-input text-sm font-medium transition-colors bg-primary text-white hover:bg-medical-400 h-10 px-4 py-2 cursor-pointer">
                    Clear Filters
                </button>
            </div>

            <!-- Hospitals Cards Container -->
            <div id="hospitals-cards-container" class="grid grid-cols-1 gap-6">
                <!-- Dynamically Generated Hospital Cards will be inserted here -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
    <script type="module" src="/mediconnect/assets/js/hospitals/index.js"></script>

</body>

</html>