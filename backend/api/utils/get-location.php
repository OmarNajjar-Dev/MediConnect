<?php

/**
 * Simple Geolocation API for MediConnect
 * Uses OpenCage API only - simple and reliable
 */

require_once __DIR__ . '/../../config/apis.php';

// Enable CORS for frontend requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Validate input parameters
if (!isset($_GET['lat']) || !isset($_GET['lon'])) {
    http_response_code(400);
    echo json_encode([
        "error" => "Missing required parameters",
        "message" => "Both 'lat' and 'lon' parameters are required"
    ]);
    exit;
}

$lat = floatval($_GET['lat']);
$lon = floatval($_GET['lon']);

// Validate coordinates
if ($lat < -90 || $lat > 90 || $lon < -180 || $lon > 180) {
    http_response_code(400);
    echo json_encode([
        "error" => "Invalid coordinates",
        "message" => "Latitude must be between -90 and 90, longitude between -180 and 180"
    ]);
    exit;
}

// Get location data using OpenCage API
$locationData = getLocationFromOpenCage($lat, $lon);

if ($locationData) {
    echo json_encode($locationData);
} else {
    http_response_code(500);
    echo json_encode([
        "error" => "Location service unavailable",
        "message" => "OpenCage service failed to respond"
    ]);
}

/**
 * Get location from OpenCage API
 */
function getLocationFromOpenCage($lat, $lon)
{
    $url = OPENCAGE_BASE_URL . "?" . http_build_query([
        'key' => OPENCAGE_API_KEY,
        'q' => "$lat+$lon",
        'language' => 'en',
        'pretty' => 0,
        'no_annotations' => 1
    ]);

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: 1.0\r\n",
            "timeout" => 10
        ]
    ];

    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);

    if (!$response) {
        return null;
    }

    $data = json_decode($response, true);
    if (!$data || !isset($data['results']) || empty($data['results'])) {
        return null;
    }

    $result = $data['results'][0];
    $address = $result['components'];

    // Extract basic address info
    $city = $address['city'] ?? $address['town'] ?? $address['village'] ?? $address['county'] ?? 'Unknown';
    $district = $address['suburb'] ?? $address['neighbourhood'] ?? null;
    $street = $address['road'] ?? $address['street'] ?? null;
    $country = $address['country'] ?? 'Unknown';
    $state = $address['state'] ?? $address['province'] ?? null;

    // Build clean address
    $cleanAddressParts = array_filter([$street, $district, $city]);
    $cleanAddress = implode(', ', $cleanAddressParts);

    return [
        "success" => true,
        "city" => $city,
        "district" => $district,
        "street" => $street,
        "clean_address" => $cleanAddress ?: $city,
        "country" => $country,
        "state" => $state,
        "confidence" => $result['confidence'] ?? 7,
        "service_used" => "opencage",
        "coordinates" => [
            "lat" => $lat,
            "lng" => $lon
        ]
    ];
}
