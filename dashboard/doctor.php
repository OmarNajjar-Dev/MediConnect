<?php

// require_once '../backend/auth.php'; // handles autologin via cookie

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
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Logged in as: <span class="font-medium">DOCTOR</span></p>
                        <h1 class="text-2xl font-bold text-gray-900">Welcome back, Dr. Sarah Johnson</h1>
                        <p class="text-sm text-medical-600 mt-1">Al Noor Medical Center</p>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3"><i data-lucide="user" class="h-8 w-8 text-green-600"></i>

                        <div>
                            <h1 class="text-3xl font-bold">Doctor Panel</h1>
                            <p class="text-gray-600">Welcome, Dr. Sarah Johnson</p>
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

                        <div class="mt-2 flex flex-col gap-6">
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
                                            <p class="text-sm font-medium text-gray-600">Pending</p>
                                            <p class="text-2xl font-bold">2</p>
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
                                        <i data-lucide="file-text" class="h-8 w-8 text-green-600"></i>
                                    </div>
                                </div>
                                <div class="glass-card rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">In Progress</p>
                                            <p class="text-2xl font-bold">1</p>
                                        </div>
                                        <i data-lucide="user" class="h-8 w-8 text-purple-600"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="glass-card rounded-xl p-6">
                                <h3 class="text-xl font-bold mb-4">Today's Appointments</h3>
                                <div class="flex flex-col gap-3">

                                    <!-- Appointment 1 -->
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                            <div>
                                                <p class="font-medium">John Smith</p>
                                                <p class="text-sm text-gray-600">consultation • 30 min</p>
                                                <p class="text-sm text-gray-500">Regular checkup - chest pain complaints</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="text-right">
                                                <p class="font-medium">09:00</p>
                                                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">confirmed</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                                    <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                                    Update
                                                </button>
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                                    Complete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Appointment 2 -->
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                            <div>
                                                <p class="font-medium">Mary Johnson</p>
                                                <p class="text-sm text-gray-600">follow-up • 45 min</p>
                                                <p class="text-sm text-gray-500">Follow-up on ECG results</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="text-right">
                                                <p class="font-medium">10:30</p>
                                                <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800">in progress</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                                    <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                                    Update
                                                </button>
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                                    Complete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Appointment 3 -->
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                            <div>
                                                <p class="font-medium">Ahmed Al-Rashid</p>
                                                <p class="text-sm text-gray-600">consultation • 30 min</p>
                                                <p class="text-sm text-gray-500">New patient - hypertension concerns</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="text-right">
                                                <p class="font-medium">11:15</p>
                                                <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">scheduled</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                                    <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                                    Update
                                                </button>
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                                    Complete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Appointment 4 -->
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                            <div>
                                                <p class="font-medium">Fatima Hassan</p>
                                                <p class="text-sm text-gray-600">routine-checkup • 60 min</p>
                                                <p class="text-sm text-gray-500">Annual cardiac screening</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="text-right">
                                                <p class="font-medium">14:00</p>
                                                <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800">scheduled</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-input border-solid bg-background hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3 pointer">
                                                    <i data-lucide="square-pen" class="h-4 w-4 mr-1"></i>
                                                    Update
                                                </button>
                                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border border-transparent font-medium bg-medical-500 text-white hover:bg-medical-400 h-9 rounded-md px-3 pointer">
                                                    Complete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>







                        <div class="mt-4 sm:mt-6">
                            <div class="glass-card rounded-xl p-4 sm:p-6">
                                <h3 class="text-lg sm:text-xl font-bold mb-4">Weekly Schedule</h3>
                                <div class="flex flex-col gap-4">
                                    <div class="grid lg:grid-cols-7 gap-1 sm:gap-2 text-center text-xs sm:text-sm font-medium">
                                        <div class="truncate">Mon</div>
                                        <div class="truncate">Tue</div>
                                        <div class="truncate">Wed</div>
                                        <div class="truncate">Thu</div>
                                        <div class="truncate">Fri</div>
                                        <div class="truncate">Sat</div>
                                        <div class="truncate">Sun</div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <div class="grid lg:grid-cols-7 gap-1 sm:gap-2">
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">7</div>
                                                <div class="flex flex-col gap-1">
                                                    <div class="text-xs bg-blue-100 text-blue-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">9:00 - 12:00</span><span class="sm:hidden">9-12</span></div>
                                                    <div class="text-xs bg-green-100 text-green-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">14:00 - 17:00</span><span class="sm:hidden">2-5</span></div>
                                                </div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">8</div>
                                                <div class="flex flex-col gap-1">
                                                    <div class="text-xs bg-blue-100 text-blue-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">9:00 - 12:00</span><span class="sm:hidden">9-12</span></div>
                                                    <div class="text-xs bg-green-100 text-green-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">14:00 - 17:00</span><span class="sm:hidden">2-5</span></div>
                                                </div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">9</div>
                                                <div class="flex flex-col gap-1">
                                                    <div class="text-xs bg-blue-100 text-blue-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">9:00 - 12:00</span><span class="sm:hidden">9-12</span></div>
                                                    <div class="text-xs bg-green-100 text-green-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">14:00 - 17:00</span><span class="sm:hidden">2-5</span></div>
                                                </div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">10</div>
                                                <div class="flex flex-col gap-1">
                                                    <div class="text-xs bg-blue-100 text-blue-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">9:00 - 12:00</span><span class="sm:hidden">9-12</span></div>
                                                    <div class="text-xs bg-green-100 text-green-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">14:00 - 17:00</span><span class="sm:hidden">2-5</span></div>
                                                </div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">11</div>
                                                <div class="flex flex-col gap-1">
                                                    <div class="text-xs bg-blue-100 text-blue-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">9:00 - 12:00</span><span class="sm:hidden">9-12</span></div>
                                                    <div class="text-xs bg-green-100 text-green-800 px-1 sm:px-2 py-1 rounded-sm text-center"><span class="hidden sm:inline">14:00 - 17:00</span><span class="sm:hidden">2-5</span></div>
                                                </div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">12</div>
                                            </div>
                                            <div class="border border-solid border-card-soft rounded-lg p-2 sm:p-3 h-24 sm:h-32 bg-gray-50 min-w-0">
                                                <div class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">13</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div role="tabpanel" aria-labelledby="radix-:rs:-trigger-profile" id="radix-:rs:-content-profile" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 mt-4 sm:mt-6">
                            <div class="glass-card rounded-xl p-4 sm:p-6">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                                    <h3 class="text-lg sm:text-xl font-bold">Profile Management</h3><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full sm:w-auto"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen h-4 w-4 mr-2">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                        </svg>Edit Profile</button>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <div class="text-center lg:text-left">
                                        <div class="relative inline-block mb-4"><img src="/api/placeholder/150/150" alt="Profile" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover mx-auto lg:mx-0"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 absolute bottom-0 right-0 rounded-full p-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera h-3 w-3 sm:h-4 sm:w-4">
                                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                                                    <circle cx="12" cy="13" r="3"></circle>
                                                </svg></button></div>
                                        <h4 class="font-bold text-base sm:text-lg truncate">Dr. Sarah Johnson</h4>
                                        <p class="text-sm sm:text-base text-gray-600 truncate">Cardiology</p>
                                    </div>
                                    <div class="lg:col-span-2 flex flex-col gap-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Full Name</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">Dr. Sarah Johnson</p>
                                            </div>
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Email</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">sarah.johnson@alnoor.hospital</p>
                                            </div>
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Phone</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">+1-555-0101</p>
                                            </div>
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Hospital</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">Al Noor Medical Center</p>
                                            </div>
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">License Number</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">MD-12345</p>
                                            </div>
                                            <div class="min-w-0"><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Experience</label>
                                                <p class="text-gray-700 text-sm sm:text-base truncate">8 years</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-4">
                                            <div><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Education</label>
                                                <p class="text-gray-700 text-sm sm:text-base">MD from Johns Hopkins University</p>
                                            </div>
                                            <div><label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 font-medium text-sm">Bio</label>
                                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">Experienced cardiologist with over 8 years of practice. Specializing in interventional cardiology and heart disease prevention.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script type="module" src="../js/dashboard/doctors/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>