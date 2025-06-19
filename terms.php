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
        <div class="container mx-auto px-4 py-12 md:px-6">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>
                <div class="text-sm text-gray-500 mb-8">
                    Last updated: May 1, 2025
                </div>
                <div class="max-w-none">
                    <p class="mb-6">
                        Please read these Terms of Service ("Terms", "Terms of Service")
                        carefully before using the MediConnect platform operated by
                        MediConnect, Inc. ("us", "we", "our").
                    </p>
                    <p class="mb-6">
                        By accessing or using our service, you agree to be bound by these
                        Terms. If you disagree with any part of the terms, you may not
                        access the service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">1. Service Description</h2>
                    <p class="mb-6">
                        MediConnect is a healthcare platform designed to connect patients
                        with medical professionals, hospitals, pharmacies, and emergency
                        services. Our platform facilitates appointment booking, medical
                        report sharing, healthcare provider ratings, and other
                        healthcare-related services.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">2. User Accounts</h2>
                    <p class="mb-4">
                        When you create an account with us, you must provide information
                        that is accurate, complete, and current at all times.
                    </p>
                    <p class="mb-6">
                        You are responsible for maintaining the confidentiality of your
                        account and password and for restricting access to your computer
                        or device. You agree to accept responsibility for all activities
                        that occur under your account or password.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">3. User Conduct</h2>
                    <p class="mb-4">As a user, you agree not to:</p>
                    <ul class="list-disc pl-8 mb-6">
                        <li class="mb-2">
                            Use the service for any illegal purpose or in violation of any
                            laws.
                        </li>
                        <li class="mb-2">
                            Impersonate any person or entity or falsely state or
                            misrepresent your affiliation with a person or entity.
                        </li>
                        <li class="mb-2">
                            Interfere with or disrupt the service or servers or networks
                            connected to the service.
                        </li>
                        <li class="mb-2">
                            Post false, misleading, or dishonest reviews of healthcare
                            providers or services.
                        </li>
                        <li class="mb-2">
                            Use the service to distribute unsolicited promotional or
                            commercial content.
                        </li>
                    </ul>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        4. Healthcare Provider Relationships
                    </h2>
                    <p class="mb-6">
                        MediConnect is a platform that facilitates connections between
                        patients and healthcare providers. We are not a healthcare
                        provider and do not provide medical advice, diagnosis, or
                        treatment.
                    </p>
                    <p class="mb-6">
                        All medical information, advice, and services are provided solely
                        by the healthcare providers you connect with through our platform.
                        We are not responsible for the quality, accuracy, or
                        appropriateness of any medical care or advice you receive.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        5. Appointments and Cancellations
                    </h2>
                    <p class="mb-6">
                        By booking an appointment through our platform, you agree to
                        attend the appointment or cancel it within the timeframe specified
                        by the healthcare provider. Repeated no-shows or late
                        cancellations may result in restrictions on your ability to book
                        future appointments.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">6. Ratings and Reviews</h2>
                    <p class="mb-6">
                        When you submit ratings or reviews on our platform, you grant us a
                        non-exclusive, royalty-free, perpetual, irrevocable right to use,
                        reproduce, modify, adapt, publish, translate, create derivative
                        works from, distribute, and display such content throughout the
                        world in any media.
                    </p>
                    <p class="mb-6">
                        You represent and warrant that your ratings and reviews are
                        accurate, honest, and based on your personal experience with the
                        healthcare provider or service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        7. Limitation of Liability
                    </h2>
                    <p class="mb-6">
                        To the maximum extent permitted by law, MediConnect, its
                        affiliates, and their directors, employees, agents, and licensors
                        shall not be liable for any indirect, incidental, special,
                        consequential, or punitive damages, including without limitation,
                        loss of profits, data, use, goodwill, or other intangible losses,
                        resulting from your access to or use of or inability to access or
                        use the service.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">
                        8. Modifications to the Service
                    </h2>
                    <p class="mb-6">
                        We reserve the right, at our sole discretion, to modify or replace
                        these Terms at any time. We will provide notice of any changes by
                        posting the new Terms on this page and updating the "Last updated"
                        date.
                    </p>
                    <p class="mb-6">
                        Your continued use of the service after any such changes
                        constitutes your acceptance of the new Terms.
                    </p>
                    <h2 class="text-2xl font-bold mt-8 mb-4">9. Contact Us</h2>
                    <p>
                        If you have any questions about these Terms, please contact us at:
                    </p>
                    <p class="mt-2">
                        <strong>Email:</strong> legal@mediconnect.com<br /><strong>Postal Address:</strong>
                        123 Health Street, Medical District, MD 12345
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