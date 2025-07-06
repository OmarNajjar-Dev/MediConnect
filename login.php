<?php

require_once './backend/auth.php'; // handles autologin via cookie

// Redirect logged-in users away from this page
if (isset($_SESSION["user_id"])) {
    header("Location: 404.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Settings -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

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
    <link rel="stylesheet" href="css/ring.css" />

</head>

<body class="bg-background text-foreground">
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
                <a href="./appointments.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
                <a href="./dashboard.php"
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
                    class="inline-flex items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-0 pointer md:hidden">
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
                    <a href="./appointments.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="./dashboard.php"
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

    <!-- ====================== Main Content ====================== -->
    <main class="overflow-hidden pt-20 flex-grow min-h-screen bg-gray-50 pb-16">
        <div class="min-h-screen flex items-center justify-center bg-transparent py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full flex flex-col gap-6">
                <div class="text-center">
                    <a href="./" class="flex justify-center items-center">
                        <span class="text-medical-700 text-3xl font-semibold">
                            Medi<span class="text-medical-500">Connect</span>
                        </span>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-heading text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600">Access your healthcare platform to manage appointments and
                        more</p>
                </div>

                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form id="login-form" class="flex flex-col gap-6" method="POST">
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" id="email" name="email" autocomplete="email" required
                                    placeholder="you@example.com"
                                    class="flex h-10 w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1 relative">
                                <input type="password" name="password" autocomplete="current-password" required
                                    placeholder="*******"
                                    class="password flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 pr-10 py-2 text-base focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm" />
                                <button type="button" id="toggle-password"
                                    class="eye-toggle-button absolute inset-y-0 right-0 flex items-center pr-3 z-10 pointer bg-transparent border-none"
                                    aria-label="Toggle password visibility">
                                    <i data-lucide="eye" class="eye-toggle-icon h-5 w-5 text-gray-400"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember-me" name="remember_me" class="custom-checkbox">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                            </div>
                            <div class="text-sm">
                                <a href="./forgot-password"
                                    class="font-medium text-medical-500 hover:text-medical-700">Forgot your
                                    password?</a>
                            </div>
                        </div>

                        <div>
                            <button id="login-btn" type="submit"
                                class="h-10 px-4 py-2 w-full border border-solid border-transparent pointer bg-medical-500 hover:bg-medical-700 text-white rounded-sm text-sm font-medium flex items-center justify-center gap-2">
                                <i data-lucide="log-in" class="h-4 w-4"></i>
                                Sign in
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex items-center text-sm">
                                <hr class="flex-grow border-t border-gray-500">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                                <hr class="flex-grow border-t border-gray-500">
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <!-- Google Button -->
                            <button type="button"
                                class="w-full inline-flex justify-center py-2 px-4 border border-solid border-input rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 pointer">
                                <svg data-lov-id="src/pages/SignIn.tsx:151:16" data-lov-name="svg"
                                    data-component-path="src/pages/SignIn.tsx" data-component-line="151"
                                    data-component-file="SignIn.tsx" data-component-name="svg"
                                    data-component-content="%7B%22className%22%3A%22w-5%20h-5%22%7D" class="w-5 h-5"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path data-lov-id="src/pages/SignIn.tsx:152:18" data-lov-name="path"
                                        data-component-path="src/pages/SignIn.tsx" data-component-line="152"
                                        data-component-file="SignIn.tsx" data-component-name="path"
                                        data-component-content="%7B%7D"
                                        d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z">
                                    </path>
                                </svg>
                            </button>

                            <!-- Facebook Button -->
                            <button type="button"
                                class="w-full inline-flex justify-center py-2 px-4 border border-solid border-input rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 pointer">
                                <svg data-lov-id="src/pages/SignIn.tsx:162:16" data-lov-name="svg"
                                    data-component-path="src/pages/SignIn.tsx" data-component-line="162"
                                    data-component-file="SignIn.tsx" data-component-name="svg"
                                    data-component-content="%7B%22className%22%3A%22w-5%20h-5%22%7D" class="w-5 h-5"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path data-lov-id="src/pages/SignIn.tsx:163:18" data-lov-name="path"
                                        data-component-path="src/pages/SignIn.tsx" data-component-line="163"
                                        data-component-file="SignIn.tsx" data-component-name="path"
                                        data-component-content="%7B%7D"
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="./register.php" class="font-medium text-medical-500 hover:text-medical-700">Sign
                                up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="login-error-toast" class="hidden fixed max-w-xs bg-danger text-white p-5 rounded-md" role="alert">
            <p class="font-semibold">Error: </p>
            <span class="text-md">Invalid email or password.</span>
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
                            <a href="./appointments.html"
                                class="text-gray-600 hover:text-medical-600 transition-colors">
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
                            <a href="./emergency.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Emergency Services
                            </a>
                        </li>
                        <li>
                            <a href="./pharmacy.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
    <script type="module" src="js/common/header.js"></script>
    <script type="module" src="js/common/mobile-nav.js"></script>

    <script type="module" src="./js/auth/login/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>