<?php

$currentPage = "appointments";

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 3. Require user to be logged in
require_once __DIR__ . "/../../backend/middleware/require-user.php";

// 4. Include avatar helper
require_once __DIR__ . "/../../backend/helpers/avatar-helper.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags  -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/ring.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="min-h-screen pt-20 pb-16">

        <!-- Hero Section with gradient background -->
        <section class="bg-mediconnect-white py-16 text-center">
            <div class="container mx-auto px-4">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Schedule an Appointment</h2>
                <p class="mt-2 text-sm text-gray-600 max-w-md mx-auto">
                    Book an appointment with one of our healthcare professionals
                </p>
            </div>
        </section>

        <div class="bg-white border border-solid border-input rounded-xl p-6 max-w-xl mx-auto">
            <form id="appointment-form" class="flex flex-col gap-6">

                <!-- Specialty -->
                <div class="flex flex-col gap-3">
                    <label class="text-sm font-medium leading-none">Specialty</label>
                    <button id="speciality-button" type="button" role="combobox" aria-controls="specialty-options"
                        aria-expanded="false"
                        class="bg-white flex items-center justify-between cursor-pointer h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        <span id="selected-speciality" class="selected-value">Select a specialty</span>
                        <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                    </button>
                    <ul id="specialty-options"
                        class="hidden p-1.5 mt-7.5 bg-background border border-solid border-input shadow-xl rounded-md scrollbar-none">
                        <!-- Specialties will be loaded dynamically -->
                    </ul>
                    <p id="error-speciality" class="text-sm font-medium text-danger hidden">Please select a specialty</p>
                </div>

                <!-- Doctor -->
                <div class="flex flex-col gap-3">
                    <label class="text-sm font-medium leading-none">Doctor</label>
                    <button id="doctor-button" type="button" role="combobox" aria-controls="doctor-options"
                        aria-expanded="false"
                        class="bg-white flex items-center justify-between h-10 cursor-pointer w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        <span id="selected-doctor" class="selected-value">Select a doctor</span>
                        <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                    </button>
                    <ul id="doctor-options"
                        class="hidden p-1.5 mt-7.5 bg-background border border-solid border-input rounded-md shadow-xl scrollbar-none">
                        <!-- Doctors will be loaded dynamically -->
                    </ul>
                    <p id="error-doctor" class="text-sm font-medium text-danger hidden">Please select a doctor</p>
                </div>

                <!-- Appointment Date -->
                <div class="relative flex flex-col gap-3">
                    <label for="appointment-date" class="text-sm font-medium leading-none">Appointment Date</label>
                    <button id="appointment-date" type="button" role="combobox"
                        class="inline-flex items-center text-gray-500 cursor-pointer justify-center gap-2 whitespace-nowrap rounded-md text-sm transition-colors border border-solid border-input bg-background h-10 px-4 py-2 w-full pl-3 text-left font-normal hover:bg-medical-50 hover:text-medical-500">
                        <span id="selected-date" class="selected-value">Pick a date</span>
                        <i data-lucide="calendar" class="ml-auto w-4 opacity-50"></i>
                    </button>

                    <div class="rounded-md z-50 mt-7 hidden absolute border border-solid border-gray-200 bg-white text-gray-800 shadow-md w-auto p-4 max-w-70"
                        role="dialog" tabindex="-1">
                        <div class="flex flex-col gap-4">
                            <!-- Header: Month + Navigation -->
                            <div class="flex items-center justify-center pt-1">
                                <div class="flex items-center gap-1">
                                    <!-- Previous Button -->
                                    <button id="prev" type="button" aria-label="Go to previous month"
                                        class="h-7 w-7 mr-12 p-0 opacity-50 hover:opacity-100 rounded-md border border-solid border-input bg-transparent hover:bg-medical-50 hover:text-medical-700 flex items-center justify-center">
                                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                    </button>

                                    <!-- Month and Year -->
                                    <div id="month-year" class="text-sm font-semibold mx-1 whitespace-nowrap">
                                        June 2025
                                    </div>

                                    <!-- Next Button -->
                                    <button id="next" type="button" aria-label="Go to next month"
                                        class="h-7 w-7 ml-12 p-0 opacity-50 hover:opacity-100 rounded-md border border-solid border-input bg-transparent hover:bg-medical-50 hover:text-medical-700 flex items-center justify-center">
                                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Weekday Headers -->
                            <div class="grid grid-cols-7 text-center text-sm font-medium w-full">
                                <div class="w-9 text-gray-500 font-normal text-sm">Su</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">Mo</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">Tu</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">We</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">Th</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">Fr</div>
                                <div class="w-9 text-gray-500 font-normal text-sm">Sa</div>
                            </div>

                            <!-- Calendar Days -->
                            <div id="days" class="grid grid-cols-7 gap-1 text-sm">
                                <!-- Days will be generated dynamically -->
                            </div>
                        </div>
                    </div>

                    <p id="error-date" class="text-sm font-medium text-danger hidden">Please select a date</p>
                </div>

                <!-- Time Slot -->
                <div class="flex flex-col gap-3 relative" id="time-slot-container">
                    <label class="text-sm font-medium leading-none">Time Slot</label>
                    <button type="button" role="combobox" id="time-slot-button"
                        class="dropdown-trigger bg-white flex items-center justify-between cursor-pointer h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        <span id="selected-time" class="selected-value">Select a time</span>
                        <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                    </button>
                    <ul id="time-options"
                        class="hidden p-1.5 mt-7.5 mb-1 bg-background scrollbar-none border border-solid max-h-72 border-input rounded-md shadow-xl">
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">9:00 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">9:30 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">10:00 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">10:30 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">11:00 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">11:30 AM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">1:00 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">1:30 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">2:00 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">2:30 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">3:00 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">3:30 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">4:00 PM</button>
                        </li>
                        <li>
                            <button type="button"
                                class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md">4:30 PM</button>
                        </li>
                    </ul>

                    <p id="error-timeSlot" class="text-sm font-medium text-danger hidden">Please select a time slot</p>
                </div>

                <!-- Reason for Visit -->
                <div class="flex flex-col gap-3">
                    <label for="reason" class="text-sm font-medium leading-none">Reason for Visit</label>
                    <textarea id="reason" name="reason"
                        placeholder="Please briefly describe the reason for your visit"
                        class="min-h-20 w-full resize-none scrollbar-none rounded-md border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none bg-background px-3 py-2 text-sm"
                        rows="3"></textarea>
                    <p id="error-reason" class="text-sm font-medium text-danger hidden">Please provide a reason for your visit</p>
                </div>

                <!-- Additional Notes -->
                <div class="flex flex-col gap-3">
                    <label for="notes" class="text-sm font-medium leading-none">Additional Notes</label>
                    <textarea id="notes" name="notes"
                        placeholder="Any additional information you want to share (optional)"
                        class="min-h-20 w-full resize-none scrollbar-none rounded-md border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none bg-background px-3 py-2 text-sm"
                        rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="h-10 w-full px-4 py-2 border-none cursor-pointer text-sm font-medium text-white bg-primary hover:bg-medical-600 rounded-md transition-colors outline-none">
                    Schedule Appointment
                </button>
            </form>
        </div>
    </main>

    <!-- Universal Toast Container -->
    <div
        id="toast"
        class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg">
        <p id="toast-title" class="font-semibold"></p>
        <p id="toast-message" class="text-sm"></p>
    </div>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
    <script type="module" src="/mediconnect/assets/js/appointments/index.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>