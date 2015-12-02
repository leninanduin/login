<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  header('Content-Type: application/json; charset=utf-8');
  // header('Content-Type: text/html; charset=utf-8');

  include '../misc.php';
  include_once 'models/user.php';

  $result = new Result();

  try {
    $user = new User($_POST);
    try {
      $r = (array_key_exists('rememberme', $_POST)) ? $_POST['rememberme'] : 0;
      // getting the token
      $token = $user->login($_POST['password'], $r);
      setcookie("login_token_ex", $token->token, time() + (86400 * 30), "/"); // 86400 = 1 day

      $result->msg = "You are logedin.";
      $result->status = 'SUCCESS';
    } catch (Exception $e_save) {
      // something went worn saving the token
      $result->msg = $e_save->getMessage();
      $result->status = 'ERROR';
    }
  } catch (Exception $e) {
    // something went wrong creating the token
    $result->msg = $e->getMessage();
    $result->status = 'ERROR';
  }

  echo $result->render();

?>