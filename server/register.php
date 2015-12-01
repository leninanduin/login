<?php
  error_reporting(E_ALL);
  include_once '../vendor/autoload.php';
  include '../lib/misc.php';
  include 'models/user.php';

  $cfg = new \Spot\Config();

  // MySQL
  $cfg->addConnection('mysql', 'mysql://dbuser:notasecurepassword@localhost/login');
  $spot = new \Spot\Locator($cfg);

  // $userM = $spot->mapper('Entity/User');
  // pr($user);

  pr($_POST);

?>