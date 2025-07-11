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
            <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg">
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
    <main class="pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Logged in as: <span class="font-medium">PATIENT</span></p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, John Doe</h1>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="user" class="h-8 w-8 text-blue-600"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Patient Portal</h1>
                            <p class="text-gray-600">Welcome back, John Doe</p>
                        </div>
                    </div>
                    <div>

                        <!-- Tab Navigation -->
                        <div
                            class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground pointer">
                            <button
                                type="button"
                                data-target="Appointments"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium pointer">
                                Appointments
                            </button>

                            <button
                                type="button"
                                data-target="Medical-history"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                                Medical history
                            </button>

                            <button
                                type="button"
                                data-target="My-Profile"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                                My Profile
                            </button>
                        </div>

                        <div class="mt-2 flex flex-col gap-6" style="animation-duration: 0s">
                            <!-- Appointment Summary Cards: Upcoming, Completed, This Month -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Upcoming</p>
                                            <p class="text-2xl font-bold">2</p>
                                        </div>
                                        <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Completed</p>
                                            <p class="text-2xl font-bold">3</p>
                                        </div>
                                        <i data-lucide="file-text" class="h-8 w-8 text-green-600"></i>
                                    </div>
                                </div>

                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">This Month</p>
                                            <p class="text-2xl font-bold">2</p>
                                        </div>
                                        <i data-lucide="clock" class="h-8 w-8 text-purple-600"></i>
                                    </div>
                                </div>

                            </div>



                            <div data-section="Appointments" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Upcoming Appointments Section with Booking & Action Buttons -->
                                <div class="glass-card rounded-xl p-6">

                                    <!-- Header: Title + Book Button -->
                                    <div class="mb-4 flex items-center justify-between">
                                        <h3 class="text-xl font-bold">Upcoming Appointments</h3>

                                        <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-input bg-medical-500 px-3 text-sm font-medium text-white hover:bg-medical-400 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                            <i data-lucide="plus" class="mr-2 h-4 w-4"></i>
                                            Book New
                                        </button>
                                    </div>

                                    <!-- Appointments List -->
                                    <div class="flex flex-col gap-3">

                                        <!-- Appointment Card 1 -->
                                        <div class="rounded-lg bg-gray-50 p-4">
                                            <div class="mb-3 flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium">Dr. Sarah Johnson</p>
                                                    <p class="text-sm text-gray-600">Cardiology</p>
                                                    <p class="text-sm text-gray-600">Al Noor Medical Center</p>
                                                    <p class="mt-1 text-sm font-medium">2025-07-08 at 10:00</p>
                                                </div>
                                                <div class="inline-flex items-center rounded-full border border-transparent bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 transition-colors hover:bg-primary/80">
                                                    confirmed
                                                </div>
                                            </div>

                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-input bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                                    <i data-lucide="square-pen" class="mr-1 h-4 w-4"></i>
                                                    Reschedule
                                                </button>

                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-red-200 bg-background px-3 text-sm font-medium text-red-600 hover:bg-red-50 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                                    <i data-lucide="x" class="mr-1 h-4 w-4"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Appointment Card 2 -->
                                        <div class="rounded-lg bg-gray-50 p-4">
                                            <div class="mb-3 flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium">Dr. Ahmed Hassan</p>
                                                    <p class="text-sm text-gray-600">General Medicine</p>
                                                    <p class="text-sm text-gray-600">City Hospital</p>
                                                    <p class="mt-1 text-sm font-medium">2025-07-12 at 14:30</p>
                                                </div>
                                                <div class="inline-flex items-center rounded-full border border-transparent bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800 transition-colors hover:bg-primary/80">
                                                    scheduled
                                                </div>
                                            </div>

                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-input bg-background px-3 text-sm font-medium hover:bg-accent hover:text-medical-500 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                                    <i data-lucide="square-pen" class="mr-1 h-4 w-4"></i>
                                                    Reschedule
                                                </button>

                                                <button class="inline-flex items-center justify-center h-9 rounded-md border border-solid border-red-200 bg-background px-3 text-sm font-medium text-red-600 hover:bg-red-50 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                                    <i data-lucide="square-pen" class="mr-1 h-4 w-4"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Quick Actions Section with Utility Buttons -->
                                <div class="glass-card rounded-xl p-6">

                                    <h3 class="mb-4 text-xl font-bold">Quick Actions</h3>

                                    <div class="flex flex-col gap-3">

                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                            <i data-lucide="calendar" class="mr-2 h-4 w-4"></i>
                                            Book New Appointment
                                        </button>

                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                            <i data-lucide="file-text" class="mr-2 h-4 w-4"></i>
                                            View Test Results
                                        </button>

                                        <button class="inline-flex w-full items-center justify-start h-10 rounded-md border border-solid border-input bg-background px-4 py-2 text-sm font-medium hover:bg-accent hover:text-medical-500 disabled:pointer-events-none disabled:opacity-50 pointer gap-2 whitespace-nowrap">
                                            <i data-lucide="clock" class="mr-2 h-4 w-4"></i>
                                            Request Prescription Refill
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Medical history section showing past appointment details -->
                    <div data-section="Medical-history" class="mt-2">
                        <div class="glass-card rounded-xl p-6">
                            <h3 class="mb-4 text-xl font-bold">Appointment History</h3>
                            <div class="flex flex-col gap-3">

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="mt-1 text-sm text-gray-600">Cardiology</p>
                                        <p class="mt-1 text-sm text-gray-500">ECG normal, continue medication</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-06-15</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors hover:bg-primary/80">
                                            completed
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                        <p class="mt-1 text-sm text-gray-600">Dermatology</p>
                                        <p class="mt-1 text-sm text-gray-500">Skin condition treated successfully</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-05-20</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                            completed
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-4">
                                    <div>
                                        <p class="font-medium">Dr. Mohammed Ali</p>
                                        <p class="mt-1 text-sm text-gray-600">Orthopedics</p>
                                        <p class="mt-1 text-sm text-gray-500">Joint pain assessment, recommended PT</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">2025-04-10</p>
                                        <div
                                            class="inline-flex items-center rounded-full border border-transparent bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-800 transition-colors">
                                            completed
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- User profile section displaying personal and contact information -->
                    <div data-section="My-Profile" class="mt-2">
                        <div class="glass-card rounded-xl p-6">
                            <div class="mb-6 flex items-center justify-between">
                                <h3 class="text-xl font-bold">My Profile</h3>
                                <button
                                    class="pointer inline-flex items-center justify-center gap-2 rounded-md border border-input border-solid bg-medical-500 px-4 py-2 text-sm font-medium text-white disabled:opacity-50 disabled:pointer-events-none hover:bg-medical-400 h-10 whitespace-nowrap">
                                    <i data-lucide="square-pen" class="mr-2 h-4 w-4"></i>
                                    Edit Profile
                                </button>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-sm font-medium leading-none">Full Name</label>
                                    <p class="mb-4 text-gray-700">John Doe</p>

                                    <label class="mb-1 block text-sm font-medium leading-none">Email</label>
                                    <p class="mb-4 text-gray-700">john.doe@email.com</p>

                                    <label class="mb-1 block text-sm font-medium leading-none">Phone</label>
                                    <p class="mb-4 text-gray-700">+1-555-2001</p>

                                    <label class="block text-sm font-medium leading-none">Address</label>
                                    <p class="text-gray-700">123 Main Street, Downtown</p>
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm font-medium leading-none">Date of Birth</label>
                                    <p class="mb-4 text-gray-700">1985-06-15</p>

                                    <label class="mb-1 block text-sm font-medium leading-none">Blood Type</label>
                                    <p class="mb-4 text-gray-700">A+</p>

                                    <label class="mb-1 block text-sm font-medium leading-none">Emergency Contact</label>
                                    <p class="mb-4 text-gray-700">Jane Doe - +1-555-2002</p>

                                    <label class="block text-sm font-medium leading-none">Patient ID</label>
                                    <p class="text-gray-700">#4</p>
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
    <script type="module" src="../js/dashboard/patient/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>