<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail)
require_once __DIR__ . "/backend/middleware/session-context.php";

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

      <!-- Right section: Auth / Dropdown / Emergency / Menu -->
      <div class="flex items-center gap-4">

        <?php if ($isLoggedIn): ?>
          <!-- User dropdown (visible if logged in) -->
          <div class="hidden md:flex items-center gap-3 mr-4">
            <div class="dropdown relative">
              <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 pointer rounded-lg">
                <div class="w-8 h-8 rounded-full bg-medical-100 flex items-center justify-center text-medical-700 text-sm lg:text-base font-medium">
                  <?= strtoupper(substr($userName, 0, 2)) ?>
                </div>
                <span class="hidden lg:block text-sm lg:text-base font-medium slate-700 max-w-24 truncate">
                  <?= htmlspecialchars($userName) ?>
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 slate-500"></i>
              </button>

              <!-- Dropdown menu content -->
              <div class="dropdown-content overflow-hidden hidden animate-fade-in absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-solid border-gray-100 z-50">
                <div class="px-3 py-2 border-b border-solid border-medical-100">
                  <p class="text-sm font-medium slate-700"><?= htmlspecialchars($userName) ?></p>
                  <p class="text-xs slate-500"><?= htmlspecialchars($userEmail) ?></p>
                </div>

                <a href="<?= $paths['dashboard']['index'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-primary hover:bg-medical-50 transition-colors transition-200">
                  <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                </a>

                <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                  <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Emergency button (always visible) -->
        <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
          <i data-lucide="ambulance" class="w-4 h-4"></i>
          Emergency
        </a>

        <?php if (!$isLoggedIn): ?>
          <!-- Sign In / Sign Up (visible if not logged in) -->
          <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all md:ml-4">
            Sign In
          </a>

          <a href="<?= $paths['auth']['register'] ?>" class="hidden lg:flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
            Sign Up
          </a>
        <?php endif; ?>

        <!-- Mobile menu toggle button -->
        <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
          <i data-lucide="menu" class="w-4 h-4"></i>
        </button>
      </div>

      <!-- Mobile Navigation Panel (visible only on mobile) -->
      <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
        <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
          <a href="<?= $paths['home']['index'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
          <a href=" <?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
          <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
          <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

          <!-- Mobile: Sign In / Sign Out depending on session -->
          <?php if (!$isLoggedIn): ?>
            <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
              <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
              <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
            </div>
          <?php else: ?>
            <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
              <a href="<?= $paths['dashboard']['index'] ?>" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                <i data-lucide="user" class="w-4 h-4"></i> Dashboard
              </a>
              <a href="<?= $paths['auth']['logout'] ?>" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
              </a>
            </div>
          <?php endif; ?>
        </nav>
      </div>

    </div>
  </header>

  <!-- Main Content -->
  <main class="overflow-hidden pt-20 flex-grow">
    <div class="flex flex-col">
      <!-- Hero Section -->
      <section id="contact-section-top" class="py-12 md:py-20">
        <div class="container mx-auto px-4 md:px-6 text-center">
          <h1 class="text-4xl md:text-5xl text-heading font-bold mb-4">
            Contact Us
          </h1>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            We're here to help! Reach out with any questions, suggestions, or
            concerns.
          </p>
        </div>
      </section>

      <!-- Contact Form Section -->
      <section class="py-12 bg-white md:py-16">
        <div class="container mx-auto px-4 md:px-6">
          <div class="grid gap-10 max-w-5xl mx-auto md:grid-cols-2">
            <div class="bg-white rounded-lg p-6 shadow-sm border border-solid border-input">
              <h2 class="text-2xl font-bold text-heading mb-6">
                Send Us a Message
              </h2>
              <form id="contact-form">
                <div class="flex flex-col gap-4">
                  <div>
                    <label for="name" class="block mb-2 text-sm text-heading font-medium">Your Name</label>
                    <input id="name" name="name" placeholder="John Doe" required
                      class="flex h-10 w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm" />
                  </div>
                  <div>
                    <label for="email" class="block mb-2 text-sm text-heading font-medium">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="john.doe@example.com" required
                      class="flex h-10 w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-base focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm" />
                  </div>

                  <!--select case-->
                  <div class="relative">
                    <label for="subject" class="block mb-2 text-sm text-heading font-medium">
                      Subject
                    </label>

                    <!-- Button that toggles dropdown -->
                    <button id="dropdown-button" type="button" role="combobox"
                      class="flex h-10 w-full items-center justify-between pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
                      <span>Select a subject</span>
                      <i data-lucide="chevron-down" class="w-4 h-4 opacity-50"></i>
                    </button>

                    <!-- Custom Dropdown Menu -->
                    <ul id="dropdown-menu"
                      class="absolute z-10 mt-1.5 p-1 border border-solid border-input w-full bg-white rounded-md shadow-xl hidden">
                      <li>
                        <button type="button"
                          class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100"
                          data-value="general">
                          <span>General Inquiry</span>
                          <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button"
                          class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100"
                          data-value="support">
                          <span>Technical Support</span>
                          <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button"
                          class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100"
                          data-value="billing">
                          <span>Billing Question</span>
                          <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button"
                          class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100"
                          data-value="partnership">
                          <span>Partnership Opportunity</span>
                          <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button"
                          class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100"
                          data-value="feedback">
                          <span>Feedback</span>
                          <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                        </button>
                      </li>
                    </ul>
                  </div>

                  <div>
                    <label for="message" class="block mb-2 text-sm text-heading font-medium">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="How can we help you?" required
                      class="resize-y scrollbar-none flex w-full rounded-sm border border-solid border-input bg-background px-3 py-2 text-sm focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white"></textarea>
                  </div>
                  <button type="submit" id="contact-submit-btn"
                    class="w-full inline-flex border border-solid border-input items-center text-white outline-none justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors h-10 px-4 py-2 bg-medical-400 hover:bg-primary pointer">
                    Send Message
                  </button>
                </div>
              </form>
            </div>

            <div class="flex flex-col gap-6">
              <h2 class="text-2xl font-bold text-heading">
                Contact Information
              </h2>

              <div class="flex items-start">
                <div class="flex items-center justify-center bg-medical-100/65 p-3 rounded-full mr-4">
                  <i data-lucide="map-pin" class="w-6 h-6 text-medical-500"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-heading mb-1">Our Address</h4>
                  <p class="text-gray-600">
                    123 Health Street<br />
                    Medical District<br />
                    MD 12345, United States
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex items-center justify-center bg-medical-100/65 p-3 rounded-full mr-4">
                  <i data-lucide="phone" class="w-6 h-6 text-medical-500"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-heading mb-1">
                    Phone Number
                  </h4>
                  <p class="text-gray-600">(123) 456-7890</p>
                  <p class="text-gray-500 text-sm">Mon-Fri, 9am-6pm EST</p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex items-center justify-center bg-medical-100/65 p-3 rounded-full mr-4">
                  <i data-lucide="mail" class="w-6 h-6 text-medical-500"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-heading mb-1">Email</h4>
                  <p class="text-gray-600">support@mediconnect.com</p>
                  <p class="text-gray-500 text-sm">
                    We'll respond as soon as possible
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex items-center justify-center bg-medical-100/65 p-3 rounded-full mr-4">
                  <i data-lucide="clock" class="w-6 h-6 text-medical-500"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-heading mb-1">
                    Working Hours
                  </h4>
                  <p class="text-gray-600">
                    Monday - Friday: 9:00 AM - 6:00 PM<br />
                    Saturday: 10:00 AM - 4:00 PM<br />
                    Sunday: Closed
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Map Section -->
      <section class="py-12 bg-gray-50 text-center">
        <h2 class="text-2xl font-bold text-heading mb-8">Our Location</h2>
        <div class="h-90 max-w-5xl mx-auto bg-gray-200 rounded-lg shadow-sm overflow-hidden">
          <iframe class="w-full h-full"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3291.417291604998!2d35.83682917540748!3d34.4161540730221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1521f6c63d972745%3A0x81a8ba02f94c54d5!2sCNAM!5e0!3m2!1sen!2slb!4v1748004187718!5m2!1sen!2slb"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>
    </div>
  </main>

  <!-- Dynamic Toast -->
  <div id="toast" class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg">
    <p id="toast-title" class="font-semibold"></p>
    <p id="toast-message" class="text-sm"></p>
  </div>

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
  <script type="module" src="/mediconnect/js/contact/index.js"></script>

</body>

</html>