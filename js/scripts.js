$(document).ready(function () {
  // Initialize Google Map
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 0, lng: 0 }, // Default center
    zoom: 2, // Default zoom level
  });

  // Function to make AJAX call to PHP script
  function getLocationCoordinates() {
    $.ajax({
      url: "get_coordinates.php",
      method: "GET",
      dataType: "json",
      success: function (response) {
        // Loop through response to add markers to map
        response.forEach(function (location) {
          var marker = new google.maps.Marker({
            position: {
              lat: parseFloat(location.latitude),
              lng: parseFloat(location.longitude),
            },
            map: map,
            title: location.name,
          });
        });
      },
      error: function () {
        console.log("Error: Unable to fetch location coordinates.");
      },
    });
  }

  // Call function to get location coordinates
  getLocationCoordinates();
});
