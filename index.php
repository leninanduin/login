<?php
  include 'lib/misc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  var map, infoWindow, marker;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12
    });

    // center the in the visitor city
    var geocoder = new google.maps.Geocoder();
    var location = "<?php echo getVisitorCity();?>";
    geocoder.geocode( { 'address': location }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
      } else {
          alert("Could not find location: " + location);
      }
    });
  }

  function findMe() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        map.setZoom(17);
        map.setCenter(pos);

        var marker = new google.maps.Marker({
          position: pos,
          title: "You are here!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
  }
</script>
<body>
  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation"><a href="#">Sign up</a></li>
          <li role="presentation"><a href="#">Login</a></li>
        </ul>
      </nav>
      <h3 class="text-muted">Geo sign up example</h3>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h2>Register</h2>
        <p>
          <button onclick="findMe()"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Find Me</button>
          or click on the map to find your position.
        </p>
        <fieldset>

        </fieldset>
      </div>
      <div class="col-md-6" id="map" style="height:450px;">
    </div>

    </div>

  </div>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjmFFqfjOW7BIBC0ltJd_ql5qITzSjX84&callback=initMap"></script>
</body>
</html>