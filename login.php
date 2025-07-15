<?php

// 1. Load system configuration
require_once __DIR__ . "/backend/config/path.php";

// 2. Start session and auto-login logic
require_once __DIR__ . "/backend/auth/auth.php";

// 3. Redirect if already logged in
require_once __DIR__ . "/backend/middleware/redirect-if-logged-in.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/mediconnect/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/css/ring.css" />
    <link rel="stylesheet" href="/mediconnect/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <header class="fixed z-50 py-5 bg-transparent transition-all">
        <div class="container mx-auto flex items-center justify-between px-4">

            <!-- Logo -->
            <a href="<?= $paths['home'] ?>" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
                <a href="<?= $paths['home'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Appointments</a>
            </nav>

            <!-- Right section: Emergency / Auth / Menu -->
            <div class="flex items-center gap-4">

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200 order-1 md:order-none">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- Sign In / Sign Up (visible on desktop) -->
                <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                    Sign In
                </a>

                <a href="<?= $paths['auth']['register'] ?>" class="hidden md:flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all mr-4">
                    Sign Up
                </a>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <!-- Mobile: Sign In / Sign Out -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                        <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
                    </div>
                </nav>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen overflow-hidden flex-grow bg-gray-50 pt-20 pb-16">
        <div class="flex min-h-screen items-center justify-center bg-transparent px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-md flex flex-col gap-6">

                <!-- Logo and Heading -->
                <div class="text-center">
                    <a href="<?= $paths['home'] ?>" class="flex items-center justify-center">
                        <span class="text-3xl font-semibold text-medical-700">
                            Medi<span class="text-medical-500">Connect</span>
                        </span>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Access your healthcare platform to manage appointments and more
                    </p>
                </div>

                <!-- Login Form Card -->
                <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                    <form id="login-form" method="POST" class="flex flex-col gap-6">

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required autocomplete="email" placeholder="you@example.com"
                                class="mt-1 block h-10 w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative mt-1">
                                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="*******"
                                    class="block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 pr-10 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                <button type="button" id="toggle-password" aria-label="Toggle password visibility"
                                    class="eye-toggle-button absolute inset-y-0 right-0 z-10 flex items-center border-none bg-transparent pr-3 pointer">
                                    <i data-lucide="eye" class="eye-toggle-icon h-5 w-5 text-gray-400"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember-me" name="remember_me" class="custom-checkbox">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                            </div>
                            <a href="./forgot-password" class="text-sm font-medium text-medical-500 hover:text-medical-700">Forgot your password?</a>
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button id="login-btn" type="submit"
                                class="flex h-10 w-full items-center justify-center gap-2 rounded-sm border border-solid border-transparent bg-medical-500 px-4 py-2 text-sm font-medium text-white hover:bg-medical-700 pointer transition-colors">
                                <i data-lucide="log-in" class="h-4 w-4"></i>
                                Sign in
                            </button>
                        </div>

                    </form>

                    <!-- Divider with text -->
                    <div class="relative mt-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-solid border-gray-300"></div>
                        </div>
                        <div class="relative flex items-center text-sm">
                            <hr class="flex-grow border-t border-solid border-gray-500">
                            <span class="bg-white px-2 text-gray-500">Or continue with</span>
                            <hr class="flex-grow border-t border-solid border-gray-500">
                        </div>
                    </div>

                    <!-- Social Buttons -->
                    <div class="mt-6 grid grid-cols-2 gap-3">

                        <!-- Google Button Wrapper -->
                        <div class="group relative not-allowed">
                            <button type="button"
                                class="inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm pointer-events-none"
                                disabled>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z" />
                                </svg>
                            </button>
                            <div
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                Comming Soon!
                            </div>
                        </div>

                        <!-- Facebook Button Wrapper -->
                        <div class="group relative not-allowed">
                            <button type="button"
                                class="inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm pointer-events-none"
                                disabled>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </button>
                            <div
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                Comming Soon!
                            </div>
                        </div>

                    </div>

                    <!-- Sign Up Link -->
                    <p class="mt-6 text-center text-sm text-gray-600">
                        Don't have an account?
                        <a href="<?= $paths['auth']['register'] ?>" class="font-medium text-medical-500 hover:text-medical-700">Sign up</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Error Toast -->
        <div id="login-error-toast" class="fixed hidden max-w-xs rounded-md bg-danger p-5 text-white" role="alert">
            <p class="font-semibold">Error:</p>
            <span class="text-md">Invalid email or password.</span>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="<?= $paths['home'] ?>" class="inline-block mb-4">
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
                            <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
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
                            <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Blood Bank System
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
    <script type="module" src="/mediconnect/js/common/index.js"></script>
    <script type="module" src="/mediconnect/js/auth/login/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>