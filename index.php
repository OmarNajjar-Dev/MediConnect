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
  <link rel="stylesheet" href="css/layout.css" />
  <link rel="stylesheet" href="css/animations.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />

  <!-- Page Title -->
  <title>MediConnect - Bridging Healthcare & Technology</title>
</head>

<body class="bg-background text-foreground">
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
        <a href="./" class="text-medical-700 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
        <a href="./doctors.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
        <a href="./hospitals.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
        <a href="./appointments.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
        <a href="./dashboard.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
      </nav>

      <!-- Header Right Section -->
      <div class="flex items-center gap-4">
        <!-- Sign In / Sign Up buttons (hidden by default) -->
        <a href="./login.php"
          class="hidden items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
          In</a>
        <a href="./signup.php"
          class="hidden items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
          Up</a>

        <!-- Mobile Menu Button -->
        <button id="menu-button"
          class="inline-flex items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-0 pointer md:hidden">
          <i data-lucide="menu" class="w-4 h-4"></i>
        </button>
      </div>

      <!-- Mobile Navigation (Hidden by default) -->
      <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
        <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
          <a href="./"
            class="text-medical-700 bg-medical-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
          <a href="./doctors.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
          <a href="./hospitals.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
          <a href="./appointments.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
          <a href="./dashboard.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

          <!-- Sign In / Sign Up buttons (Mobile view) -->
          <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
            <a href="./login.php"
              class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
              In</a>
            <a href="./signup.php"
              class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
              Up</a>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="overflow-hidden pt-20 flex-grow">
    <!-- Hero Section -->
    <section class="relative py-20 sm:py-28">
      <div class="absolute inset-0 bg-cover bg-center" id="hero-image">
        <div id="hero-background" class="absolute inset-0 bg-gradient-to-r from-medical-800/90 to-blue-900/70"></div>
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
            <a href="./appointments.php"
              class="inline-flex items-center justify-center bg-medical-500 hover:bg-medical-400 rounded-full text-white text-sm font-medium px-8 h-11 transition-colors">
              Book an Appointment
            </a>
            <a href="./doctors.php"
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
          class="grid grid-cols-1 grid-cols-3 gap-6 max-w-5xl mx-auto leading-relaxed">
          <!-- Testimonials will be dynamically added here using JavaScript -->
        </div>
      </div>
    </section>
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
            <li>
              <a href="./pharmacy.php" class="text-gray-600 hover:text-medical-600 transition-colors">
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

  <!-- JavaScript -->
  <script type="module" src="js/common/header.js"></script>
  <script type="module" src="js/common/mobile-nav.js"></script>

  <script type="module" src="js/home/index.js"></script>

</body>

</html>