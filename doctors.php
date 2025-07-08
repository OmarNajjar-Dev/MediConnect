<?php

require_once './backend/auth.php'; // handles autologin via cookie

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
      <a href="./" class="flex items-center">
        <span class="text-medical-700 text-2xl font-semibold">
          Medi<span class="text-medical-500">Connect</span>
        </span>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center gap-4 lg:gap-8">
        <a href="./" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
        <a href="./doctors.php"
          class="text-medical-700 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
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
            class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
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
  <main class="overflow-hidden pt-20 pb-16 min-h-screen bg-gray-50 flex-grow">
    <div class="container mx-auto px-4">
      <!-- Page Title -->
      <div class="py-8">
        <h1 class="text-heading text-3xl font-bold mb-2 tracking-tight">
          Find Doctors
        </h1>
        <p class="text-gray-600">
          Connect with top specialists in various medical fields
        </p>
      </div>

      <!-- Search Section -->
      <div class="search-container flex gap-6 mb-8">
        <div class="search-input-container text-xl flex-grow">
          <div class="input-wrapper relative">
            <!-- Search Icon (Lucide) -->
            <i data-lucide="search" class="absolute text-gray-500"></i>
            <!-- Search Input Field -->
            <input type="text" placeholder="Search doctors by name, specialty, or hospital"
              class="search-input px-10 h-12 flex w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white" />
          </div>
        </div>
      </div>

      <!-- Specialties Section -->
      <div class="specialties-container mb-8 overflow-auto scrollbar-none">
        <div class="buttons-container inline-flex gap-2 pb-2 min-w-full">
          <!-- All Specialties Button -->
          <button id="all-specialties"
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            All Specialties
          </button>

          <!-- Cardiologist Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Cardiologist
          </button>

          <!-- Dermatologist Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Dermatologist
          </button>

          <!-- Neurology Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Neurologist
          </button>

          <!-- Orthopedics Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Orthopedist
          </button>

          <!-- Pediatrics Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Pediatrician
          </button>

          <!-- Psychiatry Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-medical-600 h-10 px-4 py-2">
            Psychiatrist
          </button>
        </div>
      </div>

      <!-- No Doctors Found Message -->
      <div class="no-results hidden glass-card rounded-xl p-6 py-16 text-center">
        <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
          <i data-lucide="triangle-alert" class="w-7 h-7 text-gray-400"></i>
        </div>
        <h2 class="text-xl font-medium mb-2 tracking-tight text-heading">No doctors found</h2>
        <p class="text-gray-600 mb-4">Try adjusting your search criteria</p>
        <button
          class="clear-filters inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md border border-solid border-input text-sm font-medium transition-colors bg-medical-500 text-white hover:bg-medical-400 h-10 px-4 py-2 pointer">
          Clear Filters
        </button>
      </div>

      <!-- Doctor Cards Container -->
      <div id="doctors-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Dynamically Generated Doctor Cards will be inserted here -->
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
  <script type="module" src="./js/common/index.js"></script>
  <script type="module" src="./js/doctors/index.js"></script>

</body>

</html>