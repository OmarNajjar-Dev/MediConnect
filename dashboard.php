<?php

require_once './backend/auth.php';

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
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/colors.css" />
    <link rel="stylesheet" href="css/typography.css" />
    <link rel="stylesheet" href="css/spacing.min.css" />
    <link rel="stylesheet" href="css/sizing.min.css" />
    <link rel="stylesheet" href="css/borders.css" />
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare &amp; Technology</title>

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
                <a href="./dashboard.php"
                    class="text-medical-700 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
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
            <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="./"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="./doctors.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="./hospitals.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="./appointments.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="./dashboard.php"
                        class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

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
    <main class="overflow-hidden pt-20 pb-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Medical Dashboard</h1>
                        <p class="text-gray-600">Welcome back, Dr. Sarah Johnson</p>
                        <p class="text-sm text-medical-600">Department: Cardiology</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap border border-solid border-transparent text-sm font-medium h-11 rounded-md px-8 bg-blue-600 hover:bg-blue-700 text-white pointer">
                            <i data-lucide="settings" class="h-4 w-4 mr-2"></i>Manage Profile
                        </button>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="glass-card rounded-xl p-6 border-2 border-blue-200 bg-blue-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-blue-900 mb-2 tracking-tight">Doctor Profile Management</h3>
                                <p class="text-blue-700 mb-4">Update your professional profile, contact information, and bio. Manage your personal settings.</p>
                                <div class="flex gap-4 text-sm text-blue-600">
                                    <span>✓ Profile Update</span><span>✓ Contact Info</span><span>✓ Professional Bio</span><span>✓ Profile Picture</span>
                                </div>
                            </div>
                            <div class="text-blue-600">
                                <i data-lucide="settings" class="w-12 h-12"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border border-solid border-transparent transition-colors h-10 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white pointer">Manage Your Profile →</button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 animate-fade-in">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4">
                                <i data-lucide="calendar" class="text-medical-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium tracking-tight">Appointments</h3>
                                <p class="text-2xl font-bold">24</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6 animate-fade-in">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4">
                                <i data-lucide="users" class="text-medical-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium tracking-tight">Active Users</h3>
                                <p class="text-2xl font-bold">1,240</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6 animate-fade-in">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4">
                                <i data-lucide="shield" class="text-medical-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium tracking-tight">Hospitals</h3>
                                <p class="text-2xl font-bold">15</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card rounded-xl p-6 animate-fade-in">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4">
                                <i data-lucide="user" class="text-medical-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium tracking-tight">Doctors</h3>
                                <p class="text-2xl font-bold">89</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card rounded-xl p-6 mb-8">
                    <h2 class="text-xl tracking-tight font-bold mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                        <a class="quick-links-dashboard whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1" href="./appointments.php">
                            <div class="text-medical-600"><i data-lucide="calendar" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Book Appointment</span>
                        </a>
                        <a class="quick-links-dashboard whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1" href="./doctors.php">
                            <div class="text-medical-600"><i data-lucide="user" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Find Doctor</span>
                        </a>
                        <a class="quick-links-dashboard whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1" href="./hospitals.php">
                            <div class="text-medical-600"><i data-lucide="star" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Find Hospitals</span>
                        </a>
                        <a class="quick-links-dashboard whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1" href="./emergency.php">
                            <div class="text-red-600"><i data-lucide="plus" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Emergency Service</span>
                        </a>
                        <button class="quick-links-dashboard whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1">
                            <div class="text-medical-600"><i data-lucide="settings" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Profile</span>
                        </button>
                        <a class="whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-1" href="./blood-donation.php">
                            <div class="text-red-600"><i data-lucide="activity" class="w-4 h-4"></i></div>
                            <span class="text-sm font-normal text-gray-900">Blood Donation</span>
                        </a>
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
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
                            <i class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
                            <i class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
                            <i class="h-4 w-4"></i>
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
                            <i class="h-7 w-7 text-medical-500 pr-2"></i>
                            <span class="text-gray-600">
                                123 Healthcare Avenue, Medical District, City, Country
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="h-4 w-4 text-medical-500"></i>
                            <span class="text-gray-600">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="h-4 w-4 text-medical-500"></i>
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
    <script type="module" src="./js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>