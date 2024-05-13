<?php
// Sample PHP script to generate random coordinates
$lat = $_GET['lat'];
$lng = $_GET['lon'];
$latitude = 7.775290;
$longitude = 8.762990;

// Return coordinates as JSON
// echo json_encode(array('lat' => $lat, 'lng' => $lng));
echo json_encode(array('lat' => $latitude, 'lng' => $longitude));
