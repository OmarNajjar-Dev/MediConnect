<?php

// Root URL base — already using public/ as DocumentRoot, so base is "/"
const BASE_URL = '/';

// Centralized path map
$paths = [

    // Home
    'home' => [
        'index' => BASE_URL,
    ],

    // Dashboard
    'dashboard' => [
        'index'    => BASE_URL . 'dashboard/index.php',
    ],

    // Authentication
    'auth' => [
        'login'         => BASE_URL . 'auth/login.php',
        'logout'        => BASE_URL . 'auth/logout.php',
        'register'      => BASE_URL . 'auth/register.php',
        'forgot'        => BASE_URL . 'auth/forgot-password.php',
        'check_email'   => BASE_URL . 'auth/check-email.php',
    ],

    // Services
    'services' => [
        'doctors'       => BASE_URL . 'services/doctors.php',
        'hospitals'     => BASE_URL . 'services/hospitals.php',
        'appointments'  => BASE_URL . 'services/appointments.php',
        'emergency'     => BASE_URL . 'services/emergency.php',
    ],

    // Static pages
    'static' => [
        'about'         => BASE_URL . 'static/about.php',
        'privacy'       => BASE_URL . 'static/privacy.php',
        'terms'         => BASE_URL . 'static/terms.php',
        'faq'           => BASE_URL . 'static/faq.php',
        'contact'       => BASE_URL . 'static/contact.php',
        'blood_bank'    => BASE_URL . 'static/blood-bank.php',
    ],

    // Error pages
    'errors' => [
        '401'           => BASE_URL . 'errors/401.php',
        '403'           => BASE_URL . 'errors/403.php',
        '404'           => BASE_URL . 'errors/404.php',
        '500'           => BASE_URL . 'errors/500.php',
    ],
];
