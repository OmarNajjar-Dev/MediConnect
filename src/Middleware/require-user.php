<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: " . $paths['auth']['login']);
    exit();
}
