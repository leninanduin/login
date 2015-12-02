<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  include_once 'server/models/auth_token.php';
  include_once 'server/models/user.php';

  function pr($a) {
    echo '<pre>';
    print_r($a);
    echo '</pre>';
  }

  function getVisitorCity() {
    $details = json_decode(file_get_contents("http://ipinfo.io/json"));
    return $details->city;
  }

  class Result {
    public $msg;
    public $status;

    public function render() {
      return json_encode($this);
    }
  }

  function getToken() {
    $token = new AuthToken();
    if (array_key_exists('login_token_ex', $_COOKIE)) {
      $token->loadByToken($_COOKIE['login_token_ex']);
    }
    return $token;
  }

  function checkPresentAuthToken() {
    $token = getToken();
    if ($token->isValid()) {
      header('Location: user.php');
      die;
    }
  }

  function getUser($uid) {
    $user = new User(array('id'=>$uid));
    $user->loadById();
    return $user;
  }
?>