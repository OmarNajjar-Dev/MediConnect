<?php

define('ROOT', dirname(__DIR__));
define('PAGES_PATH', ROOT . '/src/Pages');

// Extract the requested path from the URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Default to home if empty or root
if ($requestUri === '/' || $requestUri === '') {
    require_once PAGES_PATH . '/index.php';
    exit;
}

// Clean the request path
$requestPath = ltrim($requestUri, '/');

// Convert path to PascalCase file name (e.g., auth/login → Auth/login)
$targetFile = PAGES_PATH . '/' . ucfirst(str_replace('.php', '', $requestPath)) . '.php';

// Load the file if it exists, otherwise load 404
if (file_exists($targetFile)) {
    require_once $targetFile;
} else {
    require_once PAGES_PATH . '/Errors/404.php';
}
