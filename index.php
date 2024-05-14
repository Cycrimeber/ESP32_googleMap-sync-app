<?php include './includes/api_key.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Live GPS Tracking</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?= $api_key; ?>"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body>
  <div class="container vh-100">

    <div class="row bg-light">

      <div class="row">
        <h1 class="text-success text-center my-3">Google Maps Showing Present Position</h1>
        <div class="fs-5 text-primary fw-bold text-center">
          Longitude: <span id="longitude" class="text-info"></span> | Latitude: <span id="latitude" class="text-info"></span>
        </div>
      </div>

      <!-- Scroll bars -->
      <div class="row my-4 justify-content-around ">
        <div class="col-md-5">
          <p class="text-primary fw-bold">EMF</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="emf"></div>
          </div>
        </div>
        <div class="col-md-5">
          <p class="text-primary fw-bold">METALLIC</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="metallic"></div>
          </div>
        </div>

      </div>

      <div class="row mx-auto">
        <div id="map" style="width: 100%; height: 600px;"></div>
      </div>
    </div>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/ui-popover.js"></script>
    <script>
      function initMap() {
        // Initial coordinates
        var initialLatLng = {
          lat: 0,
          lng: 0
        };

        // Create map
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: initialLatLng
        });

        // Create marker
        var marker = new google.maps.Marker({
          position: initialLatLng,
          map: map,
          title: 'Current Location'
        });

        // Function to update map with new coordinates
        function updateMap() {
          $.ajax({
            url: 'get_gps_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data.latitude && data.longitude) {
                // display details on webpage
                document.getElementById('longitude').innerHTML = data.longitude;
                document.getElementById('latitude').innerHTML = data.latitude;
                var emf = document.getElementById('emf');
                var metallic = document.getElementById('metallic');

                metallic.style.width = data.metallic + "%";
                emf.style.width = data.emf + "%";

                // Change metallic color
                if (parseInt(metallic.style.width) <= 50) {
                  metallic.classList.add('bg-success');

                } else if (parseInt(metallic.style.width) <= 79) {
                  metallic.classList.add('bg-warning');
                } else {
                  metallic.classList.add('bg-danger');
                }
                // Change emf color
                if (parseInt(emf.style.width) <= 50) {
                  emf.classList.add('bg-success');
                } else if (parseInt(emf.style.width) <= 80) {
                  emf.classList.add('bg-warning');
                } else {
                  emf.classList.add('bg-danger');
                }


                // Update marker position
                var newLatLng = {
                  lat: parseFloat(data.latitude),
                  lng: parseFloat(data.longitude)
                };
                marker.setPosition(newLatLng);

                // Center map on new position
                map.setCenter(newLatLng);
              } else {
                console.error('No GPS data received');
              }
            },
            error: function(xhr, status, error) {
              console.error('Error fetching GPS data:', error);
            }
          });
        }

        // Update map every 5 seconds (adjust as needed)
        setInterval(updateMap, 100);
      }
      initMap();
    </script>
</body>

</html>