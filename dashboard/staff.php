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
                <!-- === Staff Greeting & Panel Header === -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="mb-1 text-sm text-gray-600">
                            Logged in as: <span class="font-medium">STAFF</span>
                        </p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Mary Williams</h1>
                        <p class="mt-1 text-sm text-medical-600">Al Noor Medical Center</p>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="calendar" class="h-8 w-8 text-purple-600 calendar-icon"></i>
                        <div>
                            <h1 class="text-3xl font-bold">Staff Panel</h1>
                            <p class="text-gray-600">Appointment Management System</p>
                        </div>
                    </div>
                </div>


                <div>
                    <!-- Tab Navigation -->
                    <div
                        class="mb-2 grid h-10 w-full grid-cols-3 items-center justify-center rounded-md bg-gray-150 p-1 text-muted-foreground pointer">
                        <button
                            type="button"
                            data-target="Manage-Appointments"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-white px-3 py-1.5 text-sm font-medium pointer">
                            Manage Appointments
                        </button>

                        <button
                            type="button"
                            data-target="Available-Doctors"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Available Doctors
                        </button>

                        <button
                            type="button"
                            data-target="Daily-Schedule"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-gray-150 px-3 py-1.5 text-sm font-medium pointer">
                            Daily Schedule
                        </button>
                    </div>

                    <div class="mt-2 flex flex-col gap-6" style="animation-duration: 0s">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Today's Total</p>
                                        <p class="text-2xl font-bold">4</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-blue-600"></i>
                                </div>
                            </div>
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Pending </p>
                                        <p class="text-2xl font-bold">2 </p>
                                    </div>
                                    <i data-lucide="clock" class="h-8 w-8 text-orange-600"></i>
                                </div>
                            </div>
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Completed</p>
                                        <p class="text-2xl font-bold">0</p>
                                    </div>
                                    <i data-lucide="calendar" class="h-8 w-8 text-green-600"></i>
                                </div>
                            </div>
                            <div class="glass-card rounded-xl p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Available Doctors</p>
                                        <p class="text-2xl font-bold">3</p>
                                    </div>
                                    <i data-lucide="users" class="h-8 w-8 text-purple-600"></i>
                                </div>
                            </div>
                        </div>

                        <div data-section="Manage-Appointments" class="hidden glass-card rounded-xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold">Appointment Management</h3>
                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium  disabled:pointer-events-none disabled:opacity-50 border border-input border-solid bg-medical-500 text-white hover:bg-medical-400 h-10 px-4 py-2 pointer">
                                    <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                                    Create Appointment</button>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="w-3 h-3 rounded-full bg-green-600"></div>
                                        <div>
                                            <p class="font-medium">Ahmed Al-Rashid</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">Regular checkup - chest pain complaints</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 09:00</p>
                                        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent hover:bg-primary/80 bg-green-100 text-green-800">confirmed</div>
                                    </div>
                                    <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-600 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i>
                                        </button>
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent h-9 rounded-md px-3 text-red-600 hover:text-red-800 pointer">
                                            <i data-lucide="x" class="h-4 w-4"></i>
                                        </button></div>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="w-3 h-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Fatima Hassan</p>
                                            <p class="text-sm text-gray-600">follow-up • 45 min</p>
                                            <p class="text-sm text-gray-500">Follow-up on previous consultation</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-medium">Dr. Ahmed Hassan</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 10:30</p>
                                        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-orange-100 text-orange-800">pending</div>
                                    </div>
                                    <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-600 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i></button>
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent h-9 rounded-md px-3 text-red-600 hover:text-red-800 pointer">
                                            <i data-lucide="x" class="h-4 w-4"></i></button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="w-3 h-3 rounded-full bg-blue-600"></div>
                                        <div>
                                            <p class="font-medium">Mohammed Ali</p>
                                            <p class="text-sm text-gray-600">routine-checkup • 60 min</p>
                                            <p class="text-sm text-gray-500">Annual health screening</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-medium">Dr. Sarah Johnson</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 11:15</p>
                                        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-blue-100 text-blue-800">in progress</div>
                                    </div>
                                    <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-600 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i></button>
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent h-9 rounded-md px-3 text-red-600 hover:text-red-800 pointer">
                                            <i data-lucide="x" class="h-4 w-4"></i></button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <div class="w-3 h-3 rounded-full bg-orange-600"></div>
                                        <div>
                                            <p class="font-medium">Layla Ibrahim</p>
                                            <p class="text-sm text-gray-600">consultation • 30 min</p>
                                            <p class="text-sm text-gray-500">New patient - needs doctor assignment</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-medium">Unassigned</p>
                                        <p class="text-sm text-gray-600">2025-07-08 at 14:00</p>
                                        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors  border-transparent bg-orange-100 text-orange-800">pending</div>
                                    </div>
                                    <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-600 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="square-pen" class="h-4 w-4"></i></button>
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                            <i data-lucide="user" class="h-4 w-4 mr-1"></i>
                                            Assign</button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent h-9 rounded-md px-3 text-red-600 hover:text-red-800 pointer"><i data-lucide="x" class="h-4 w-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div data-section="Available-Doctors" class="hidden glass-card rounded-xl p-6">
                <h3 class="text-xl font-bold mb-4">Available Doctors</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Dr. Sarah Johnson</p>
                                <p class="text-sm text-gray-600">Cardiology</p>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-green-100 text-green-800">available</div>
                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium  disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 mt-2 pointer">View Schedule</button>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Dr. Ahmed Hassan</p>
                                <p class="text-sm text-gray-600">General Medicine</p>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-red-100 text-red-800">busy</div>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Dr. Fatima Al-Zahra</p>
                                <p class="text-sm text-gray-600">Dermatology</p>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-green-100 text-green-800">available</div>
                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium  disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 mt-2 pointer">View Schedule</button>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">Dr. Mohammed Ali</p>
                                <p class="text-sm text-gray-600">Orthopedics</p>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-green-100 text-green-800">available</div>
                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium  disabled:pointer-events-none disabled:opacity-50  border border-solid border-input bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 mt-2 pointer">View Schedule</button>
                    </div>
                </div>
            </div>




            <div data-section="Daily-Schedule" class="hidden glass-card rounded-xl p-6">
                <h3 class="text-xl font-bold mb-4">Daily Schedule Overview</h3>
                <div class="flex flex-col gap-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center justify-between p-3 border border-solid border-card-soft rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-medium w-16">09:00</div>
                                <div>
                                    <p class="font-medium">Ahmed Al-Rashid</p>
                                    <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                </div>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors  border-transparent bg-green-100 text-green-800">confirmed</div>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-solid border-card-soft rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-medium w-16">10:30</div>
                                <div>
                                    <p class="font-medium">Fatima Hassan</p>
                                    <p class="text-sm text-gray-600">Dr. Ahmed Hassan</p>
                                </div>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-orange-100 text-orange-800">pending</div>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-solid border-card-soft rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-medium w-16">11:15</div>
                                <div>
                                    <p class="font-medium">Mohammed Ali</p>
                                    <p class="text-sm text-gray-600">Dr. Sarah Johnson</p>
                                </div>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-blue-100 text-blue-800">in progress</div>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-solid border-card-soft rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-medium w-16">14:00</div>
                                <div>
                                    <p class="font-medium">Layla Ibrahim</p>
                                    <p class="text-sm text-gray-600">Unassigned</p>
                                </div>
                            </div>
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border-transparent bg-orange-100 text-orange-800">pending</div>
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
    <script type="module" src="../js/dashboard/staff/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>