<?php

$currentPage = "home";

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $userProfileImage, $userAddress, $userCity)
require_once __DIR__ . "/backend/middleware/session-context.php";

// 3. Include avatar helper
require_once __DIR__ . "/backend/helpers/avatar-helper.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Meta Tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Lucide Icons -->
  <?php require_once __DIR__ . '/backend/config/apis.php'; ?>
  <script src="<?= LUCIDE_CDN_URL ?>"></script>

    <!-- Base Styles -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base/base.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/base/typography.css" />
    
    <!-- Design System -->
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/colors.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/utils/borders.css" />
    
    <!-- Layout & Components -->
    <link rel="stylesheet" href="/mediconnect/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components/components.css" />
    
    <!-- Custom Styles (Overrides) -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base/style.css" />
    
    <!-- Responsive Design -->
    <link rel="stylesheet" href="/mediconnect/assets/css/layout/responsive.css" />

  <!-- Page Title -->
  <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

  <!-- Header Section -->
  <?php require_once './includes/header.php'; ?>

  <!-- Main Content -->
  <main class="overflow-hidden pt-20 flex-grow">

    <!-- Hero Section -->
    <section class="relative py-20 sm:py-28 m-0">
      <div class="absolute inset-0 bg-cover bg-center" id="hero-image">
        <div id="hero-background" class="absolute inset-0"></div>
      </div>
      <div class="container mx-auto px-4 relative">

        <!-- Hero Text Content -->
        <div id="hero-content" class="max-w-3xl mx-auto text-center mb-12">
          <span
            class="inline-block bg-white/20 text-white rounded-full text-sm font-medium px-3 py-1 mb-4 backdrop-blur-sm">
            Simplifying Healthcare Access
          </span>

          <h1 class="text-white text-4xl sm:text-5xl md:text-6xl md:leading-tight drop-shadow-md mb-4">
            Connecting Patients with Healthcare Professionals
          </h1>

          <p class="text-white/90 text-xl mb-8 drop-shadow">
            Book appointments, connect with specialists, and access quality
            healthcare services - all in one place.
          </p>

          <!-- Call-to-Action Buttons -->
          <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="<?= $paths['services']['appointments'] ?>"
              class="inline-flex items-center justify-center bg-primary hover:bg-medical-400 rounded-full text-white text-sm font-medium px-8 h-11 transition-colors">
              Book an Appointment
            </a>
            <a href="<?= $paths['services']['doctors'] ?>"
              class="inline-flex items-center justify-center rounded-full text-medical-500 border border-solid border-input bg-input hover:text-medical-400 hover:bg-transparent text-sm font-medium px-8 h-11 transition-colors">
              Find a Doctor
            </a>
          </div>
        </div>

        <!-- Hero Cards Grid Container -->
        <div id="hero-cards-container" class="grid grid-cols-1 md:grid-cols-3 max-w-4xl mx-auto gap-6">
          <!-- Cards will be added dynamically using JavaScript -->
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20">
      <div class="container mx-auto px-4">

        <!-- Services Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16">
          <span class="inline-block px-3 py-1 mb-4 text-sm font-medium rounded-full bg-medical-100 text-medical-800">
            Our Services
          </span>
          <h2 class="mb-4 text-gray-900 text-3xl sm:text-4xl leading-tight tracking-tight">
            Comprehensive Healthcare Solutions
          </h2>
          <p class="text-gray-600 text-xl">
            MediConnect offers a range of services to meet your healthcare
            needs.
          </p>
        </div>

        <!-- Services Cards Grid Container -->
        <div id="services-cards-container" class="grid grid-cols-1 lg:grid-cols-4 lg:flex-row gap-6 m-auto">
          <!-- Cards inserted dynamically using JavaScript -->
        </div>
      </div>
    </section>

    <!-- Rating Section -->
    <section id="rating" class="py-20 bg-medical-50">
      <div class="container mx-auto px-4">

        <!-- Rating Section Header -->
        <div class="max-w-3xl mx-auto text-center mb-16">
          <span class="inline-block px-3 py-1 mb-4 text-sm font-medium rounded-full bg-medical-100 text-medical-800">
            Ratings & Reviews
          </span>
          <h2 class="font-bold mb-4 text-3xl sm:text-4xl text-heading tracking-tight">
            Transparent Healthcare Quality
          </h2>
          <p class="text-xl text-gray-600">
            Access ratings and reviews to make informed healthcare decisions.
          </p>
        </div>
      </div>

      <!-- Rating Cards Grid Container -->
      <div id="rating-cards-container" class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <!-- Rating cards will be inserted dynamically using JavaScript -->
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20">
      <div class="container mx-auto px-4">

        <!-- Testimonials Section Header -->
        <div id="testimonials-header" class="max-w-3xl mx-auto text-center mb-16">
          <span class="inline-block px-3 py-1 mb-4 text-sm font-medium rounded-full bg-medical-100 text-medical-800">
            Testimonials
          </span>
          <h2 class="font-bold mb-4 text-3xl sm:text-4xl tracking-tight text-heading">
            What Our Users Say
          </h2>
          <p class="text-xl text-gray-600">
            Hear from patients and healthcare providers who use MediConnect.
          </p>
        </div>

        <!-- Testimonials Cards Grid Container -->
        <div id="testimonials-cards-container"
          class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto leading-relaxed">
          <!-- Testimonials will be dynamically added here using JavaScript -->
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <?= require_once './includes/footer.php'; ?>

  <!-- External JavaScript -->
  <script type="module" src="/mediconnect/assets/js/common/index.js"></script>
  <script type="module" src="/mediconnect/assets/js/home/index.js"></script>

</body>

</html>