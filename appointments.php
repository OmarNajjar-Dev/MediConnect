<?php

require_once './backend/auth.php'; // handles autologin via cookie

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="css/ring.css" />
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
            <a href="/" class="flex items-center">
                <span class="text-medical-700 text-2xl font-semibold">
                    Medi<span class="text-medical-500">Connect</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-4 lg:gap-8">
                <a href="/" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
                <a href="/doctors.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="/hospitals.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="/appointments.html"
                    class="text-medical-700 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
                <a href="/dashboard.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
            </nav>

            <!-- Header Right Section -->
            <div class="flex items-center gap-4">
                <!-- Sign In / Sign Up buttons (hidden by default) -->
                <a href="/login.html"
                    class="hidden items-center justify-center bg-input text-heading border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    In</a>
                <a href="/signup.html"
                    class="hidden items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
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
                    <a href="/"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="/doctors.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="/hospitals.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="/appointments.html"
                        class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="/dashboard.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

                    <!-- Sign In / Sign Up buttons (Mobile view) -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="/login.html"
                            class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
                            In</a>
                        <a href="/signup.html"
                            class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
                            Up</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->

    <main id="appointment" class="min-h-screen bg-gray-50 pt-20 pb-16">
        <div class="container mx-auto px-4 relative">
            <div class="py-8">
                <h1 class="text-3xl font-bold mb-2">Schedule an Appointment</h1>
                <p class="text-gray-600 mb-8">
                    Book an appointment with one of our healthcare professionals
                </p>

                <div class="glass-card bg-card rounded-xl p-6 max-w-xl mx-auto">
                    <form onsubmit="return validateForm()" class="flex flex-col gap-6">
                        <!-- Specialty -->
                        <div class="flex flex-col gap-3">
                            <label class="text-sm font-medium leading-none">Specialty</label>
                            <button id="speciality-button" type="button" role="combobox" aria-controls="subject-options"
                                aria-expanded="false"
                                class="bg-white flex items-center justify-between pointer h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                <span id="selected-speciality" class="selected-value">Select a speciality</span>
                                <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                            </button>
                            <ul
                                class="hidden p-1.5 mt-7.5 bg-background border border-solid border-input shadow-xl rounded-md">
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Cardiology</span>
                                        <i data-lucide="check" class="w-4 h-4 text-medical-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dermatology</span>
                                        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Neurology</span>
                                        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Orthopedics</span>
                                        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Pediatrics</span>
                                        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>General
                                            Medicine</span> <i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                            </ul>

                            <p id="error-speciality" class="text-sm font-medium text-danger hidden">Please select a
                                speciality</p>

                        </div>

                        <!-- Doctor -->
                        <div class="flex flex-col gap-3">
                            <label class="text-sm font-medium leading-none">Doctor</label>
                            <button type="button" role="combobox"
                                class="bg-white flex items-center justify-between h-10 pointer w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                                <span class="selected-value">Select a doctor</span>
                                <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                            </button>
                            <ul
                                class="hidden p-1.5 mt-7.5 bg-background border border-solid border-input rounded-md shadow-xl">
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dr.
                                            Sarah Johnson - Cardiology</span><i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dr.
                                            Michael Chen - Dermatology</span><i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dr.
                                            Emily Patel - Neurology</span><i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dr.
                                            Robert Miller - Orthopedics</span><i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md"><span>Dr.
                                            Jessica Williams - Pediatrics</span><i data-lucide="check"
                                            class="w-4 h-4 text-gray-700 hidden"></i></button>
                                </li>
                            </ul>

                            <p id="error-doctor" class="text-sm font-medium text-danger hidden">Please select a doctor
                            </p>
                        </div>

                        <!-- Appointment Date -->
                        <div class="relative flex flex-col gap-3">
                            <label for="appointment-date" class="text-sm font-medium leading-none">Appointment
                                Date</label>
                            <button id="appointment-date" type="button" role="combobox"
                                class="inline-flex items-center text-gray-500 pointer justify-center gap-2 whitespace-nowrap rounded-md text-sm transition-colors border border-solid border-input bg-background h-10 px-4 py-2 w-full pl-3 text-left font-normal hover:bg-medical-50 hover:text-medical-500">
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
                                        <!-- Previous Month Days (disabled) -->
                                        <button class="w-9 h-9 text-gray-400 not-allowed" disabled>27</button>
                                        <button class="w-9 h-9 text-gray-400 not-allowed" disabled>28</button>
                                        <button class="w-9 h-9 text-gray-400 not-allowed" disabled>29</button>
                                        <button class="w-9 h-9 text-gray-400 not-allowed" disabled>30</button>

                                        <!-- Current Month Days -->
                                        <button class="w-9 h-9 hover:bg-gray-100 rounded">1</button>
                                        <button class="w-9 h-9 hover:bg-gray-100 rounded">2</button>
                                        <button class="w-9 h-9 hover:bg-gray-100 rounded">3</button>

                                        <!-- مثال لليوم الحالي -->
                                        <button
                                            class="w-9 h-9 bg-cyan-100 text-black font-semibold rounded-full">28</button>

                                        <!-- أيام لاحقة -->
                                        <button class="w-9 h-9 hover:bg-gray-100 rounded">29</button>
                                        <button class="w-9 h-9 hover:bg-gray-100 rounded">30</button>
                                    </div>
                                </div>
                            </div>

                            <p id="error-date" class="text-sm font-medium text-danger hidden">Please select a date
                            </p>
                        </div>
                        <!-- Time Slot -->
                        <div class="flex flex-col gap-3  relative" id="timeSlotContainer">
                            <label class="text-sm font-medium leading-none">Time Slot</label>
                            <button type="button" role="combobox" id="timeSlotButton"
                                class="dropdown-trigger bg-white flex items-center justify-between pointer h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"">
                                <span class=" selected-value">Select a time</span>
                                <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                            </button>
                            <ul id="timeSlotDropdown"
                                class="hidden p-1.5 mt-7.5 bg-background border border-solid border-input rounded-md shadow-xl">
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">9:00
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">9:30
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">10:00
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">10:30
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">11:00
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">11:30
                                        AM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">1:00
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">1:30
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">2:00
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">2:30
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">3:00
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">3:30
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">4:00
                                        PM</button>
                                </li>
                                <li>
                                    <button type="button"
                                        class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 pointer rounded-md">4:30
                                        PM</button>
                                </li>
                            </ul>


                            <p id="error-timeSlot" class="text-sm font-medium text-danger hidden">Please select a
                                time
                                slot
                            </p>

                        </div>

                        <!-- Reason for Visit -->
                        <div class="flex flex-col gap-3">
                            <label for="reason" class="text-sm font-medium leading-none">Reason for Visit</label>
                            <textarea id="reason" name="reason"
                                placeholder="Please briefly describe the reason for your visit"
                                class="min-h-[80px] w-full resize-none rounded-md border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none bg-background px-3 py-2 text-sm"
                                rows="3"></textarea>
                            <p id="error-required" class="text-sm font-medium text-danger hidden">required</p>
                        </div>

                        <!-- Additional Notes -->
                        <div class="flex flex-col gap-3">
                            <label for="notes" class="text-sm font-medium leading-none">Additional Notes</label>
                            <textarea id="notes" name="notes"
                                placeholder="Any additional information you want to share (optional)"
                                class="min-h-[80px] w-full resize-none rounded-md border border-solid border-input focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white outline-none bg-background px-3 py-2 text-sm"
                                rows="3"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="h-10 w-full px-4 py-2 border-none pointer text-sm font-medium text-white bg-medical-500 hover:bg-medical-600 rounded-md transition-colors outline-none">
                            Schedule Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="/" class="inline-block mb-4">
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
                            <a href="/appointments.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="/doctors.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="/hospitals.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Hospital Information
                            </a>
                        </li>
                        <li>
                            <a href="/emergency.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Emergency Services
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
                            <a href="/about.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="/privacy.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="/terms.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="/faq.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                FAQs
                            </a>
                        </li>
                        <li>
                            <a href="/contact.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
    <script type="module" src="./js/appointments/index.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>