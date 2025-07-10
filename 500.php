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
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background text-heading">

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
            <div id="mobile-nav"
                class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
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
      <!-- main Section -->
    <main class="flex-grow pt-16">
    <div class="page-transition page-enter-active">
        <div class="min-h-screen bg-background flex items-center justify-center p-4">
            <div class="max-w-lg w-full text-center flex flex-col gap-8 transition-all duration-700 opacity-100 translate-y-0">
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-28 h-28 bg-red-100 rounded-full flex items-center justify-center"><i data-lucide="stethoscope" class="w-14 h-14 text-danger"></i>
                    </div>
                        <div class="alert-badge absolute w-8 h-8 bg-danger rounded-full flex items-center justify-center animate-pulse">
                            <i data-lucide="triangle-alert" class="w-4 h-4 text-white"></i>
                         </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <h1 class="text-5xl font-bold text-foreground text-heading tracking-tight">500</h1>
                    <h2 class="text-2xl font-semibold text-foreground text-heading tracking-tight">Internal Server Error</h2>
                    <p class="text-muted-foreground text-lg leading-relaxed max-w-md mx-auto">Something went wrong on our end. Our medical team is working to fix this issue.</p>
                    <p class="text-muted-foreground text-sm">Please try again later or contact support if the problem persists.</p>
                </div>
                <div class="flex justify-center py-4">
                    <div class="w-32 h-0.5 bg-medical-200 rounded-full relative overflow-hidden"></div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row gap-3 justify-center"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap bg-medical-500 text-white hover:bg-medical-400 rounded-md px-8 flex-1 sm:flex-initial h-12 text-lg border-none font-medium transition-all duration-200 pointer hover:scale-105">
                        <i data-lucide="home" class="w-5 h-5 mr-2"></i>Return to Home</button>
                                      
                    <button class="UpdateButton inline-flex items-center justify-center gap-2 whitespace-nowrap ring-offset-background focus-visible:outline-none border border-input border-solid bg-background hover:bg-medical-50 hover:text-medical-600 rounded-md px-8 flex-1 h-12 text-lg font-medium transition-all duration-200 hover:scale-105"><i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i>Try Again</button></div>
                </div>
                <div class="pt-4">
                    <p class="text-xs text-gray-400">Need immediate assistance? Contact our support team</p>
                    <div class="mt-2"><button class="text-sm text-medical-600 hover:text-medical-400 border-none bg-transparent transition-colors pointer duration-200 underline underline-offset-4">Get Help</button></div>
                </div>
                <div class="pt-6">
                    <div class="text-xs text-gray-400">MediConnect Healthcare Platform</div>
                </div>
            </div>
            <div class="fixed inset-0 pointer-events-none opacity-[0.015] overflow-hidden">
                <div class="absolute top-20 left-16 w-6 h-6 border border-destructive/20 rounded-full"></div>
                <div class="absolute top-40 right-24 w-4 h-4 border border-destructive/20 rounded-full"></div>
                <div class="absolute bottom-32 left-24 w-8 h-8 border border-destructive/20 rounded-full"></div>
                <div class="absolute bottom-48 right-16 w-3 h-3 border border-destructive/20 rounded-full"></div>
                <div class="absolute top-1/3 left-8 w-10 h-0.5 bg-destructive/10 rounded-full"></div>
                <div class="absolute top-2/3 right-8 w-0.5 h-10 bg-destructive/10 rounded-full"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-0.5 bg-destructive/5">
                    <div class="w-full h-full bg-gradient-to-r from-transparent via-destructive/20 to-transparent animate-pulse"></div>
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
    <script type="module" src="./js/common/index.js"></script>

    <script>
        lucide.createIcons();
    </script>

    </body>

</html>