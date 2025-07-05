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
    <link rel="stylesheet" href="css/ring.css" />
    <link rel="stylesheet" href="css/faq.css" />

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
                <a href="./register.php"
                    class="hidden items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    Up</a>

                <!-- Mobile Menu Button -->
                <button id="menu-button"
                    class="inline-flex items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-0 pointer md:hidden">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

        <!-- Mobile Navigation (Hidden by default) -->
        <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg">
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
            <section class="bg-red-50 py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h1 class="text-heading text-3xl md:text-4xl font-bold mb-4">
                            COVID-19 Emergency Response
                        </h1>
                        <p class="text-lg text-gray-700 mb-8">
                            Request immediate medical assistance for COVID-19 related emergencies
                        </p>
                        <div class="flex flex-col gap-6">
                            <button
                                class="gap-2 whitespace-nowrap border border-solid border-input disabled:pointer-events-none disabled:opacity-50 h-10 bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 rounded-sm text-lg shadow-lg flex items-center justify-center w-full md:w-auto md:max-w-[300px]">
                                <i data-lucide="ambulance" class="mr-2 h-4 w-4"></i>
                                Request Emergency Help
                            </button>
                            <p class="text-sm text-gray-600">
                                For COVID-19 emergencies only. Tap above to connect with specialized medical responders.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


















            <section class="py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-8">
                            <div class="flex flex-col gap-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none text-heading tracking-tight flex items-center">
                                    <i data-lucide="ambulance" class="mr-2 text-medical-500"></i>
                                    Emergency Response Status
                                </h3>
                                <p class="text-sm text-muted-foreground">COVID-19 specialized medical team status and location</p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="flex flex-col gap-6">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="text-center">
                                            <div
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent text-primary-foreground hover:bg-medical-400 bg-medical-500 mb-2">
                                                EN ROUTE TO YOUR LOCATION</div>
                                            <div class="mb-4"><i data-lucide="ambulance" class="h-16 w-16 mx-auto text-medical-500"></i>
                                            </div>
                                            <h3 class="text-xl text-heading font-bold">COVID-19 Response Team En Route</h3>
                                            <div class="flex items-center justify-center mt-2"><i data-lucide="clock" class="mr-2 text-medical-500"></i>

                                                <p class="text-gray-800 font-semibold">Estimated arrival: 10 minutes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-lg overflow-hidden h-62.5">
                                        <div class="h-full flex items-center justify-center bg-gray-100 p-4">
                                            <p class="text-center text-gray-600">Please set your Mapbox token in the Contact page
                                                to enable emergency map tracking.</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-4">
                                        <h4 class="font-semibold text-heading text-lg">What to expect:</h4>
                                        <ul class="flex flex-col gap-2">
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>

                                                <p class="text-heading">
                                                    Ambulance staff will be wearing full COVID-19 protective equipment</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    You may be asked screening questions about your symptoms</p>
                                            </li>
                                            <li class="flex"><i data-lucide="shield" class="mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                                <p class="text-heading">
                                                    Please wear a mask if available</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pt-4 border-t">
                                        <h4 class="font-semibold text-heading text-center">Emergency Contact Options</h4>
                                        <div class="flex justify-center space-x-4 mt-4"><button
                                                class="justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center">
                                                <i data-lucide="phone" class="mr-2 h-4 w-4"></i>
                                                Call Dispatch</button><button
                                                class="justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex items-center">Cancel
                                                Request</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>








            <section class="py-8 md:py-12">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="grid gap-6 md:grid-cols-2">

                            <!-- Emergency Signs Card -->
                            <div class="flex flex-col gap-6 p-6 glass-card border-card-soft rounded-lg">

                                <h3 class="text-heading text-2xl font-semibold leading-none tracking-tight">COVID-19 Emergency
                                    Signs</h3>

                                <ul class="flex flex-col gap-2">
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Severe difficulty breathing</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Persistent chest pain or pressure</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Bluish lips or face</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-red-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Confusion or inability to wake/stay awake</p>
                                    </li>
                                </ul>

                                <p class="text-sm text-muted-foreground">If experiencing these symptoms, request
                                    emergency help immediately</p>

                            </div>

                            <!-- Preparation Card -->
                            <div class="flex flex-col gap-6 p-6 rounded-lg glass-card border-card-soft">

                                <h3 class="text-heading text-2xl font-semibold leading-none tracking-tight">What To Prepare</h3>

                                <ul class="flex flex-col gap-2">
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">ID and insurance information (if available)</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">List of current medications</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Mask or face covering</p>
                                    </li>
                                    <li class="flex">
                                        <i data-lucide="arrow-right"
                                            class="lucide lucide-arrow-right mr-2 text-medical-500 flex-shrink-0 mt-0.5"></i>
                                        <p class="text-heading">Phone and charger</p>
                                    </li>
                                </ul>

                                <p class="text-sm text-muted-foreground">Having these items ready helps speed up the
                                    admission process</p>

                            </div>
                        </div>

                        <!-- Alternative Contact -->
                        <div class="mt-8 p-6 glass-card border-card-soft rounded-lg bg-gray-50">
                            <h3 class="text-heading text-lg font-semibold mb-4 text-center">Alternative Contact Options</h3>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <button
                                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-4 py-2 flex items-center justify-center h-16 pointer">
                                    <i data-lucide="phone" class="w-4 h-4 text-heading mr-2"></i>
                                    Emergency COVID-19 Hotline<br />
                                    <span class="font-bold text-heading">800-COVID-19</span>
                                </button>

                                <button
                                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium text-heading glass-card border-card-soft bg-background hover:bg-accent px-4 py-2 flex items-center justify-center h-16 pointer">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-heading mr-2"></i>
                                    Find Nearest<br />COVID-19 Treatment Center
                                </button>
                            </div>
                        </div>
                    </div>
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

    <!-- JavaScript -->
    <script type="module" src="js/common/header.js"></script>
    <script type="module" src="js/common/mobile-nav.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>

</html>