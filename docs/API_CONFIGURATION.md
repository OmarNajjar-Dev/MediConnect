# API Configuration

## Overview

This document explains how to use the centralized API configuration in `backend/config/apis.php`.

## Configuration File

All API keys and URLs are stored in `backend/config/apis.php`:

```php
// OpenCage Geocoding API
define('OPENCAGE_API_KEY', 'f7257b4524a9479eacc86758ec47dc69');
define('OPENCAGE_BASE_URL', 'https://api.opencagedata.com/geocode/v1/json');

// EmailJS Configuration
define('EMAILJS_PUBLIC_KEY', ''); // Add your EmailJS public key here
define('EMAILJS_SERVICE_ID', ''); // Add your EmailJS service ID here
define('EMAILJS_TEMPLATE_ID', ''); // Add your EmailJS template ID here

// External CDN URLs
define('LUCIDE_CDN_URL', 'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js');
define('GOOGLE_MAPS_EMBED_URL', 'https://www.google.com/maps/embed');
```

## Usage

### In PHP Files

1. **Include the config file:**

```php
require_once __DIR__ . '/../config/apis.php';
```

2. **Use the constants:**

```php
// For geolocation
$url = OPENCAGE_BASE_URL . "?" . http_build_query([
    'key' => OPENCAGE_API_KEY,
    'q' => $address
]);

// For CDN URLs
<script src="<?= LUCIDE_CDN_URL ?>"></script>
```

### In HTML/PHP Pages

1. **Include the config file:**

```php
<?php require_once __DIR__ . '/backend/config/apis.php'; ?>
```

2. **Use the constants:**

```html
<script src="<?= LUCIDE_CDN_URL ?>"></script>
```

## Benefits

- **Single Source of Truth**: All API keys in one place
- **Easy to Update**: Change API keys without searching through files
- **Clear Organization**: All external services documented in one file
- **Simple**: No complex helper functions, just constants

## Adding New APIs

To add a new API:

1. **Add to `backend/config/apis.php`:**

```php
define('NEW_API_KEY', 'your_api_key_here');
define('NEW_API_URL', 'https://api.example.com');
```

2. **Use in your code:**

```php
require_once __DIR__ . '/../config/apis.php';
$url = NEW_API_URL . "?key=" . NEW_API_KEY;
```
