<?php
header('Content-Type: application/json');

$speed = 50; // Replace this value with the actual speed value from the server.

$response = [
    'speed' => $speed
];

echo json_encode($response);
