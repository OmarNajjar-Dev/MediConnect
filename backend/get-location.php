<?php
if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];

    $url = "https://nominatim.openstreetmap.org/reverse?lat=$lat&lon=$lon&format=json";

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: MediConnectApp/1.0\r\n"
        ]
    ];
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);

    if ($response !== false) {
        header('Content-Type: application/json');
        echo $response;
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to fetch location"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing parameters"]);
}
