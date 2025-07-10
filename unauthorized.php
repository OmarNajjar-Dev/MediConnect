<?php

require_once './backend/auth.php'; // handles autologin via cookie

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
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/colors.css" />
    <link rel="stylesheet" href="./css/typography.css" />
    <link rel="stylesheet" href="./css/spacing.min.css" />
    <link rel="stylesheet" href="./css/sizing.min.css" />
    <link rel="stylesheet" href="./css/borders.css" />
    <link rel="stylesheet" href="./css/ring.css" />
    <link rel="stylesheet" href="./css/layout.css" />
    <link rel="stylesheet" href="./css/animations.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background text-heading">
    
    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">
            <a href="/" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8">
                <a href="/" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="/doctors.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="/hospitals.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="/appointments.html"
                    class="text-medical-700 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
                <a href="/dashboard.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
            </nav>

            <!-- Header Right Section -->
            <div class="flex items-center gap-4">
                <!-- Sign In / Sign Up buttons (hidden by default) -->
                <a href="/login.html"
                    class="hidden items-center justify-center bg-input text-heading border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    In</a>
                <a href="/signup.html"
                    class="hidden items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    Up</a>

                <!-- Mobile Menu Button -->
                <button id="menu-button"
                    class="inline-flex items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-0 pointer md:hidden">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation (Hidden by default) -->
            <div id="mobile-nav"
                class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="/"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="/doctors.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="/hospitals.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="/appointments.html"
                        class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="/dashboard.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

                    <!-- Sign In / Sign Up buttons (Mobile view) -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="/login.html"
                            class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
                            In</a>
                        <a href="/signup.html"
                            class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
                            Up</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="page-transition page-enter-active">
            <div class="min-h-screen bg-background flex items-center justify-center p-4">
                <div class="max-w-md w-full text-center flex flex-col gap-8 transition-all duration-700 opacity-100 translate-y-0">
                    <div class="flex justify-center">
                        <div class="relative">
                            <div class="w-24 h-24 bg-medical-50 rounded-full flex items-center justify-center">
                                <i data-lucide="shield" class="w-12 h-12 text-medical-600"></i>
                            </div>
                            <div class="icon-badge absolute w-6 h-6 bg-danger rounded-full flex items-center justify-center"><span class="text-white text-xs font-bold">!</span></div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h1 class="text-4xl font-bold text-foreground text-heading tracking-tight">401</h1>
                        <h2 class="text-2xl font-semibold text-foreground text-heading tracking-tight">Unauthorized Access</h2>
                        <p class="text-muted-foreground text-lg leading-relaxed">You don't have permission to view this page. Please check your credentials or contact your administrator.</p>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-16 h-1 bg-medical-100 rounded-full relative">
                            <div class="centered-vertical-line absolute w-1 h-16 bg-medical-100 rounded-full"></div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 pointer">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowra bg-medical-500 text-white hover:bg-medical-400 border border-solid border-input rounded-md px-8 w-full h-12 text-lg font-medium transition-all transition-200 hover:scale-105 pointer">
                            <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>Return to Home</button>
                            <button class="w-full text-muted-foreground hover:text-medical-600 transition-colors transition-200 text-sm flex items-center justify-center gap-2 pointer bg-transparent border-none">
                            <i data-lucide="mail" class="w-4 h-4"></i>Contact support if you believe this is a mistake</button>
                    </div>

                    <div class="pt-8">
                        <div class="text-xs text-gray-400">MediConnect Healthcare Platform</div>
                    </div>
                </div>
                <div class="fixed inset-0 pointer-events-none opacity-[0.02] overflow-hidden">
                    <div class="absolute top-10 left-10 w-8 h-8 border-2 border-primary rounded-full"></div>
                    <div class="absolute top-32 right-20 w-6 h-6 border-2 border-primary rounded-full"></div>
                    <div class="absolute bottom-20 left-20 w-10 h-10 border-2 border-primary rounded-full"></div>
                    <div class="absolute bottom-40 right-10 w-4 h-4 border-2 border-primary rounded-full"></div>
                    <div class="absolute top-1/2 left-5 w-12 h-1 bg-primary rounded-full"></div>
                    <div class="absolute top-1/4 right-5 w-1 h-12 bg-primary rounded-full"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="/" class="inline-block mb-4">
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
                            <a href="/appointments.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="/doctors.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="/hospitals.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="/emergency.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Emergency Services
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Pharmacy Orders
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
                            <a href="/about.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="/privacy.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="/terms.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="/faq.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="/contact.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
    <script type="module" src="./js/common/index.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>