<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Google Map Demo</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    #map {
      height: 400px;
      width: 80%;
    }
  </style>
</head>

<body>
  <h1>Google Map Demo</h1>
  <div id="map"></div>

  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById("map"), {
        //             $latitude = 7.7375;
        // $longitude = 8.5128;
        center: {
          lat: 0,
          lng: 0
        },
        zoom: 4,
      });

      // Function to get coordinates from PHP script using AJAX
      $.ajax({
        url: "get_coordinates.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
          // Parse coordinates from PHP script response
          var coordinates = {
            lat: parseFloat(data.lat),
            lng: parseFloat(data.lng),
          };
          // Add marker to map
          var marker = new google.maps.Marker({
            position: coordinates,
            map: map,
            title: "Location",
          });
          // Set map center to marker position
          map.setCenter(coordinates);
        },
        error: function(xhr, status, error) {
          console.error("Error:", error);
        },
      });

      // Fetch sensor data initially and then periodically every 5 seconds
      $(document).ready(function() {
        fetchSensorData(); // Fetch initially
        setInterval(fetchSensorData, 5000); // Fetch periodically
      });

    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4piV9fPz58O0LnJh0kvu9alXh-ovk7vw&callback=initMap"></script>
</body>

</html>