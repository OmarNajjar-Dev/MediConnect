<?php

$paths = require_once __DIR__ . '/../config/path.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];

    if (isset($paths['roles'][$role])) {
        header("Location: " . $paths['roles'][$role]);
    } else {
        header("Location: " . $paths['base']);
    }
    exit;
}
