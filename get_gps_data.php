<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "googlemap";

// Fetch GPS data from the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sensor ORDER BY time DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude'],
        'emf' => $row['emf'],
        'metallic' => $row['metallic']
    );
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No data available'));
}

$conn->close();
