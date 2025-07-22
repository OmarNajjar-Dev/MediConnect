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
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/mediconnect/assets/css/base.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/colors.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/typography.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/spacing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/sizing.min.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/borders.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/layout.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/animations.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/components.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/style.css" />
    <link rel="stylesheet" href="/mediconnect/assets/css/responsive.css" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

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
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>