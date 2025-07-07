<?php

require_once './backend/auth.php';

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
          <a href="./" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
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
            <a href="./dashboard.php"
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
                <form>
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
                      <button id="dropdownButton" type="button" role="combobox" aria-controls="subject-options"
                        aria-expanded="false"
                        class="flex h-10 w-full items-center justify-between pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
                        <span>Select a subject</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                      </button>

                      <!-- Custom Dropdown Menu -->
                      <ul id="dropdownMenu"
                        class="absolute z-10 mt-1.5 p-1 border border-solid border-input w-full bg-white rounded-md shadow-xl hidden">
                        <li>
                          <button type="button"
                            class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-gray-100"
                            data-value="general">
                            <span>General Inquiry</span>
                            <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                          </button>
                        </li>
                        <li>
                          <button type="button"
                            class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-gray-100"
                            data-value="support">
                            <span>Technical Support</span>
                            <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                          </button>
                        </li>
                        <li>
                          <button type="button"
                            class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-gray-100"
                            data-value="billing">
                            <span>Billing Question</span>
                            <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                          </button>
                        </li>
                        <li>
                          <button type="button"
                            class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-gray-100"
                            data-value="partnership">
                            <span>Partnership Opportunity</span>
                            <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
                          </button>
                        </li>
                        <li>
                          <button type="button"
                            class="option-btn w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-gray-100"
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
                    <button type="submit"
                      class="w-full inline-flex border border-solid border-input items-center text-white outline-none justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors h-10 px-4 py-2 bg-medical-400 hover:bg-medical-500 pointer">
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
    <script type="module" src="./js/contact/index.js"></script>

</body>

</html>