<?php

// 0. Redirect to coming soon if this dashboard is not ready
require_once __DIR__ . "/../../backend/middleware/redirect-to-coming-soon.php";

// 4. Define required role for this dashboard
$requiredRole = 'staff';

// 5. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../../backend/middleware/protect-dashboard.php";

// 6. Include avatar helper
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
    <main class="pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">

                <!-- Staff Greeting & Panel Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">
                            Logged in as: <span class="font-medium">STAFF</span>
                        </p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Mary Williams</h1>
                        <p class="mt-1 text-sm text-primary">Al Noor Medical Center</p>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="calendar" class="h-8 w-8 text-purple-600 calendar-icon"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Staff Panel</h1>
                            <p class="text-gray-600">Appointment Management System</p>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div
                        class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground cursor-pointer">
                        <button
                            type="button"
                            data-target="Manage-Appointments"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium cursor-pointer">
                            Manage Appointments
                        </button>

                        <button
                            type="button"
                            data-target="Available-Doctors"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                            Available Doctors
                        </button>

                        <button
                            type="button"
                            data-target="Daily-Schedule"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium cursor-pointer">
                            Daily Schedule
                        </button>
                    </div>

                    <div class="mt-2 flex flex-col gap-6" style="animation-duration: 0s">
                        <!-- Quick statistics summary cards for today's overview -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

                            <!-- Today's Total -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Today's Total</p>
                                        <p class="text-2xl font-bold">4</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                </div>
                            </div>

                            <!-- Pending -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Pending</p>
                                        <p class="text-2xl font-bold">2</p>
                                    </div>
                                    <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                                </div>
                            </div>

                            <!-- Completed -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Completed</p>
                                        <p class="text-2xl font-bold">0</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-green-600"></i>
                                </div>
                            </div>

                            <!-- Available Doctors -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Available Doctors</p>
                                        <p class="text-2xl font-bold">3</p>
                                    </div>
                                    <i data-lucide="users" class="h-8 w-8 text-purple-600"></i>
                                </div>
                            </div>

                        </div>

                        <!-- Section to manage appointments with edit, delete, and assign options -->
                        <div data-section="Manage-Appointments" class="hidden glass-card rounded-xl p-6">
                            <!-- Header -->
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-xl font-bold">Appointment Management</h3>
                                <button
                                    class="cursor-pointer inline-flex h-10 items-center justify-center gap-2 rounded-md border border-input border-solid bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-medical-400 transition-colors">
                                    <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                    Create Appointment
                                </button>
                            </div>

                            <!-- Appointments List -->
                            <div class="flex flex-col gap-3">

                                <!-- Appointment: Ahmed Al-Rashid -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-success"></div>
                                        <div>
                                            <p class="font-medium">Ahmed Al-Rashid</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">Regular checkup - chest pain complaints</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 09:00</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                            confirmed
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Fatima Hassan -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Fatima Hassan</p>
                                            <p class="text-sm text-gray-600">follow-up • 45 min</p>
                                            <p class="text-sm text-gray-500">Follow-up on previous consultation</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Ahmed Hassan</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 10:30</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                            pending
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Mohammed Ali -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-info"></div>
                                        <div>
                                            <p class="font-medium">Mohammed Ali</p>
                                            <p class="text-sm text-gray-600">routine-checkup • 60 min</p>
                                            <p class="text-sm text-gray-500">Annual health screening</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 11:15</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors">
                                            in progress
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Appointment: Layla Ibrahim -->
                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 w-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Layla Ibrahim</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">New patient - needs doctor assignment</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">Unassigned</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 14:00</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                            pending
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-primary">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500">
                                            <i data-lucide="user" class="mr-1 h-4 w-4"></i>
                                            Assign
                                        </button>
                                        <button
                                            class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-red-600 hover:bg-accent hover:text-red-800">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Section displaying currently available doctors and their specialties -->
                <div data-section="Available-Doctors" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold">Available Doctors</h3>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Sarah Johnson</p>
                                    <p class="text-sm text-gray-600">Cardiology</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="cursor-pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Ahmed Hassan</p>
                                    <p class="text-sm text-gray-600">General Medicine</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">
                                    busy
                                </div>
                            </div>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                    <p class="text-sm text-gray-600">Dermatology</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="cursor-pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                        <div class="rounded-lg bg-gray-50 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Dr. Mohammed Ali</p>
                                    <p class="text-sm text-gray-600">Orthopedics</p>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    available
                                </div>
                            </div>
                            <button
                                class="cursor-pointer mt-2 inline-flex h-9 items-center justify-center gap-2 rounded-md border border-input border-solid bg-background px-3 text-sm font-medium text-black hover:bg-accent hover:text-medical-500">
                                View Schedule
                            </button>
                        </div>

                    </div>
                </div>


                <!-- Section displaying today's scheduled appointments with status and timing -->
                <div data-section="Daily-Schedule" class="hidden glass-card rounded-xl p-6">
                    <h3 class="mb-4 text-xl font-bold">Daily Schedule Overview</h3>

                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-1 gap-4">

                            <!-- 09:00 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">09:00</div>
                                    <div>
                                        <p class="font-medium">Ahmed Al-Rashid</p>
                                        <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors">
                                    confirmed
                                </div>
                            </div>

                            <!-- 10:30 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">10:30</div>
                                    <div>
                                        <p class="font-medium">Fatima Hassan</p>
                                        <p class="text-sm text-gray-600">Dr. Ahmed Hassan</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                    pending
                                </div>
                            </div>

                            <!-- 11:15 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">11:15</div>
                                    <div>
                                        <p class="font-medium">Mohammed Ali</p>
                                        <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors">
                                    in progress
                                </div>
                            </div>

                            <!-- 14:00 Appointment -->
                            <div class="flex items-center justify-between rounded-lg border border-solid border-card-soft p-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 text-sm font-medium">14:00</div>
                                    <div>
                                        <p class="font-medium">Layla Ibrahim</p>
                                        <p class="text-sm text-gray-600">Unassigned</p>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center rounded-full border border-transparent bg-orange-100 px-2.5 py-0.5 text-xs font-semibold text-orange-800 transition-colors">
                                    pending
                                </div>
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
    <script type="module" src="/mediconnect/assets/js/dashboard/staff/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>