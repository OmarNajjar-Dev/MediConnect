<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Settings -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

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

    <!-- ====================== Main Content ====================== -->
    <main id="about" class="overflow-hidden pt-20 flex-grow min-h-screen pb-16">
        <div class="container mx-auto px-4">

            <!-- 🔹 Intro Section -->
            <div class="py-12">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span
                        class="bg-medical-100 text-medical-700 text-sm font-medium px-4 py-1.5 rounded-full inline-block mb-4">
                        About MediConnect
                    </span>
                    <h1 class="text-4xl font-bold mb-6 text-gray-900 tracking-tight">
                        Making Healthcare Accessible to Everyone
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Since 2010, MediConnect has been transforming healthcare delivery through technology and
                        compassion.
                        Our mission is simple: make quality healthcare accessible to all.
                    </p>
                </div>

                <!-- 🔹 Vision Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
                    <!-- Vision Image + Stats -->
                    <div class="order-1 lg:order-2 relative">
                        <div class="border border-solid border-card rounded-xl overflow-hidden">
                            <div class="relative w-full max-h-62.5 sm:max-h-125 overflow-hidden">
                                <img id="about-image"
                                    src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=880&auto=format&fit=crop"
                                    alt="Medical team"
                                    class="w-full h-full max-h-62.5 sm:max-h-125 object-cover transition-transform transition-700" />
                            </div>
                        </div>
                        <div id="about-trust"
                            class="absolute bg-white p-6 shadow-xl rounded-xl border border-solid border-input flex items-center">
                            <div class="flex items-center justify-center mr-4 bg-medical-100 rounded-full p-3">
                                <i data-lucide="heart-pulse" class="h-8 w-8 text-medical-700"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Trusted by</p>
                                <p class="text-3xl font-bold text-medical-700">500,000+</p>
                                <p class="text-sm font-medium text-gray-600">patients nationwide</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vision Text & Cards -->
                    <div class="order-2 lg:order-1">
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 tracking-tight">Our Vision</h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            We envision a world where quality healthcare is within everyone's reach. Through our
                            innovative digital platform, we're breaking down barriers and creating a healthcare
                            ecosystem that puts patients first.
                        </p>
                        <!-- Vision Cards Placeholder -->
                        <div id="vision-cards-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6"></div>
                    </div>
                </div>

                <!-- 🔹 Journey Section -->
                <div class="mb-24">
                    <div class="text-center mb-12">
                        <h2 class="text-heading text-3xl font-bold mb-4">Our Journey</h2>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            From our humble beginnings to becoming a leader in digital healthcare, every step of our
                            journey has been driven by our commitment to improving lives.
                        </p>
                    </div>
                    <!-- Journey Cards Placeholder -->
                    <div id="journey-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    </div>
                </div>

                <!-- 🔹 Leadership Section -->
                <div class="mb-24">
                    <div class="max-w-5xl mx-auto">
                        <div class="w-full flex flex-col gap-12">

                            <!-- Section Heading -->
                            <div class="text-center">
                                <h2 class="text-3xl font-bold mb-4 text-gray-900">Visionary Leadership</h2>
                                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                                    Meet the exceptional team guiding MediConnect's mission to transform healthcare
                                    access through innovation, compassion, and expertise.
                                </p>
                            </div>

                            <!-- Leadership Cards Placeholder -->
                            <div id="leadership-cards-container" class="flex flex-col gap-14"></div>

                            <!-- CTA -->
                            <div class="flex justify-center">
                                <button id="leadership-cta"
                                    class="inline-flex items-center justify-center gap-2 text-sm font-medium border border-solid border-input bg-background hover:bg-medical-50 text-heading hover:text-medical-500 h-11 rounded-md px-8 transition-colors pointer">
                                    <span>View Full Leadership Team</span>
                                    <i data-lucide="arrow-right" class="ml-2 h-4 w-4 transition-transform"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- 🔹 CTA Section -->
                <div class="my-24 max-w-6xl m-auto">
                    <div class="relative overflow-hidden rounded-3xl">
                        <div id="background-overlay" class="absolute inset-0 opacity-95"></div>
                        <div id="background-overlay-image" class="absolute inset-0 opacity-10 bg-cover bg-center"></div>

                        <div class="relative px-6 sm:px-8 md:px-16 py-12 sm:py-16 md:py-20">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">

                                <!-- Left CTA Text -->
                                <div>
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-6">
                                        Join Our Healthcare Community
                                    </h2>
                                    <p class="text-medical-100 text-base sm:text-lg mb-8 leading-relaxed">
                                        At MediConnect, we're not just providing services - we're building a community
                                        dedicated to health and wellbeing. Whether you're a patient, healthcare
                                        provider, or potential partner, we invite you to be part of our journey toward a
                                        healthier tomorrow.
                                    </p>
                                    <div class="flex flex-col sm:flex-row flex-wrap gap-4">
                                        <button
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors outline-none disabled:opacity-50 border border-solid border-white h-11 rounded-lg px-8 bg-white text-medical-700 hover:bg-gray-100 shadow-lg pointer">
                                            Become a Partner
                                        </button>
                                        <button
                                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors outline-none disabled:opacity-50 border border-solid border-white h-11 rounded-lg px-8 text-white bg-medical-600/30 pointer">
                                            Learn More About Our Mission
                                        </button>
                                    </div>
                                </div>

                                <!-- Right Features -->
                                <div class="flex flex-col gap-6 w-full max-w-full sm:max-w-md mx-auto lg:mx-0">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-solid border-card shadow-xl">
                                        <div class="flex items-start">
                                            <div
                                                class="flex items-center justify-center bg-white/20 rounded-full p-3 mr-4">
                                                <i data-lucide="users"
                                                    class="lucide lucide-users h-6 w-6 text-white"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">
                                                    Patient-Centered Care
                                                </h3>
                                                <p class="text-medical-100">
                                                    Our healthcare approach revolves around your needs, preferences, and
                                                    values, ensuring you receive personalized care.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-solid border-card shadow-xl">
                                        <div class="flex items-start">
                                            <div
                                                class="flex items-center justify-center bg-white/20 rounded-full p-3 mr-4">
                                                <i data-lucide="shield"
                                                    class="lucide lucide-shield h-6 w-6 text-white"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">
                                                    Advanced Protection
                                                </h3>
                                                <p class="text-medical-100">
                                                    Your health data is secured with industry-leading encryption and
                                                    privacy standards that exceed regulatory requirements.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
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
    <script type="module" src="js/about/index.js"></script>
</body>

</html>