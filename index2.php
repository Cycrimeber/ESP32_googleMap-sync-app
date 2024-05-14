<?php include './includes/api_key.php';
?>
<html>

<head>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/speedometer.css" rel="stylesheet" type="text/css" />
  <link href="css/googlemap.css" rel="stylesheet" type="text/css" />
  <script src="https://maps.googleapis.com/maps/api/js?key=<?= $api_key; ?>"></script>

  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
  <!-- Container begins -->
  <div class="container bg-light row mx-auto vh-100 pt-5">
    <div class="col-md-12">
      <!-- Google map section begins -->
      <div class="googlemap-section col-md-12">
        <!-- Google map section ends -->
        <h1>Google Maps Example</h1>
        <div id="map"></div>
      </div>
    </div> <!-- Speedometer section begins -->
    <!-- <div class="col-md-4 bg-primary">
      <div class="speedometer-section">
        <h1 class="text-light text-center">Speedometer</h1>
        <hr />

        <div class="mx-auto">
          Speed
          <input id="speedoMeterInputRange-1" type="range" min="0" max="350" value="10" /> -->
    <!-- use AJAx to get value from arduino device  -->
    <!-- <span id="speedoMeterInputRange-value-1">10</span>

          <br />
          Manual adjust speed
          <input type="number" id="manualSpeedInput" min="0" max="180" step="5" />
        </div>

        <br />
        <br />
        <div id="speedometer-1"></div>

        <br />
      </div> -->
  </div>
  <!-- End of speedometer section -->

  </div>

  <script>
    function initMap() {
      // Create initial map centered at default coordinates
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: {
          lat: 6.516648,
          lng: 3.382473
        }
      });

      // Create initial marker with default position
      var marker = new google.maps.Marker({
        position: {
          lat: 6.516648,
          lng: 3.382473
        },
        map: map
      });

      // Function to fetch sensor data asynchronously
      function fetchSensorData() {
        $.ajax({
          url: "get_coordinates.php", // PHP script to retrieve sensor data
          type: "GET",
          dataType: "json",
          success: function(data) {
            // Update marker position with new coordinates
            var newLatLng = new google.maps.LatLng(data.lat, data.lng);
            marker.setPosition(newLatLng);
            console.log(data.lat, data.lng)
            // console.log(newLatLng.lng())
            // console.log(newLatLng.lat())
          },
          error: function(xhr, status, error) {
            console.error("Error fetching sensor data:", error);
          },
        });
      }

      // Fetch sensor data periodically every 5 seconds
      $(document).ready(function() {
        fetchSensorData(); // Fetch initially
        setInterval(fetchSensorData, 5000); // Fetch periodically
      });
    }

    // function initMap() {
    //   // Coordinates for the location (e.g., latitude and longitude)

    //   var coordinates = {
    //     lat: 6.516648,
    //     lng: 3.382473
    //   };
    //   console.log(coordinates.lat, coordinates.lng);
    //   // Create a new map centered at the coordinates
    //   var map = new google.maps.Map(document.getElementById("map"), {
    //     zoom: 15, // Zoom level
    //     center: coordinates, // Center the map at the coordinates
    //   });

    //   // Function to fetch sensor data asynchronously
    //   function fetchSensorData() {
    //     $.ajax({
    //       url: "get_coordinates.php", // PHP script to retrieve sensor data
    //       type: "GET",
    //       dataType: "json",
    //       success: function(data) {
    //         // Update webpage with sensor data

    //         // coordinates.lat = data.lat;
    //         // coordinates.lng = data.lng;

    //         console.log(coordinates.lng);
    //         console.log(coordinates.lat);

    //         // $("#sensorData").html(JSON.stringify(data));


    //       },
    //       error: function(xhr, status, error) {
    //         console.error("Error fetching sensor data:", error);
    //       },
    //     });
    //   }

    //   // Fetch sensor data initially and then periodically every 5 seconds
    //   $(document).ready(function() {
    //     fetchSensorData(); // Fetch initially
    //     setInterval(fetchSensorData, 500); // Fetch periodically
    //   });

    //   // Create a marker and set its position on the map
    //   var marker = new google.maps.Marker({
    //     position: coordinates,
    //     map: map,
    //   });
    // }
  </script>

  <!-- Load the Google Maps JavaScript API with your API key -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4piV9fPz58O0LnJh0kvu9alXh-ovk7vw&callback=initMap" async defer></script>
  <!-- Container ends  -->
</body>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/ui-popover.js"></script>
<script src="js/speedometer.js"></script>
<script type="text/javascript">
  var speedoMeter1 = new speedometer();
  document.getElementById("speedometer-1").append(speedoMeter1.elm);

  var speedoMeterInputRange = document.getElementById(
    "speedoMeterInputRange-1"
  );
  var speedoMeterInputRangeVal = document.getElementById(
    "speedoMeterInputRange-value-1"
  );

  // Manual adjustment of speedometer

  var manualSpeedInput = document.getElementById("manualSpeedInput");

  manualSpeedInput.addEventListener("change", function(e) {
    var speed = e.target.value;
    speedoMeter1.setPosition(speed);
  });
  // Ends manual adjustment of speedometer
  // Use AJAX Call to retrieve values from php
  setInterval(function() {
    fetch("./speedometer.php")
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        // Update the speedometer's position with the value from the PHP script.
        speedoMeter1.setPosition(data.speed);
      });
  }, 10);
  // Ends AJAX Call

  var applyconfig1 = document.getElementById("applyconfig1");

  speedoMeterInputRange.onchange = function(e) {
    speedoMeter1.setPosition(e.target.value);
    speedoMeterInputRangeVal.innerText = e.target.value;
  };

  defaultConfig.onclick = function(e) {
    speedoMeter1 = new speedometer({
      initVal: speedoMeterInputRange.value
    });
    document.getElementById("speedometer-1").innerHTML = "";
    document.getElementById("speedometer-1").append(speedoMeter1.elm);
  };
</script>

</html>