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
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  var city = "<?php echo getVisitorCity();?>";
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjmFFqfjOW7BIBC0ltJd_ql5qITzSjX84&callback=initMap"></script>
<script type="text/javascript" src="js/map-functions.js"></script>
<body>
  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation"><a href="#">Sign up</a></li>
          <li role="presentation"><a href="login.php">Login</a></li>
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
        <form action="server/register.php" method="post">
          <div class="col-md-6">
            <input class="form-control" type="text" name="address_line_1" id="address_line_1" placeholder="Address line 1:" required>
            <span class="help">Street address, P.O. box, company name, c/o</span>
            <input class="form-control" type="text" name="city" id="city" placeholder="City:" required>
            <input class="form-control" type="text" name="state_or_region" id="state_or_region" placeholder="State/Province/Region:" required>
            <input class="form-control" type="text" name="zip" id="zip" placeholder="Postal code:" required>
            <input class="form-control" type="text" name="country" id="country" placeholder="Country:" required>
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
          </div>

          <div class="col-md-6">
            <input class="form-control" type="text" name="full_name" id="full_name" placeholder="Full name:" required>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email:" required>
            <input class="form-control" type="password" name="password" placeholder="Password:">
            <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone number:">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
          </div>

        </form>
      </div>
      <div class="col-md-6" id="map" style="height:450px;">
    </div>

    </div>

  </div>

</body>
</html>