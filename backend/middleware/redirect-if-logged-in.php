<?php

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];

    if (isset($paths['dashboard'][$role])) {
        header("Location: " . $paths['dashboard'][$role]);
    } else {
        header("Location: " . $paths['home']);
    }
    exit;
}
