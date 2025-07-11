<?php

// 1. Load system configuration (paths, constants, routes, etc.)
require_once __DIR__ . "/../backend/config/path.php";

// 2. Load user session context (sets $isLoggedIn, $userName, $userEmail, $dashboardLink)
require_once __DIR__ . "/../backend/middleware/session-context.php";

?>