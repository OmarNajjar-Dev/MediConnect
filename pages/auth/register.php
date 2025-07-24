<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . '/../../backend/middleware/session-context.php';

// 3. Redirect if already logged in
require_once __DIR__ . "/../../backend/middleware/redirect-if-logged-in.php";

// 4. Include avatar helper
require_once __DIR__ . "/../../backend/helpers/avatar-helper.php";

// 5. Load registration helper functions
require_once __DIR__ . "/../../backend/helpers/registration-helpers.php";

// Show all errors during development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get data from POST request
    $userData = [
        'email' => $_POST["email"] ?? '',
        'password' => $_POST["password"] ?? '',
        'first_name' => $_POST["first_name"] ?? '',
        'last_name' => $_POST["last_name"] ?? '',
        'city' => $_POST["city"] ?? '',
        'address' => $_POST["address"] ?? '',
        'hospital_id' => $_POST["hospital_id"] ?? null,
        'specialty_id' => $_POST["specialty_id"] ?? null,
        'team_name' => $_POST["team_name"] ?? null
    ];

    // Set role to Patient (hardcoded for public registration)
    $roleName = 'Patient';

    // Validate email format
    if (!validateEmail($userData['email'])) {
        header("Location: register.php?error=invalid_email");
        exit();
    }

    // Check if email already exists
    if (emailExists($conn, $userData['email'])) {
        header("Location: register.php?error=email_exists");
        exit();
    }

    // Create user account using helper function
    $result = createUserAccount($conn, $userData, $roleName);

    if ($result['success']) {
        // Initialize user session
        initializeUserSession($result['user_id'], $roleName);

        // Redirect to main dashboard index
        header("Location: " . $paths['dashboard']['index']);
        exit();
    } else {
        // Redirect with error
        header("Location: register.php?error=" . urlencode($result['error']));
        exit();
    }
}

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
    <link rel="stylesheet" href="/mediconnect/assets/css/components/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/components.css" />
    
    <!-- Page Specific Styles -->
    <link rel="stylesheet" href="/mediconnect/assets/css/pages/geolocation.css" />
    
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
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Create your account</h2>
                <p class="mt-2 text-sm text-gray-600 max-w-md mx-auto">
                    Join our healthcare platform to access better medical care
                </p>
            </div>
        </section>

        <div class="flex min-h-screen items-center justify-center bg-transparent px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-md flex flex-col gap-8">

                <!-- Register Form Card -->
                <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                    <form id="register-form" method="POST" action="register.php" class="flex flex-col gap-4">

                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first-name" class="text-sm font-medium leading-none mb-2 block">First Name</label>
                                <input type="text" id="first-name" name="first_name" autocomplete="given-name" required
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Enter first name">
                            </div>

                            <div>
                                <label for="last-name" class="text-sm font-medium leading-none mb-2 block">Last Name</label>
                                <input type="text" id="last-name" name="last_name" autocomplete="family-name" required
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Enter last name">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="text-sm font-medium leading-none mb-2 block">Email</label>
                            <input type="email" id="email" name="email" autocomplete="email" required
                                class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                placeholder="Enter email address">
                        </div>

                        <!-- Role Information (Patient Only) -->
                        <div class="bg-medical-50 border border-medical-200 rounded-md p-3">
                            <div class="flex items-center gap-2">
                                <i data-lucide="user" class="h-4 w-4 text-medical-600"></i>
                                <span class="text-sm font-medium text-medical-800">Patient Registration</span>
                            </div>
                            <p class="text-xs text-medical-600 mt-1">You are registering as a patient. Other roles are available through admin invitation only.</p>
                        </div>



                        <!-- Password Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="text-sm font-medium leading-none mb-2 block">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" autocomplete="new-password" required
                                        class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 pr-10 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                        placeholder="Enter password">
                                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 border-none bg-transparent cursor-pointer" aria-label="Toggle password visibility">
                                        <i data-lucide="eye" class="h-4 w-4 text-gray-400"></i>
                                    </button>
                                </div>
                                <div id="password-strength" class="mt-1 text-xs"></div>
                            </div>

                            <div>
                                <label for="confirm-password" class="text-sm font-medium leading-none mb-2 block">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password" autocomplete="new-password" required
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Confirm password">
                                <div id="password-match-indicator" class="mt-1 text-xs"></div>
                            </div>
                        </div>



                        <!-- Location Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="text-sm font-medium leading-none mb-2 block">City</label>
                                <input type="text" id="city" name="city" required
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Enter city">
                            </div>
                            <div>
                                <label for="address" class="text-sm font-medium leading-none mb-2 block">Address</label>
                                <input type="text" id="address" name="address" required
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Enter address">
                            </div>
                        </div>

                        <!-- Geolocation Button -->
                        <div class="flex justify-center">
                            <button type="button" id="detect-location" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-medical-600 bg-medical-50 border border-solid border-medical-200 rounded-md hover:bg-medical-100 transition-colors cursor-pointer">
                                <i data-lucide="map-pin" class="h-4 w-4"></i>
                                <span id="location-button-text">Detect My Location</span>
                                <div id="location-loading" class="hidden animate-spin h-4 w-4 border-2 border-medical-600 border-t-transparent rounded-full"></div>
                            </button>
                        </div>

                        <!-- Location Status Message -->
                        <div id="location-status" class="hidden w-full p-3 rounded-md text-sm text-center font-medium">
                            <span id="location-status-text"></span>
                        </div>

                        <!-- Terms and Agreement -->
                        <div class="flex items-center">
                            <input type="checkbox" id="agree-checkbox" class="custom-checkbox">
                            <label for="agree-checkbox" class="ml-2 block text-sm text-gray-900">
                                I agree to the
                                <a href="<?= $paths['static']['terms'] ?>" class="text-medical-500 hover:text-medical-700">Terms of Service</a>
                                and
                                <a href="<?= $paths['static']['privacy'] ?>" class="text-medical-500 hover:text-medical-700">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 cursor-not-allowed">
                            <button id="signup-btn" type="submit"
                                class="flex h-10 w-full items-center justify-center gap-2 rounded-md text-sm font-medium transition-colors text-white bg-primary hover:bg-medical-600 border-none cursor-pointer pointer-events-none bg-medical-200">
                                <i data-lucide="user-plus" class="h-4 w-4"></i>
                                Sign up
                            </button>
                        </div>

                    </form>

                    <!-- Divider -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex items-center text-sm">
                                <hr class="flex-grow border-t border-gray-500">
                                <span class="bg-white px-2 text-gray-500">Or sign up with</span>
                                <hr class="flex-grow border-t border-gray-500">
                            </div>
                        </div>

                        <!-- Social Buttons -->
                        <div class="mt-6 grid grid-cols-2 gap-3">

                            <!-- Google Button Wrapper -->
                            <div class="group relative cursor-not-allowed">
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
                                    Coming Soon!
                                </div>
                            </div>

                            <!-- Facebook Button Wrapper -->
                            <div class="group relative cursor-not-allowed">
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
                                    Coming Soon!
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="<?= $paths['auth']['login'] ?>" class="font-medium text-medical-500 hover:text-medical-700">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
    <script type="module" src="/mediconnect/assets/js/auth/register/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>