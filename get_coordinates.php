<?php
include './includes/connect.php';
// SQL query to retrieve the latest data from the table
$sql = "SELECT * FROM sensor ORDER BY ID DESC LIMIT 1";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die("Error executing query: " . $conn->error);
}

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch the data from the result set
    $row = $result->fetch_assoc();

    // Process the data
    // For example, you can access individual columns like this:
    $id = $row["ID"];
    $lng = $row["longitude"];
    $lat = $row["latitude"];

    // Return coordinates as JSON
    // echo json_encode(array('lat' => $latitude, 'lng' => $longitude));
    // echo $lat;
    echo json_encode(array('lat' => $lat, 'lng' => $lng));
} else {
    echo "No data found";
}



// Close connection
$conn->close();


// Sample PHP script to generate random coordinates
// $lat = 7.775290;
// $lng = 8.762990;

// $lat = 6.505781;
// $lng = 3.354945;