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

// Show all errors during development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get data from POST request
    $email      = $_POST["email"] ?? '';
    $password   = $_POST["password"] ?? '';
    $firstName  = $_POST["first_name"] ?? '';
    $lastName   = $_POST["last_name"] ?? '';
    $city       = $_POST["city"] ?? '';
    $address    = $_POST["address"] ?? '';
    $slugRole   = $_POST["role"] ?? '';

    // Convert slug (e.g. super-admin) to role title (e.g. Super Admin)
    $roleName = slugToTitle($slugRole);

    // Security Check: Whitelist validation - only allow specific roles
    $allowedRoles = ['Patient', 'Doctor', 'Ambulance Team', 'Staff'];
    if (!in_array($roleName, $allowedRoles)) {
        header("Location: register.php?error=invalid_role");
        exit();
    }

    // Step 0-A: Check if email format is valid
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

    // Step 1: Get role_id from roles table
    $role_stmt = $conn->prepare("SELECT role_id FROM roles WHERE role_name = ?");
    $role_stmt->bind_param("s", $roleName);
    $role_stmt->execute();
    $role_result = $role_stmt->get_result();

    if ($role_result->num_rows === 1) {
        $role_row = $role_result->fetch_assoc();
        $role_id = $role_row["role_id"];
        $role_stmt->close();

        // Step 2: Insert user into users table
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user_stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, city, address_line) VALUES (?, ?, ?, ?, ?, ?)");
        $user_stmt->bind_param("ssssss", $email, $hashedPassword, $firstName, $lastName, $city, $address);

        if ($user_stmt->execute()) {
            $user_id = $user_stmt->insert_id;
            $user_stmt->close();

            // Step 3: Link user to role in user_roles
            $link_stmt = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
            $link_stmt->bind_param("ii", $user_id, $role_id);
            if ($link_stmt->execute()) {
                $link_stmt->close();

                // Step 3-B: Insert into role-specific table if needed
                if ($roleName === "Patient") {
                    $patient_stmt = $conn->prepare("INSERT INTO patients (user_id) VALUES (?)");
                    $patient_stmt->bind_param("i", $user_id);
                    $patient_stmt->execute();
                    $patient_stmt->close();
                } elseif ($roleName === "Doctor") {
                    $hospitalId = $_POST["hospital_id"] ?? null;
                    $specialtyId = $_POST["specialty_id"] ?? null;

                    if ($hospitalId && $specialtyId) {
                        $doctor_stmt = $conn->prepare("INSERT INTO doctors (user_id, hospital_id, specialty_id, is_verified) VALUES (?, ?, ?, 0)");
                        $doctor_stmt->bind_param("iii", $user_id, $hospitalId, $specialtyId);
                        $doctor_stmt->execute();
                        $doctor_stmt->close();
                    }
                } elseif ($roleName === "Ambulance Team") {
                    $teamName = $_POST["team_name"] ?? ($firstName . "'s Team");

                    // Insert into ambulance_teams
                    $team_stmt = $conn->prepare("INSERT INTO ambulance_teams (user_id, team_name) VALUES (?, ?)");
                    $team_stmt->bind_param("is", $user_id, $teamName);

                    if ($team_stmt->execute()) {
                        $team_id = $conn->insert_id; // Get the ID of the inserted ambulance team

                        // Convert address to lat/lng using OpenCage API
                        function getCoordinatesFromOpenCage($address)
                        {
                            $apiKey = "f7257b4524a9479eacc86758ec47dc69"; // Your OpenCage API Key
                            $url = "https://api.opencagedata.com/geocode/v1/json?" . http_build_query([
                                'q' => $address,
                                'key' => $apiKey,
                                'language' => 'en',
                                'limit' => 1,
                                'no_annotations' => 1
                            ]);

                            $response = file_get_contents($url);
                            $data = json_decode($response, true);

                            if ($data && isset($data['results'][0]['geometry'])) {
                                $location = $data['results'][0]['geometry'];
                                return [$location['lat'], $location['lng']];
                            }

                            return [null, null];
                        }

                        // Get user address (from signup form)
                        $address = $_POST["address"] ?? null;

                        if ($address) {
                            list($lat, $lng) = getCoordinatesFromOpenCage($address);

                            if ($lat && $lng) {
                                $updated_at = date("Y-m-d H:i:s");

                                // Insert into ambulance_locations
                                $location_stmt = $conn->prepare("INSERT INTO ambulance_locations (team_id, latitude, longitude, updated_at) VALUES (?, ?, ?, ?)");
                                $location_stmt->bind_param("idds", $team_id, $lat, $lng, $updated_at);
                                $location_stmt->execute();
                                $location_stmt->close();
                            }
                        }
                    }

                    $team_stmt->close();
                }

                // Step 4: Store user session and redirect to dashboard
                $_SESSION["user_id"] = $user_id;
                storeUserRoleInSession($roleName);

                // Redirect to main dashboard index
                header("Location: " . $paths['dashboard']['index']);
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
    <link rel="stylesheet" href="/mediconnect/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/css/ring.css" />
    <link rel="stylesheet" href="/mediconnect/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/css/components.css" />
    <link rel="stylesheet" href="/mediconnect/css/geolocation.css" />
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
            <a href="<?= $paths['home']['index'] ?>" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation (hidden on mobile) -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
                <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Home</a>
                <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Doctors</a>
                <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Hospitals</a>
                <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-primary transition-colors">Appointments</a>
            </nav>

            <!-- Right section: Emergency / Auth / Menu -->
            <div class="flex items-center gap-4">

                <!-- Emergency button (always visible) -->
                <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
                    <i data-lucide="ambulance" class="w-4 h-4"></i>
                    Emergency
                </a>

                <!-- Sign In / Sign Up (visible on desktop) -->
                <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all md:ml-4">
                    Sign In
                </a>

                <a href="<?= $paths['auth']['register'] ?>" class="hidden md:flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                    Sign Up
                </a>

                <!-- Mobile menu toggle button -->
                <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none cursor-pointer">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation Panel (visible only on mobile) -->
            <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

                    <!-- Mobile: Sign In / Sign Out -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                        <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
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
                    <a href="<?= $paths['home']['index'] ?>" class="flex items-center justify-center">
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
                    <form id="register-form" method="POST" class="flex flex-col gap-4">

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

                        <!-- Role Selection -->
                        <div>
                            <label for="role" class="text-sm font-medium leading-none mb-2 block">Role</label>
                            <select id="role" name="role" required
                                class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white md:text-sm">
                                <option value="">Select a role</option>
                                <option value="patient">Patient</option>
                                <option value="doctor">Doctor</option>
                                <option value="ambulance-team">Ambulance Team</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <!-- Dynamic Role-Specific Fields -->
                        <div id="role-specific-fields" class="hidden">
                            <!-- Hospital Selection (for Doctor and Ambulance Team) -->
                            <div id="hospital-selection" class="hidden">
                                <label for="hospital_id" class="text-sm font-medium leading-none mb-2 block">Hospital</label>
                                <select id="hospital_id" name="hospital_id"
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white md:text-sm">
                                    <option value="">Select a hospital</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>

                            <!-- Specialty Selection (for Doctor only) -->
                            <div id="specialty-selection" class="hidden">
                                <label for="specialty_id" class="text-sm font-medium leading-none mb-2 block">Specialty</label>
                                <select id="specialty_id" name="specialty_id"
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white md:text-sm">
                                    <option value="">Select a specialty</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>

                            <!-- Team Name (for Ambulance Team) -->
                            <div id="team-name-field" class="hidden">
                                <label for="team_name" class="text-sm font-medium leading-none mb-2 block">Team Name</label>
                                <input type="text" id="team_name" name="team_name"
                                    class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
                                    placeholder="Enter team name (optional)">
                            </div>
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

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div id="password-strength" class="text-xs"></div>
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
                            <button type="button" id="detect-location" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-medical-600 bg-medical-50 border border-solid border-medical-200 rounded-md hover:bg-medical-100 transition-colors">
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
                        <div class="pt-4">
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
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="<?= $paths['home']['index'] ?>" class="inline-block mb-4">
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
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
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
                            <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-primary transition-colors">
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
                            <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-primary transition-colors">
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
    <script type="module" src="/mediconnect/js/auth/register/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>