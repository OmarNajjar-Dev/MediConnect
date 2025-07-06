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
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
</head>

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
        </div>
    </header>

    <!-- Main Content -->
    <main class="overflow-hidden pt-20 flex-grow">
        <div class="container mx-auto px-4 py-12 md:px-6">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>
                <div class="text-sm text-gray-500 mb-8">
                    Last updated: May 1, 2025
                </div>
                <div class="max-w-none">
                    <p class="mb-6">
                        At MediConnect, we take your privacy seriously. This Privacy
                        Policy describes how we collect, use, and share your personal
                        information when you use our platform.
                    </p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Information We Collect</h2>
                    <p class="mb-4">
                        We collect several types of information from and about users of
                        our platform, including:
                    </p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">
                            Personal information such as your name, email address, phone
                            number, and date of birth.
                        </li>
                        <li class="mb-2">
                            Medical information necessary for scheduling appointments and
                            maintaining your health profile.
                        </li>
                        <li class="mb-2">
                            Information about your interactions with our platform, including
                            your browsing history and usage patterns.
                        </li>
                        <li class="mb-2">
                            Device information including IP address, browser type, and
                            operating system.
                        </li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        How We Use Your Information
                    </h2>
                    <p class="mb-4">We use the information we collect to:</p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">Provide, maintain, and improve our services.</li>
                        <li class="mb-2">
                            Process and manage appointments with healthcare providers.
                        </li>
                        <li class="mb-2">
                            Communicate with you about your account, appointments, and other
                            service-related matters.
                        </li>
                        <li class="mb-2">
                            Personalize your experience and deliver content relevant to your
                            interests.
                        </li>
                        <li class="mb-2">
                            Monitor and analyze usage patterns and trends to improve our
                            platform.
                        </li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        Data Sharing and Disclosure
                    </h2>
                    <p class="mb-4">We may share your personal information with:</p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">
                            Healthcare providers with whom you schedule appointments.
                        </li>
                        <li class="mb-2">
                            Third-party service providers who perform services on our
                            behalf.
                        </li>
                        <li class="mb-2">
                            Legal authorities when required by law or to protect our rights.
                        </li>
                    </ul>
                    <p>
                        We will not sell your personal information to third parties for
                        marketing purposes without your explicit consent.
                    </p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Data Security</h2>
                    <p class="mb-6">
                        We implement appropriate security measures to protect your
                        personal information from unauthorized access, alteration,
                        disclosure, or destruction. These measures include:
                    </p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">
                            Encryption of sensitive data both in transit and at rest.
                        </li>
                        <li class="mb-2">
                            Regular security assessments and vulnerability testing.
                        </li>
                        <li class="mb-2">
                            Access controls to limit data access to authorized personnel
                            only.
                        </li>
                        <li class="mb-2">
                            Employee training on data protection and privacy practices.
                        </li>
                    </ul>

                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        Your Rights and Choices
                    </h2>
                    <p class="mb-4">
                        Depending on your location, you may have certain rights regarding
                        your personal information, including:
                    </p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">Access to your personal information.</li>
                        <li class="mb-2">
                            Correction of inaccurate or incomplete information.
                        </li>
                        <li class="mb-2">Deletion of your personal information.</li>
                        <li class="mb-2">
                            Restriction or objection to certain processing activities.
                        </li>
                        <li class="mb-2">Data portability.</li>
                    </ul>
                    <p>
                        To exercise any of these rights, please contact us using the
                        information provided in the "Contact Us" section.
                    </p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        Changes to this Privacy Policy
                    </h2>
                    <p class="mb-6">
                        We may update this Privacy Policy from time to time. We will
                        notify you of any changes by posting the new Privacy Policy on
                        this page and updating the "Last updated" date at the top of this
                        policy.
                    </p>

                    <h2 class="text-2xl font-bold mt-8 mb-4">Contact Us</h2>
                    <p>
                        If you have any questions about this Privacy Policy, please
                        contact us at:
                    </p>
                    <p class="mt-2">
                        <strong>Email:</strong> privacy@mediconnect.com<br />
                        <strong>Postal Address:</strong> 123 Health Street, Medical
                        District, MD 12345
                    </p>
                </div>
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
    <script type="module" src="js/common/header.js"></script>
    <script type="module" src="js/common/mobile-nav.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>