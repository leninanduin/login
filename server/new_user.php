<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  header('Content-Type: application/json; charset=utf-8');

  include '../misc.php';
  include_once 'src/user.php';

  $result = new Result();

  try {
    $user = new User($_POST);

    try {
      // saving the user
      $user->save();
      $result->msg = "You are registered, now please login.";
      $result->status = 'SUCCESS';
    } catch (Exception $e_save) {
      // something went worn saving the user
      // maybe duplicated email
      $result->msg = $e_save->getMessage();
      $result->status = 'ERROR';
    }
  } catch (Exception $e) {
    // something went wrong creating the user
    // ex: missing info
    $result->msg = $e->getMessage();
    $result->status = 'ERROR';
  }

  echo $result->render();

?>