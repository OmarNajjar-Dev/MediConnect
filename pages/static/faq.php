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

    <!-- Layout & Components -->
    <link rel="stylesheet" href="/assets/css/layout/layout.css" />
    <link rel="stylesheet" href="/assets/css/components/animations.css" />
    <link rel="stylesheet" href="/assets/css/components/components.css" />

    <!-- Page Specific Styles -->
    <link rel="stylesheet" href="/assets/css/pages/faq.css" />

    <!-- Custom Styles (Overrides) -->
    <link rel="stylesheet" href="/assets/css/base/style.css" />

    <!-- Responsive Design -->
    <link rel="stylesheet" href="/assets/css/layout/responsive.css" />

</head>

<body class="bg-background">

    <!-- Header Section -->
    <?php require_once './../../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="overflow-hidden pt-20 flex-grow">
        <div class="flex flex-col">
            <section class="bg-mediconnect-white py-12 md:py-20">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                                class="faq-question text-heading cursor-pointer border-none w-full flex items-center justify-between py-4 font-medium text-left">
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
                    <a href="<?= $paths['static']['contact'] ?>"
                        class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium h-10 px-4 py-2 bg-primary text-white hover:bg-medical-600">Contact
                        Support</a>
                </div>
            </section>
        </div>

    </main>

    <!-- Footer -->
    <?php require_once './../../includes/footer.php'; ?>

    <!-- External JavaScript -->
    <script type="module" src="/assets/js/common/index.js"></script>
    <script src="/assets/js/faq.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>