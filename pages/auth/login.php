<?php

$currentPage = "login";

// 1. Load system configuration
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 3. Redirect if already logged in
require_once __DIR__ . "/../../backend/middleware/redirect-if-logged-in.php";

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
    <link rel="stylesheet" href="/mediconnect/assets/css/components/components.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/animations.css" />

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
    <main class="min-h-screen overflow-hidden flex-grow bg-gray-50 pt-20 pb-16">

        <!-- Hero Section with gradient background -->
        <section class="bg-mediconnect-gray py-12 text-center">
            <div class="container mx-auto px-4">
                <a href="<?= $paths['home']['index'] ?>" class="flex items-center justify-center">
                    <span class="text-3xl font-semibold text-medical-700">
                        Medi<span class="text-medical-500">Connect</span>
                    </span>
                </a>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-sm text-gray-600 max-w-md mx-auto">
                    Access your healthcare platform to manage appointments and more
                </p>
            </div>
        </section>

        <!-- Login Form Section (white background) -->
        <section class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-md flex flex-col gap-6">

                <!-- Login form card -->
                <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                    <form id="login-form" method="POST" class="flex flex-col gap-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com" required
                                class="mt-1 block h-10 w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative mt-1">
                                <input type="password" id="password" name="password" autocomplete="current-password" placeholder="*******" required
                                    class="block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 pr-10 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                <button type="button" id="toggle-password" aria-label="Toggle password visibility"
                                    class="eye-toggle-button absolute inset-y-0 right-0 z-10 flex items-center border-none bg-transparent pr-3 cursor-pointer">
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

                        <!-- Submit Button -->
                        <div>
                            <button id="login-btn" type="submit"
                                class="flex h-10 w-full items-center justify-center gap-2 rounded-sm border border-solid border-transparent bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-medical-700 cursor-pointer transition-colors">
                                <i data-lucide="log-in" class="h-4 w-4"></i>
                                Sign in
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
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
                        <div class="group relative cursor-not-allowed">
                            <button type="button"
                                class="inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm pointer-events-none"
                                disabled>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z" />
                                </svg>
                            </button>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                Coming Soon!
                            </div>
                        </div>

                        <div class="group relative cursor-not-allowed">
                            <button type="button"
                                class="inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm pointer-events-none"
                                disabled>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </button>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                                Coming Soon!
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
        </section>

        <!-- Dynamic Error Toast -->
        <div id="toast" class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md bg-danger p-5 text-white shadow-lg">
            <p id="toast-title" class="font-semibold"></p>
            <p id="toast-message" class="text-sm"></p>
        </div>

    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
    <script type="module" src="/mediconnect/assets/js/auth/login/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>