<?php

define('BASE_URL', '/mediconnect');

return [
    'base'        => BASE_URL,
    'login'       => BASE_URL . '/login.php',
    'unauthorized' => BASE_URL . '/unauthorized.php',
    'dashboard'   => BASE_URL . '/dashboard',

    'roles' => [
        'Super Admin' => BASE_URL . '/dashboard/superadmin.php',
        'Admin'      => BASE_URL . '/dashboard/admin.php',
        'Doctor'     => BASE_URL . '/dashboard/doctor.php',
        'Patient'    => BASE_URL . '/dashboard/patient.php',
        'Ambulance'  => BASE_URL . '/dashboard/ambulance.php',
        'Staff'      => BASE_URL . '/dashboard/staff.php',
    ],

    'errors' => [
        '404' => BASE_URL . '/404.php',
        '500' => BASE_URL . '/500.php',
    ]
];
