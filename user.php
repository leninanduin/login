<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  include 'misc.php';
  $token = getToken();

  if (!$token->isValid()) {
    header('Location: login.php');
    die;
  }

  $user = getUser($token->user_id);

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjmFFqfjOW7BIBC0ltJd_ql5qITzSjX84&callback=initMap"></script>
<script type="text/javascript" src="js/map-functions.js"></script>
<script type="text/javascript">
  pos.lat = <?php echo $user->lat;?>;
  pos.lng = <?php echo $user->lng;?>;
</script>
<body>
  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation"><a href="server/logout.php">Logout</a></li>
        </ul>
      </nav>
      <h3 class="text-muted">Hello <?php echo $user->full_name?></h3>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-12" id="map" style="height:450px;">
    </div>

    </div>

  </div>

</body>
</html>