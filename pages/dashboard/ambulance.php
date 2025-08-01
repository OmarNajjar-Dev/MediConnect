<?php

// 0. Redirect to coming soon if this dashboard is not ready
require_once __DIR__ . "/../../backend/middleware/redirect-to-coming-soon.php";

// 3. Define required role for this dashboard
$requiredRole = 'ambulance_team';

// 4. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../../backend/middleware/protect-dashboard.php";

// 5. Include avatar helper
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
    
    <!-- Page Specific Styles -->
    <link rel="stylesheet" href="/mediconnect/assets/css/pages/dashboard.css" />
    
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
    <main class="pt-16 sm:pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-xl">
            <div class="py-8">

                <!-- Header Section -->
                <div class="mb-8">
                    <p class="mb-1 text-sm text-gray-600">
                        Logged in as: <span class="font-medium">AMBULANCE TEAM</span>
                    </p>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        Welcome back, Emergency Response Team Alpha
                    </h1>
                    <p class="mt-1 text-sm text-primary">
                        City Emergency Services
                    </p>
                </div>

                <!-- Panel Title -->
                <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <i data-lucide="truck" class="h-8 w-8 text-red-600"></i>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-heading">
                            Emergency Response Panel
                        </h1>
                        <p class="text-gray-600">Ambulance Team Dashboard</p>
                    </div>
                </div>

                <!-- Emergency Alert Box -->
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-6 glass-card">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <i data-lucide="circle-alert" class="h-6 w-6 text-red-600"></i>
                            <div>
                                <h1 class="font-bold text-red-900">2 New Emergency Alert(s)</h1>
                                <p class="text-red-700">Immediate attention required</p>
                            </div>
                        </div>
                        <button
                            class="cursor-pointer rounded-md border border-solid border-input bg-danger transition-colors px-4 py-2 text-sm font-medium text-white hover:bg-red-500 w-full sm:w-auto">
                            View Alerts
                        </button>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="grid grid-cols-1 md:grid-cols-3 w-full gap-2 md:gap-0 md:h-10 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground outline-none">
                    <button
                        type="button"
                        data-target="active-emergencies"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 text-sm font-medium text-gray-900 transition-all cursor-pointer">
                        Active Emergencies
                    </button>

                    <button
                        type="button"
                        data-target="notifications"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 text-sm font-medium transition-all cursor-pointer">
                        Notifications
                        <div id="notification-count"
                            class="ml-2 inline-flex items-center rounded-full bg-red-500 px-2.5 py-0.5 text-xs font-semibold text-white">
                            2
                        </div>
                    </button>

                    <button
                        type="button"
                        data-target="team-status"
                        class="inline-flex h-9 w-full items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 text-sm font-medium transition-all cursor-pointer">
                        Team Status
                    </button>
                </div>

                <!-- Dashboard Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6 mt-2">
                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Requests</p>
                                <p class="text-2xl font-bold text-heading">2</p>
                            </div>
                            <i data-lucide="circle-alert" class="h-8 w-8 text-red-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pending</p>
                                <p class="text-2xl font-bold text-heading">1</p>
                            </div>
                            <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">In Progress</p>
                                <p class="text-2xl font-bold text-heading">0</p>
                            </div>
                            <i data-lucide="truck" class="h-8 w-8 text-blue-600"></i>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Resolved</p>
                                <p class="text-2xl font-bold text-heading">0</p>
                            </div>
                            <i data-lucide="check-circle" class="h-8 w-8 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Emergency Requests List -->
                <div data-section="active-emergencies" class="glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Emergency Requests</h3>

                    <!-- Request Card 1 -->
                    <div class="mb-4 rounded-lg border border-solid border-card-soft bg-gray-50 p-4">
                        <div class="mb-3">
                            <div class="mb-2 flex flex-wrap items-center gap-2">
                                <h4 class="font-medium text-heading">Ahmed Al-Rashid</h4>
                                <span
                                    class="rounded-full border border-solid border-red-200 bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">CRITICAL</span>
                                <span
                                    class="rounded-full bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800">PENDING</span>
                            </div>
                            <div class="mb-2 flex items-center gap-2 text-sm text-gray-600">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                                <span>123 Main Street, Downtown</span>
                            </div>
                            <p class="mb-2 text-gray-700">Chest pain and difficulty breathing</p>
                            <div class="text-xs text-gray-500">Reported: 18h ago</div>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button class="cursor-pointer rounded-md border border-solid border-input bg-medical-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary">Accept & Assign</button>
                            <button class="cursor-pointer rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">Update Status</button>
                            <button class="cursor-pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="map-pin" class="h-4 w-4"></i> View Location
                            </button>
                            <button class="cursor-pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="phone" class="h-4 w-4"></i> Call Patient
                            </button>
                        </div>
                    </div>

                    <!-- Request Card 2 -->
                    <div class="rounded-lg border border-solid border-card-soft bg-gray-50 p-4">
                        <div class="mb-3">
                            <div class="mb-2 flex flex-wrap items-center gap-2">
                                <h4 class="font-medium text-heading">Fatima Hassan</h4>
                                <span
                                    class="rounded-full border border-solid border-orange-200 bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800">HIGH</span>
                                <span
                                    class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">ASSIGNED</span>
                            </div>
                            <div class="mb-2 flex items-center gap-2 text-sm text-gray-600">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                                <span>456 Oak Avenue, North District</span>
                            </div>
                            <p class="mb-2 text-gray-700">Severe allergic reaction</p>
                            <div class="text-xs text-gray-500">Reported: 19h ago &nbsp; | &nbsp; ETA: 6:00 PM</div>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button class="cursor-pointer rounded-md border border-solid border-input bg-medical-600 px-3 py-2 text-sm font-medium text-white hover:bg-primary">Start Response</button>
                            <button class="cursor-pointer rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">Update Status</button>
                            <button class="cursor-pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="map-pin" class="h-4 w-4"></i> View Location
                            </button>
                            <button class="cursor-pointer flex items-center gap-1 rounded-md border border-solid border-input bg-white px-3 py-2 text-sm font-medium text-heading hover:bg-accent hover:text-primary">
                                <i data-lucide="phone" class="h-4 w-4"></i> Call Patient
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Emergency Notifications -->
                <div data-section="notifications" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Emergency Notifications</h3>

                    <div class="flex flex-col gap-3">
                        <!-- Notification 1 -->
                        <div class="notification-card p-4 rounded-lg border border-solid border-red-200 bg-red-50 cursor-pointer">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-medium text-heading">Critical Emergency Alert</h4>
                                    <p class="mt-1 text-gray-700">New critical emergency reported at 123 Main Street</p>
                                    <p class="mt-2 text-xs text-gray-500">18h ago</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="red-dot w-2 h-2 rounded-full bg-danger"></div>
                                    <div class="new-badge inline-flex items-center rounded-full border border-transparent bg-danger px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-red-500">
                                        NEW
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notification 2 -->
                        <div class="notification-card p-4 rounded-lg border border-solid border-red-200 bg-red-50 cursor-pointer">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-medium text-heading">Emergency Assignment</h4>
                                    <p class="mt-1 text-gray-700">You have been assigned to emergency case #2</p>
                                    <p class="mt-2 text-xs text-gray-500">19h ago</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="red-dot w-2 h-2 rounded-full bg-danger"></div>
                                    <div class="new-badge inline-flex items-center rounded-full border border-transparent bg-danger px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-red-500">
                                        NEW
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Status -->
                <div data-section="team-status" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold text-heading">Team Status</h3>

                    <div class="flex flex-col gap-4">
                        <!-- Team Alpha -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-green-200 bg-green-50 p-4">
                            <div>
                                <p class="font-medium text-green-900">Team Alpha (Your Team)</p>
                                <p class="text-sm text-green-700">Available - On Standby</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                READY
                            </div>
                        </div>

                        <!-- Team Beta -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-blue-200 bg-blue-50 p-4">
                            <div>
                                <p class="font-medium text-blue-900">Team Beta</p>
                                <p class="text-sm text-blue-700">En Route - ETA 8 minutes</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors hover:bg-primary/80">
                                ACTIVE
                            </div>
                        </div>

                        <!-- Team Gamma -->
                        <div class="flex items-center justify-between rounded-lg border border-solid border-gray-200 bg-gray-50 p-4">
                            <div>
                                <p class="font-medium text-gray-900">Team Gamma</p>
                                <p class="text-sm text-gray-700">Off Duty - Maintenance</p>
                            </div>

                            <div class="inline-flex items-center rounded-full border bg-neutral-100 px-2.5 py-0.5 text-xs font-semibold text-gray-800 transition-colors hover:bg-primary/80">
                                OFFLINE
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
    <script type="module" src="/mediconnect/assets/js/dashboard/ambulance/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>