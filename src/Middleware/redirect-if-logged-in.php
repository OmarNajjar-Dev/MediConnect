<?php

if (isset($_SESSION['user_id'])) {
    header("Location: " . $paths['dashboard']['index']);
    exit;
}
