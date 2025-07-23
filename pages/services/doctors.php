<?php

$currentPage = "doctors";

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/../../backend/middleware/session-context.php";

// 3. Include avatar helper
require_once __DIR__ . "/../../backend/helpers/avatar-helper.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Meta Tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Lucide Icons -->
  <?php require_once __DIR__ . '/../../backend/config/apis.php'; ?>
  <script src="<?= LUCIDE_CDN_URL ?>"></script>

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
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            All Specialties
          </button>

          <!-- Cardiologist Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Cardiologist
          </button>

          <!-- Dermatologist Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Dermatologist
          </button>

          <!-- Neurology Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Neurologist
          </button>

          <!-- Orthopedics Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Orthopedist
          </button>

          <!-- Pediatrics Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Pediatrician
          </button>

          <!-- Psychiatry Button -->
          <button
            class="specialty-button inline-flex items-center justify-center gap-2 whitespace-nowrap bg-background cursor-pointer rounded-full text-sm font-medium transition-all border border-solid border-input hover:bg-medical-50 hover:text-primary h-10 px-4 py-2">
            Psychiatrist
          </button>
        </div>
      </div>

      <!-- No Doctors Found Message -->
      <div class="no-results hidden glass-card rounded-xl p-6 py-16 text-center">
        <div class="mx-auto w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mb-4">
          <i data-lucide="triangle-alert" class="w-7 h-7 text-gray-400"></i>
        </div>
        <h2 class="text-xl font-medium mb-2 tracking-tight text-heading">No doctors found</h2>
        <p class="text-gray-600 mb-4">Try adjusting your search criteria</p>
        <button
          class="clear-filters inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md border border-solid border-input text-sm font-medium transition-colors bg-primary text-white hover:bg-medical-400 h-10 px-4 py-2 cursor-pointer">
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
  <?php require_once './../../includes/footer.php'; ?>

  <script>
    const appointmentPath = "<?= $paths['services']['appointments'] ?>";
  </script>

  <!-- External JavaScript -->
  <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
  <script type="module" src="/mediconnect/assets/js/doctors/index.js"></script>

</body>

</html>