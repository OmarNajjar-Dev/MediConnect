<?php

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

  <!-- Base Styles -->
  <link rel="stylesheet" href="/assets/css/base/base.css" />
  <link rel="stylesheet" href="/assets/css/base/typography.css" />

  <!-- Design System -->
  <link rel="stylesheet" href="/assets/css/utils/colors.css" />
  <link rel="stylesheet" href="/assets/css/utils/spacing.min.css" />
  <link rel="stylesheet" href="/assets/css/utils/sizing.min.css" />
  <link rel="stylesheet" href="/assets/css/utils/borders.css" />
  <link rel="stylesheet" href="/assets/css/utils/ring.css" />

  <!-- Layout & Components -->
  <link rel="stylesheet" href="/assets/css/layout/layout.css" />
  <link rel="stylesheet" href="/assets/css/components/animations.css" />
  <link rel="stylesheet" href="/assets/css/components/components.css" />

  <!-- Custom Styles (Overrides) -->
  <link rel="stylesheet" href="/assets/css/base/style.css" />

  <!-- Responsive Design -->
  <link rel="stylesheet" href="/assets/css/layout/responsive.css" />

  <!-- Page Title -->
  <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

  <!-- Header Section -->
  <?php require_once './../../includes/header.php'; ?>

  <!-- Main Content -->
  <main class="overflow-hidden pt-20 flex-grow">
    <div class="flex flex-col">

      <!-- Hero Section -->
      <section class="bg-mediconnect-white py-12 md:py-20">
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
      <section class="py-12 md:py-16">
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

                  <!-- Select Subject -->
                  <div class="relative" data-dropdown="container">
                    <label for="subject" class="block mb-2 text-sm text-heading font-medium">
                      Subject
                    </label>

                    <!-- Button that toggles dropdown -->
                    <button type="button" role="combobox" data-dropdown="button"
                      class="flex h-10 w-full items-center justify-between cursor-pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
                      <span>Select a subject</span>
                      <i data-lucide="chevron-down" class="w-4 h-4 opacity-50"></i>
                    </button>

                    <!-- Custom Dropdown Menu -->
                    <ul data-dropdown="menu"
                      class="absolute z-10 mt-1.5 p-1 border border-solid border-input w-full bg-white rounded-md shadow-xl hidden">
                      <li>
                        <button type="button" data-dropdown="option"
                          class="bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
                          data-value="general">
                          <span>General Inquiry</span>
                          <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button" data-dropdown="option"
                          class="bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
                          data-value="support">
                          <span>Technical Support</span>
                          <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button" data-dropdown="option"
                          class="bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
                          data-value="billing">
                          <span>Billing Question</span>
                          <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button" data-dropdown="option"
                          class="bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
                          data-value="partnership">
                          <span>Partnership Opportunity</span>
                          <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
                        </button>
                      </li>
                      <li>
                        <button type="button" data-dropdown="option"
                          class="bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
                          data-value="feedback">
                          <span>Feedback</span>
                          <i data-lucide="check" class="w-4 h-4 text-medical-500 hidden"></i>
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
                    class="w-full inline-flex border border-solid border-input items-center text-white outline-none justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors h-10 px-4 py-2 bg-medical-400 hover:bg-primary cursor-pointer">
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
  <?php require_once './../../includes/footer.php'; ?>

  <!-- External JavaScript -->
  <script type="module" src="/assets/js/common/index.js"></script>
  <script type="module" src="/assets/js/contact/index.js"></script>

</body>

</html>