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
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/faq.css" />

</head>

<?php require_once './backend/db.php'; ?>

<body class="bg-background text-heading">
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
                <a href="./doctors.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="./hospitals.html"
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
            <div id="mobile-nav"
                class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="./"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="./doctors.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="./hospitals.html"
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
        <div class="flex flex-col">
            <section id="faq-top-section" class="py-12 md:py-20">
                <div class="container mx-auto px-4 text-center">
                    <h1 class="text-4xl md:text-5xl text-heading font-bold mb-4">Frequently Asked Questions</h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions about using
                        MediConnect for your
                        healthcare needs.</p>
                </div>
            </section>

            <section class="py-12 bg-white">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-2xl text-heading font-bold mb-6 pb-2 border-b border-solid separator">General
                        Questions</h2>
                    <div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                What is MediConnect?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down animate-slide-down">
                                MediConnect is a healthcare platform designed to connect patients with medical
                                professionals, hospitals, pharmacies, and emergency services. We simplify healthcare
                                access by enabling appointment booking, medical report sharing, and healthcare provider
                                reviews all in one place. </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Is MediConnect free to use?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down animate-slide-down">
                                Yes, the basic features of MediConnect are free for patients. This includes finding
                                doctors, viewing hospital information, and reading reviews. Some premium features may
                                require a subscription, and healthcare providers pay a fee to be listed on our platform.
                            </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Do I need to create an account to use MediConnect?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                While you can browse through doctors and hospitals without an account, you'll need to
                                create an account to book appointments, receive medical reports, and leave reviews.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 bg-white">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-2xl font-bold mb-6 pb-2 border-b border-solid separator text-heading">Appointments
                        Questions</h2>
                    <div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                How do I book an appointment with a doctor?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                To book an appointment, search for a doctor based on specialty or location, select an
                                available time slot on their calendar, and confirm your appointment. You'll receive a
                                confirmation email with all the details. </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Can I reschedule or cancel my appointment?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                Yes, you can reschedule or cancel appointments through your account dashboard. Please
                                note that some healthcare providers have specific cancellation policies, which will be
                                displayed during the booking process.
                            </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Will I receive a reminder before my appointment?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                Yes, we send appointment reminders via email and/or SMS 24 hours before your scheduled
                                appointment. </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 bg-white">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-2xl font-bold mb-6 pb-2 border-b border-solid separator text-heading">Medical
                        Reports Questions
                    </h2>
                    <div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                How do I access my medical reports?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                After your appointment, your doctor will upload your medical report to the platform.
                                You'll receive a notification when it's available, and you can view it in the 'Medical
                                Reports' section of your dashboard.
                            </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Are my medical reports secure?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                Yes, all medical reports are encrypted and securely stored. Only you and your healthcare
                                provider have access to your reports.
                            </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Can I share my medical reports with other doctors?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-up">
                                Yes, you can securely share your medical reports with other healthcare providers on the
                                MediConnect platform directly from your dashboard.

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 bg-white">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-2xl font-bold mb-6 pb-2 border-b border-solid separator text-heading">Reviews &
                        Ratings Questions
                    </h2>
                    <div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                How do I leave a review for a doctor or hospital?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">

                                After your appointment or hospital stay, you'll receive a prompt to leave a review. You
                                can also navigate to the doctor's or hospital's profile and click on the 'Leave Review'
                                button. </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Are all reviews verified?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                Yes, we verify that reviews are from actual patients who have had appointments with the
                                healthcare provider. This ensures the authenticity and reliability of our reviews.
                            </div>
                        </div>
                        <div class="border-b border-solid separator">
                            <button type="button"
                                class="faq-question text-heading pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
                                Can healthcare providers respond to reviews?
                                <i data-lucide="chevron-down" class="w-5 h-5 transition-transform faq-toggle-icon"></i>
                            </button>
                            <div
                                class="pb-4 faq-answer text-gray-600 overflow-hidden text-sm hidden animate-slide-down">
                                Yes, healthcare providers can respond to reviews to address patient feedback or provide
                                additional context. </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 bg-medical-50 to-white">
                <div class="mx-auto px-4 text-center">
                    <h2 class="text-2xl text-heading font-bold mb-4">Didn't Find Your Answer?</h2>
                    <p class="max-w-2xl mx-auto text-gray-600 mb-6">Our support team is here to help. Contact us with
                        any questions or
                        concerns you may have.</p>
                    <a href="./contact.php"
                        class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium h-10 px-4 py-2 bg-medical-500 text-white hover:bg-medical-600">Contact
                        Support</a>
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
                        Connecting patients with healthcare professionals for better care and outcomes.
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
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">Services</h4>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="./appointments.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Book Appointments
                            </a>
                        </li>
                        <li>
                            <a href="./doctors.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="./hospitals.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">Quick Links</h4>
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
                    <h4 class="font-medium text-lg text-heading tracking-tight mb-4">Contact</h4>
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
    <script type="module" src="js/common/header.js"></script>
    <script type="module" src="js/common/mobile-nav.js"></script>

    <script src="js/faq.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>
</body>

</html>