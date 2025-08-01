<?php

$currentPage = "emergency";

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 3. Restrict access - only patients and guests can access emergency
require_once __DIR__ . "/../../backend/middleware/emergency-access.php";

// 4. Include avatar helper
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
                        <div id="request-help-wrapper" class="flex flex-col gap-6">
                            <button
                                id="request-help-btn"
                                class="gap-2 whitespace-nowrap border border-solid border-transparent h-10 bg-danger hover:bg-red-700 text-white font-bold py-4 px-8 rounded-sm text-lg shadow-lg flex items-center justify-center w-full md:w-auto md:max-w-[310px] cursor-pointer transition-colors">
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

            <section id="status-section" class="hidden py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-8">
                            <div class="flex flex-col gap-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none text-heading tracking-tight flex items-center">
                                    <i data-lucide="ambulance" class="mr-2 text-medical-500"></i>
                                    Emergency Response Status
                                </h3>
                                <p class="text-sm text-muted-foreground">COVID-19 specialized medical team status and location</p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="flex flex-col gap-6">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="text-center">
                                            <div
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent text-white hover:bg-medical-400 bg-medical-500 mb-2">
                                                EN ROUTE TO YOUR LOCATION</div>
                                            <div class="mb-4"><i data-lucide="ambulance" class="h-16 w-16 mx-auto text-medical-500"></i>
                                            </div>
                                            <h3 class="text-xl text-heading font-bold">COVID-19 Response Team En Route</h3>
                                            <div class="flex items-center justify-center mt-2"><i data-lucide="clock" class="mr-2 text-medical-500"></i>
                                                <p id="eta-text" class="text-gray-800 font-semibold">Estimated arrival: 10 minutes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-lg overflow-hidden h-62.5">
                                        <div class="h-full flex items-center justify-center bg-gray-100 p-4">
                                            <p class="text-center text-gray-600">Please set your Mapbox token in the Contact page
                                                to enable emergency map tracking.</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-4">
                                        <h4 class="font-semibold text-heading text-lg">What to expect:</h4>
                                        <ul class="flex flex-col gap-2">
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    Ambulance staff will be wearing full COVID-19 protective equipment</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    You may be asked screening questions about your symptoms</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    Please wear a mask if available</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pt-4 border-t">
                                        <h4 class="font-semibold text-heading text-center">Emergency Contact Options</h4>
                                        <div class="flex justify-center gap-4 mt-4">
                                            <div class="cursor-not-allowed group">
                                                <button
                                                    class="justify-center gap-2 whitespace-nowrap rounded-md text-sm text-heading font-medium border border-solid border-card-soft bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center pointer-events-none" disabled>
                                                    <i data-lucide="phone" class="mr-2 h-4 w-4"></i>
                                                    Call Dispatch
                                                </button>

                                                <div
                                                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                                    Coming Soon!
                                                </div>
                                            </div>
                                            <button id="status-cancel-btn"
                                                class="justify-center gap-2 whitespace-nowrap rounded-md text-sm text-heading font-medium border border-solid border-card-soft bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center cursor-pointer">Cancel
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Drawer (location access UI) -->
            <div id="drawer" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white w-full max-w-md mx-auto rounded-lg overflow-hidden shadow-lg">
                    <!-- Drawer Header -->
                    <div class="p-4 relative border-b">
                        <h2 class="text-lg text-heading font-semibold">Requesting Emergency Help</h2>
                        <p class="text-sm text-gray-500">Please wait while we access your location</p>

                        <!-- X Close Button -->
                        <button onclick="closeDrawer()" class="absolute right-4 top-4 border-none bg-transparent text-gray-500 hover:text-heading">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>

                    </div>


                    <!-- Drawer Body -->
                    <div class="p-4 text-center">
                        <div class="animate-pulse">
                            <i data-lucide="map-pin" class="h-16 w-16 mx-auto text-medical-500"></i>
                        </div>
                        <p class="mt-4 text-heading">Accessing your location to send help...</p>
                        <p class="text-sm text-gray-500 mt-2">
                            This helps our emergency teams find you quickly
                        </p>
                    </div>

                    <!-- Drawer Footer -->
                    <div class="p-4 border-t text-right">
                        <button onclick="cancelRequest()" class="px-4 py-2 border border-solid border-card-soft rounded-sm bg-transparent text-heading rounded text-sm font-medium hover:bg-gray-100 cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

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

                        <div class="mt-6 md:mt-8 p-4 md:p-6 glass-card border-card-soft rounded-lg bg-gray-50">
                            <h3 class="text-heading text-base md:text-lg font-semibold mb-3 md:mb-4 text-center">Alternative Contact Options</h3>
                            <div class="grid gap-3 md:gap-4 grid-cols-1 sm:grid-cols-2">

                                <!-- Disabled Button with Tooltip wrapper -->
                                <div class="group relative cursor-not-allowed">
                                    <button class="gap-2 whitespace-nowrap rounded-md text-xs md:text-sm font-medium text-heading glass-card border-card-soft bg-background px-3 md:px-4 py-3 md:py-2 flex items-center justify-center h-14 md:h-16 pointer-events-none w-full" disabled="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="phone" class="lucide lucide-phone w-4 h-4 text-heading mr-2">
                                            <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                                        </svg>
                                        Emergency COVID-19 Hotline<br>
                                        <span class="font-bold text-heading">800-COVID-19</span>
                                    </button>
                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                        Coming Soon!
                                    </div>
                                </div>

                                <!-- Link to Coming Soon Page -->
                                <a href="coming-soon.php" class="gap-2 whitespace-nowrap rounded-md text-xs md:text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-3 md:px-4 py-3 md:py-2 flex items-center justify-center h-14 md:h-16 cursor-pointer w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="map-pin" class="lucide lucide-map-pin w-4 h-4 text-heading mr-2">
                                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    Find Nearest<br>COVID-19 Treatment Center
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Universal Toast Container -->
    <div
        id="toast"
        class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg">
        <p id="toast-title" class="font-semibold"></p>
        <p id="toast-message" class="text-sm"></p>
    </div>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
    <script type="module" src="/mediconnect/assets/js/emergency/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>