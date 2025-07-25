<?php

// 0. Redirect to coming soon if this dashboard is not ready
require_once __DIR__ . "/../../backend/middleware/redirect-to-coming-soon.php";

// 1. Start session and load user context
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 2. Load path configuration
require_once __DIR__ . "/../../backend/config/path.php";

// 3. Define required role for this dashboard
$requiredRole = 'hospital_admin';

// 4. Protect the dashboard: redirect if user role does not match
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
    <link rel="stylesheet" href="/assets/css/base/base.css" />
    <link rel="stylesheet" href="/assets/css/base/typography.css" />

    <!-- Design System -->
    <link rel="stylesheet" href="/assets/css/utils/colors.css" />
    <link rel="stylesheet" href="/assets/css/utils/spacing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/sizing.min.css" />
    <link rel="stylesheet" href="/assets/css/utils/borders.css" />
    <link rel="stylesheet" href="/assets/css/utils/ring.css" />

    <!-- Layout & Components -->
    <link rel="stylesheet" href="/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/assets/css/components/animations.css" />

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

    <!-- Main Content -->
    <main class="min-h-screen pt-20 pb-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">

                <!-- Header Section -->
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">
                            Logged in as: <span class="font-medium">HOSPITAL ADMIN</span>
                        </p>
                        <h1 class="text-2xl font-bold text-gray-900">
                            Welcome back, Dr. Michael Thompson
                        </h1>
                        <p class="mt-1 text-sm text-primary">
                            Al Noor Medical Center
                        </p>
                    </div>
                </div>

                <!-- Title & Description -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="building2" class="h-8 w-8 text-blue-600"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Hospital Admin Panel</h1>
                            <p class="text-gray-600">Managing Al Noor Medical Center</p>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground outline-none">
                        <button
                            type="button"
                            data-target="overview"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium text-gray-900 transition-all cursor-pointer">
                            Overview
                        </button>
                        <button
                            type="button"
                            data-target="our-doctors"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none px-3 py-1.5 text-sm font-medium transition-all cursor-pointer">
                            Our Doctors
                        </button>
                        <button
                            type="button"
                            data-target="hospital-settings"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none px-3 py-1.5 text-sm font-medium transition-all cursor-pointer">
                            Hospital Settings
                        </button>
                    </div>

                    <!-- Overview Section -->
                    <div data-section="overview" class="mt-2 flex flex-col gap-6">

                        <!-- Statistics Cards -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

                            <!-- Total Beds -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Total Beds</p>
                                        <p class="text-2xl font-bold">150</p>
                                        <p class="text-xs text-gray-500">45 available</p>
                                    </div>
                                    <i data-lucide="bed" class="h-8 w-8 text-blue-600"></i>
                                </div>
                            </div>

                            <!-- Our Doctors -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Our Doctors</p>
                                        <p class="text-2xl font-bold">3</p>
                                        <p class="text-xs text-gray-500">3 active</p>
                                    </div>
                                    <i data-lucide="user-check" class="h-8 w-8 text-green-600"></i>
                                </div>
                            </div>

                            <!-- Departments -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Departments</p>
                                        <p class="text-2xl font-bold">5</p>
                                        <p class="text-xs text-gray-500">Active departments</p>
                                    </div>
                                    <i data-lucide="building2" class="h-8 w-8 text-purple-600"></i>
                                </div>
                            </div>

                            <!-- Occupancy -->
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Occupancy</p>
                                        <p class="text-2xl font-bold">70%</p>
                                        <p class="text-xs text-gray-500">Current rate</p>
                                    </div>
                                    <i data-lucide="users" class="h-8 w-8 text-orange-600"></i>
                                </div>
                            </div>

                        </div>

                        <!-- Actions & Departments -->
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                            <!-- Quick Actions -->
                            <div class="glass-card rounded-xl p-6">
                                <h3 class="mb-4 text-xl font-bold">Quick Actions</h3>
                                <div class="flex flex-col gap-3">

                                    <button class="cursor-pointer inline-flex h-10 w-full items-center gap-2 whitespace-nowrap rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-medical-500">
                                        <i data-lucide="user-check" class="mr-2 h-4 w-4"></i>
                                        Add New Doctor
                                    </button>

                                    <button class="cursor-pointer inline-flex h-10 w-full items-center gap-2 whitespace-nowrap rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-medical-500">
                                        <i data-lucide="building2" class="mr-2 h-4 w-4"></i>
                                        Update Hospital Info
                                    </button>

                                </div>
                            </div>

                            <!-- Departments List -->
                            <div class="glass-card rounded-xl p-6">
                                <h3 class="mb-4 text-xl font-bold">Departments</h3>
                                <div class="flex flex-col gap-2">

                                    <div class="flex items-center justify-between rounded bg-gray-50 p-2">
                                        <span class="font-medium">Cardiology</span>
                                        <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">Active</div>
                                    </div>

                                    <div class="flex items-center justify-between rounded bg-gray-50 p-2">
                                        <span class="font-medium">Neurology</span>
                                        <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">Active</div>
                                    </div>

                                    <div class="flex items-center justify-between rounded bg-gray-50 p-2">
                                        <span class="font-medium">Pediatrics</span>
                                        <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">Active</div>
                                    </div>

                                    <div class="flex items-center justify-between rounded bg-gray-50 p-2">
                                        <span class="font-medium">Emergency</span>
                                        <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">Active</div>
                                    </div>

                                    <div class="flex items-center justify-between rounded bg-gray-50 p-2">
                                        <span class="font-medium">Surgery</span>
                                        <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">Active</div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Our Doctors Section -->
                    <div data-section="our-doctors" class="hidden mt-2">
                        <div class="glass-card rounded-xl p-6">

                            <!-- Header -->
                            <div class="mb-6 flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold">Doctor Management</h3>
                                    <p class="text-gray-600">Manage doctors in Al Noor Medical Center</p>
                                </div>
                                <button class="cursor-pointer inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-primary px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-medical-400">
                                    <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                    Add Doctor
                                </button>
                            </div>

                            <!-- Doctors Table -->
                            <div class="overflow-x-auto">
                                <div class="relative w-full overflow-auto">
                                    <table class="border-collapse w-full text-sm">
                                        <thead class="border-b border-solid border-card-soft">
                                            <tr class="transition-colors hover:bg-muted/50">
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Name</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Email</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Specialization</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Phone</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">License</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                                <th class="h-12 px-4 text-right align-middle font-medium text-muted-foreground">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-no-border-last">

                                            <!-- Doctor 1 -->
                                            <tr class="border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
                                                <td class="p-4 align-middle font-medium">Dr. Sarah Johnson</td>
                                                <td class="p-4 align-middle">sarah.johnson@alnoor.hospital</td>
                                                <td class="p-4 align-middle">Cardiology</td>
                                                <td class="p-4 align-middle">+1-555-0101</td>
                                                <td class="p-4 align-middle">MD-12345</td>
                                                <td class="p-4 align-middle">
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-primary px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-medical-500">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
                                                            <i data-lucide="trash2" class="h-4 w-4"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Doctor 2 -->
                                            <tr class="transition-colors hover:bg-muted/50">
                                                <td class="p-4 align-middle font-medium">Dr. Ahmed Hassan</td>
                                                <td class="p-4 align-middle">ahmed.hassan@alnoor.hospital</td>
                                                <td class="p-4 align-middle">Neurology</td>
                                                <td class="p-4 align-middle">+1-555-0102</td>
                                                <td class="p-4 align-middle">MD-12346</td>
                                                <td class="p-4 align-middle">
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-primary px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-medical-500">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
                                                            <i data-lucide="trash2" class="h-4 w-4"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Doctor 3 -->
                                            <tr class="border-b transition-colors hover:bg-muted/50">
                                                <td class="p-4 align-middle font-medium">Dr. Maria Rodriguez</td>
                                                <td class="p-4 align-middle">maria.rodriguez@alnoor.hospital</td>
                                                <td class="p-4 align-middle">Pediatrics</td>
                                                <td class="p-4 align-middle">+1-555-0103</td>
                                                <td class="p-4 align-middle">MD-12347</td>
                                                <td class="p-4 align-middle">
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-primary px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-medical-500">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="cursor-pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
                                                            <i data-lucide="trash2" class="h-4 w-4"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Hospital Settings Section -->
                    <div data-section="hospital-settings" class="hidden mt-2">
                        <div class="glass-card rounded-xl p-6">

                            <!-- Header -->
                            <div class="mb-6 flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold">Hospital Settings</h3>
                                    <p class="text-gray-600">Update information for Al Noor Medical Center</p>
                                </div>
                                <button class="cursor-pointer inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-primary px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-medical-400">
                                    <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    Edit Details
                                </button>
                            </div>

                            <!-- Hospital Information -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                                <!-- Left Column -->
                                <div>
                                    <label class="font-medium text-sm leading-none">Hospital Name</label>
                                    <p class="mb-4 text-gray-700">Al Noor Medical Center</p>

                                    <label class="font-medium text-sm leading-none">Location</label>
                                    <p class="mb-4 text-gray-700">North District</p>

                                    <label class="font-medium text-sm leading-none">Address</label>
                                    <p class="text-gray-700">123 Medical Plaza, North District</p>
                                </div>

                                <!-- Right Column -->
                                <div>
                                    <label class="font-medium text-sm leading-none">Phone</label>
                                    <p class="mb-4 text-gray-700">+1-555-0100</p>

                                    <label class="font-medium text-sm leading-none">Email</label>
                                    <p class="mb-4 text-gray-700">info@alnoor.hospital</p>

                                    <label class="font-medium text-sm leading-none">Hospital ID</label>
                                    <p class="text-gray-700">#2</p>
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
    <script type="module" src="/assets/js/common/index.js"></script>
    <script type="module" src="/assets/js/dashboard/admin/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>