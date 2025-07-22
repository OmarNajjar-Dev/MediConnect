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
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/mediconnect/assets/js/common/index.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>