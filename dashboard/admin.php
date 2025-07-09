<?php

require_once '../backend/auth.php'; // handles autologin via cookie

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
    <link rel="stylesheet" href="../css/base.css" />
    <link rel="stylesheet" href="../css/colors.css" />
    <link rel="stylesheet" href="../css/typography.css" />
    <link rel="stylesheet" href="../css/spacing.min.css" />
    <link rel="stylesheet" href="../css/sizing.min.css" />
    <link rel="stylesheet" href="../css/borders.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/animations.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">
            <a href="./" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8">
                <a href="./" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="./doctors.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="./hospitals.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="./appointments.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
                <a href="././dashboard/superadmin.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
            </nav>

            <!-- Header Right Section -->
            <div class="flex items-center gap-4">
                <!-- Sign In / Sign Up buttons (hidden by default) -->
                <a href="./login.php"
                    class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all">Sign
                    In</a>
                <a href="./register.php"
                    class="hidden md:flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all">Sign
                    Up</a>

                <!-- Mobile Menu Button -->
                <button id="menu-button"
                    class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation (Hidden by default) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="./"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="./doctors.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="./hospitals.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="./appointments.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="././dashboard/superadmin.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

                    <!-- Sign In / Sign Up buttons (Mobile view) -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="./login.php"
                            class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
                            In</a>
                        <a href="./register.php"
                            class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
                            Up</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

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
                        <p class="mt-1 text-sm text-medical-600">
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
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium text-gray-900 transition-all pointer">
                            Overview
                        </button>
                        <button
                            type="button"
                            data-target="our-doctors"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none px-3 py-1.5 text-sm font-medium transition-all pointer">
                            Our Doctors
                        </button>
                        <button
                            type="button"
                            data-target="hospital-settings"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none px-3 py-1.5 text-sm font-medium transition-all pointer">
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

                                    <button class="pointer inline-flex h-10 w-full items-center gap-2 whitespace-nowrap rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                                        <i data-lucide="user-check" class="mr-2 h-4 w-4"></i>
                                        Add New Doctor
                                    </button>

                                    <button class="pointer inline-flex h-10 w-full items-center gap-2 whitespace-nowrap rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
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
                                <button class="pointer inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-medical-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-medical-400">
                                    <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                    Add Doctor
                                </button>
                            </div>

                            <!-- Doctors Table -->
                            <div class="overflow-x-auto">
                                <div class="relative w-full overflow-auto">
                                    <table class="w-full caption-bottom text-sm">
                                        <thead class="[&_tr]:border-b">
                                            <tr class="border-b transition-colors hover:bg-muted/50">
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Name</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Email</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Specialization</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Phone</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">License</th>
                                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                                <th class="h-12 px-4 text-right align-middle font-medium text-muted-foreground">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody class="[&_tr:last-child]:border-0">

                                            <!-- Doctor 1 -->
                                            <tr class="border-b transition-colors hover:bg-muted/50">
                                                <td class="p-4 align-middle font-medium">Dr. Sarah Johnson</td>
                                                <td class="p-4 align-middle">sarah.johnson@alnoor.hospital</td>
                                                <td class="p-4 align-middle">Cardiology</td>
                                                <td class="p-4 align-middle">+1-555-0101</td>
                                                <td class="p-4 align-middle">MD-12345</td>
                                                <td class="p-4 align-middle">
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
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
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
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
                                                    <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                                        active
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right align-middle">
                                                    <div class="flex justify-end gap-2">
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                                        </button>
                                                        <button class="pointer inline-flex h-9 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800">
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
                                <button class="pointer inline-flex h-10 items-center justify-center gap-2 whitespace-nowrap rounded-md border-none bg-medical-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-medical-400">
                                    <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    Edit Details
                                </button>
                            </div>

                            <!-- Hospital Information -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                                <!-- Left Column -->
                                <div>
                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Hospital Name</label>
                                    <p class="mb-4 text-gray-700">Al Noor Medical Center</p>

                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Location</label>
                                    <p class="mb-4 text-gray-700">North District</p>

                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Address</label>
                                    <p class="text-gray-700">123 Medical Plaza, North District</p>
                                </div>

                                <!-- Right Column -->
                                <div>
                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Phone</label>
                                    <p class="mb-4 text-gray-700">+1-555-0100</p>

                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                                    <p class="mb-4 text-gray-700">info@alnoor.hospital</p>

                                    <label class="font-medium text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Hospital ID</label>
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
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="./" class="inline-block mb-4">
                        <span class="text-medical-700 font-semibold text-2xl">
                            Medi<span class="text-medical-500">Connect</span>
                        </span>
                    </a>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Connecting patients with healthcare professionals for better care
                        and outcomes.
                    </p>
                    <div class="footer-socials flex gap-4 transition-all">
                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="instagram" class="h-4 w-4"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Services
                    </h4>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="./appointments.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="./doctors.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="./hospitals.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="./emergency.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Emergency Services
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Quick Links
                    </h4>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="./about.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="./privacy.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="./terms.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="./faq.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="./contact.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
                        Contact
                    </h4>
                    <ul class="flex flex-col gap-3">
                        <li class="flex gap-1">
                            <i data-lucide="map-pin" class="h-7 w-7 text-medical-500 pr-2"></i>
                            <span class="text-gray-600">
                                123 Healthcare Avenue, Medical District, City, Country
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="phone" class="h-4 w-4 text-medical-500"></i>
                            <span class="text-gray-600">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="mail" class="h-4 w-4 text-medical-500"></i>
                            <span class="text-gray-600">contact@mediconnect.example</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-solid separator text-center text-gray-600 text-sm">
                <p>&copy; 2025 MediConnect. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- External JavaScript -->
    <script type="module" src="../js/common/index.js"></script>
    <script type="module" src="../js/dashboard/admin/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>