<?php

$host = $_SERVER['HTTP_HOST'];
$basePath = '/mediconnect';

define('BASE_URL', "/mediconnect");

return [
    'base'         => BASE_URL,
    'home'         => BASE_URL . '/',
    'doctors'      => BASE_URL . '/doctors.php',
    'hospitals'    => BASE_URL . '/hospitals.php',
    'appointments' => BASE_URL . '/appointments.php',
    'login'        => BASE_URL . '/login.php',
    'register'     => BASE_URL . '/register.php',

    'roles' => [
        'superadmin' => BASE_URL . '/dashboard/superadmin.php',
        'admin'      => BASE_URL . '/dashboard/admin.php',
        'doctor'     => BASE_URL . '/dashboard/doctor.php',
        'patient'    => BASE_URL . '/dashboard/patient.php',
        'ambulance'  => BASE_URL . '/dashboard/ambulance.php',
        'staff'      => BASE_URL . '/dashboard/staff.php',
    ],

    'errors' => [
        'unauthorized' => BASE_URL . '/unauthorized.php',
        'notfound'     => BASE_URL . '/404.php',
        'server'       => BASE_URL . '/500.php',
    ]
];
