<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/backend/config/path.php";

// 2. Load database connection
require_once __DIR__ . "/backend/config/db.php";

// 3. Start session and auto-login logic
require_once __DIR__ . "/backend/auth/auth.php";

// 4. Redirect if already logged in
require_once __DIR__ . "/backend/middleware/redirect-if-logged-in.php";

// 5. Load helper functions (utilities, formatting, reusable logic)
require_once __DIR__ . "/backend/auth/helpers.php";

// Show all errors during development (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get POST data
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $firstName = $_POST["first_name"] ?? '';
    $lastName = $_POST["last_name"] ?? '';
    $city = $_POST["city"] ?? '';
    $address = $_POST["address"] ?? '';
    $slugRole = $_POST["role"] ?? '';
    $roleName = slugToTitle($slugRole);  // Converts "super-admin" → "Super Admin"

    // Step 0-A: Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=invalid_email");
        exit();
    }

    // Step 0-B: Check if email already exists
    $check_stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        header("Location: register.php?error=email_exists");
        exit();
    }
    $check_stmt->close();

    // Step 1: Get role_id
    $role_stmt = $conn->prepare("SELECT role_id FROM roles WHERE role_name = ?");
    $role_stmt->bind_param("s", $roleName);
    $role_stmt->execute();
    $role_result = $role_stmt->get_result();

    if ($role_result->num_rows === 1) {
        $role_row = $role_result->fetch_assoc();
        $role_id = $role_row["role_id"];
        $role_stmt->close();

        // Step 2: Insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user_stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, city, address_line) VALUES (?, ?, ?, ?, ?, ?)");
        $user_stmt->bind_param("ssssss", $email, $hashedPassword, $firstName, $lastName, $city, $address);

        if ($user_stmt->execute()) {
            $user_id = $user_stmt->insert_id;
            $user_stmt->close();

            // Step 3: Link user to role
            $link_stmt = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
            $link_stmt->bind_param("ii", $user_id, $role_id);
            if ($link_stmt->execute()) {
                $link_stmt->close();

                $_SESSION["user_id"] = $user_id;
                // Store the role in the session
                storeUserRoleInSession($roleName);

                $slug = strtolower(str_replace(' ', '_', $roleName));
               
                $rolePath = $paths['dashboard'][$slug] ?? $paths['errors']['unauthorized'];
                header("Location: $rolePath");
                exit();
            } else {
                $link_stmt->close();
                header("Location: register.php?error=link_failed");
                exit();
            }
        } else {
            $user_stmt->close();
            header("Location: register.php?error=insert_failed");
            exit();
        }
    } else {
        $role_stmt->close();
        header("Location: register.php?error=invalid_role");
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
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/colors.css" />
    <link rel="stylesheet" href="css/typography.css" />
    <link rel="stylesheet" href="css/spacing.min.css" />
    <link rel="stylesheet" href="css/sizing.min.css" />
    <link rel="stylesheet" href="css/borders.css" />
    <link rel="stylesheet" href="css/ring.css" />
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />

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

            <!-- Right section: Auth / Dropdown / Emergency / Menu -->
            <div class="flex items-center gap-4">

                <!-- Sign In / Sign Up (visible) -->
                <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                    Sign In
                </a>

                <a href="<?= $paths['auth']['register'] ?>" class="hidden md:flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all mr-4">
                    Sign Up
                </a>

                <!-- Emergency button (always visible) -->
                <a href="./emergency.php" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 lg:ml-2 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
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
            <div class="w-full max-w-md flex flex-col gap-8">

                <!-- Logo and Heading -->
                <div class="text-center">
                    <a href="<?= $paths['home'] ?>" class="flex items-center justify-center">
                        <span class="text-3xl font-semibold text-medical-700">
                            Medi<span class="text-medical-500">Connect</span>
                        </span>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">
                        Create your account
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Join our healthcare platform to access better medical care
                    </p>
                </div>

                <!-- Register Form Card -->
                <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                    <form id="register-form" method="POST" class="flex flex-col gap-6">

                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="first-name" name="first_name" autocomplete="given-name" required
                                    class="mt-1 block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                            </div>

                            <div>
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="last-name" name="last_name" autocomplete="family-name" required
                                    class="mt-1 block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" autocomplete="email" required placeholder="you@example.com"
                                class="mt-1 block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>

                        <!-- Role Selection -->
                        <div class="flex flex-col gap-2">
                            <label for="role-input" class="block text-sm font-medium text-gray-700">Choose Your Role</label>
                            <div class="relative">
                                <button id="role-trigger" type="button"
                                    class="pointer flex h-10 w-full items-center justify-between rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                    <span id="selected-role" class="text-gray-700">Select your role</span>
                                    <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                                </button>
                                <input type="hidden" id="role-input" name="role" value="">

                                <ul id="role-options"
                                    class="absolute z-50 mt-1.5 hidden w-full rounded-md border border-solid border-input bg-white p-1 shadow-xl">
                                    <li><button type="button" data-value="super-admin" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Super Admin</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                    <li><button type="button" data-value="hospital-admin" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Hospital Admin</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                    <li><button type="button" data-value="doctor" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Doctor</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                    <li><button type="button" data-value="patient" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Patient</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                    <li><button type="button" data-value="ambulance-team" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Ambulance Team</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                    <li><button type="button" data-value="staff" class="pointer option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-100 border-none"><span>Staff</span><i data-lucide="check" class="h-4 w-4 text-gray-700 hidden"></i></button></li>
                                </ul>
                            </div>
                            <p class="text-xs text-gray-500">Select the role that best describes your position in the healthcare system.</p>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative mt-1">
                                <input type="password" name="password" autocomplete="current-password" required placeholder="*******"
                                    class="password block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 pr-10 text-base md:text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                <button type="button" id="toggle-password" class="pointer absolute inset-y-0 right-0 z-10 flex items-center border-none bg-transparent pr-3" aria-label="Toggle password visibility">
                                    <i data-lucide="eye" class="h-5 w-5 text-gray-400"></i>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long with at least one number and one special character.</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password" autocomplete="new-password" required placeholder="********"
                                class="mt-1 block h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                            <input type="text" name="city" id="city" class="hidden">
                            <input type="text" name="address" id="address" class="hidden">
                        </div>

                        <!-- Terms and Agreement -->
                        <div class="flex items-center">
                            <input type="checkbox" id="agree-checkbox" class="custom-checkbox">
                            <label for="agree-checkbox" class="ml-2 block text-sm text-gray-900">
                                I agree to the
                                <a href="./terms.php" class="text-medical-500 hover:text-medical-700">Terms of Service</a>
                                and
                                <a href="./privacy.php" class="text-medical-500 hover:text-medical-700">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="not-allowed">
                            <button id="signup-btn" type="submit"
                                class="pointer-events-none transition-colors flex h-10 w-full items-center justify-center gap-2 rounded-sm border border-solid border-transparent bg-medical-200 px-4 py-2 text-sm font-medium text-white">
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
                            <button type="button" class="pointer inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"></path>
                                </svg>
                            </button>

                            <button type="button" class="pointer inline-flex w-full justify-center rounded-md border border-solid border-input bg-white px-4 py-2 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                                </svg>
                            </button>
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

        <!-- Error Toasts -->
        <div id="password-error-toast" class="hidden fixed max-w-xs rounded-md bg-danger p-5 text-white">
            <p class="font-semibold">Passwords do not match.</p>
            <p class="text-sm">Please make sure your passwords match.</p>
        </div>

        <div id="role-error-toast" class="hidden fixed max-w-xs rounded-md bg-danger p-5 text-white">
            <p class="font-semibold">Please select your role.</p>
            <p class="text-sm">You must choose your position in the healthcare system.</p>
        </div>

        <div id="email-error-toast" class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md bg-danger p-5 text-white shadow-lg">
            <p class="font-semibold">Email already exists.</p>
            <p class="text-sm">Please use another email or login instead.</p>
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
    <script type="module" src="./js/auth/register/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>