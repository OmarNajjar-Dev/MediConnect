<?php

$basePath = '/mediconnect';
const BASE_URL = '/mediconnect';

$paths = [
    'home' => BASE_URL . '/',

    'auth' => [
        'login'    => BASE_URL . '/login.php',
        'logout'   => BASE_URL . '/backend/auth/logout.php',
        'register' => BASE_URL . '/register.php',
    ],

    'services' => [
        'doctors'      => BASE_URL . '/doctors.php',
        'hospitals'    => BASE_URL . '/hospitals.php',
        'appointments' => BASE_URL . '/appointments.php',
        'emergency'    => BASE_URL . '/emergency.php'
    ],

    'dashboard' => [
        'superadmin' => BASE_URL . '/dashboard/superadmin.php',
        'admin'      => BASE_URL . '/dashboard/admin.php',
        'doctor'     => BASE_URL . '/dashboard/doctor.php',
        'patient'    => BASE_URL . '/dashboard/patient.php',
        'ambulance'  => BASE_URL . '/dashboard/ambulance.php',
        'staff'      => BASE_URL . '/dashboard/staff.php',
    ],

    'static' => [
        'about'    => BASE_URL . '/about.php',
        'privacy'  => BASE_URL . '/privacy.php',
        'terms'    => BASE_URL . '/terms.php',
        'faq'      => BASE_URL . '/faq.php',
        'contact'  => BASE_URL . '/contact.php',
    ],

    'errors' => [
        'unauthorized' => BASE_URL . '/errors/401.php',
        'notfound'     => BASE_URL . '/errors/404.php',
        'server'       => BASE_URL . '/errors/500.php',
    ],
];
