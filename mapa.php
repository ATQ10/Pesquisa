<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      #map {
        height: 100%;
      }
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <?php
    echo '
    <script>
      let map;
      let marker;
      let geocoder;
      let response;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 13,
          center: { lat: 21.4361959, lng: -102.5728335 },
          mapTypeControl: false,
        });
        geocoder = new google.maps.Geocoder();
        marker = new google.maps.Marker({
          map,
        });
        clear();
        console.log(geocode({ address: "'.$_GET['ubicacion'].'" }));
      }

      function clear() {
        marker.setMap(null);
      }

      function geocode(request) {
        clear();
        geocoder
          .geocode(request)
          .then((result) => {
            const { results } = result;
            console.log(results[0].geometry.location);
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            marker.setMap(map);
            return results;
          })
          .catch((e) => {
            alert("Geocode was not successful for the following reason: " + e);
          }); 
      }
    </script>
    ';
    ?>
    
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHagA2BQvLxdrWudKIgfC0g8-6fDOIfVo&callback=initMap&v=weekly"
      async
    ></script>
  </body>
</html>
