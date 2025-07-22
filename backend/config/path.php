<?php

// Define base path and URL
$basePath = '/mediconnect';
const BASE_URL = '/mediconnect';

// Define all route paths
$paths = [
    'home' => [
        'index' => BASE_URL,
    ],

    'auth' => [
        'login'    => BASE_URL . '/pages/auth/login.php',
        'register' => BASE_URL . '/pages/auth/register.php',
        'logout'   => BASE_URL . '/backend/auth/logout.php',
    ],

    'services' => [
        'doctors'      => BASE_URL . '/pages/services/doctors.php',
        'hospitals'    => BASE_URL . '/pages/services/hospitals.php',
        'appointments' => BASE_URL . '/pages/services/appointments.php',
        'emergency'    => BASE_URL . '/pages/services/emergency.php',
    ],

    'dashboard' => [
        'index' => BASE_URL . '/pages/dashboard/index.php',
    ],

    'static' => [
        'about'       => BASE_URL . '/pages/static/about.php',
        'privacy'     => BASE_URL . '/pages/static/privacy.php',
        'terms'       => BASE_URL . '/pages/static/terms.php',
        'faq'         => BASE_URL . '/pages/static/faq.php',
        'contact'     => BASE_URL . '/pages/static/contact.php',
        'blood_bank'  => BASE_URL . '/pages/static//blood-bank.php',
        'coming_soon' => BASE_URL . '/pages/static/coming-soon.php',
    ],

    'errors' => [
        'unauthorized' => BASE_URL . '/pages/errors/401.php',
        'forbidden'    => BASE_URL . '/pages/errors/403.php',
        'notfound'     => BASE_URL . '/pages/errors/404.php',
        'server'       => BASE_URL . '/pages/errors/500.php',
    ],
];
