<?php
  include 'misc.php';
  checkPresentAuthToken();
?>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation"><a href="index.php">Sign up</a></li>
          <li role="presentation"><a href="#">Login</a></li>
        </ul>
      </nav>
      <h3 class="text-muted">Geo sign up example</h3>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2>Login</h2>

        <form id="login" method="post">
          <input type="email" name="email" id="email" class="form-control" placeholder="Email:" required="" autofocus="">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password:" required="">
          <div class="checkbox">
            <label>
              <input type="checkbox" value="1" name="rememberme" id="rememberme"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>