<?php
  setcookie("login_token_ex");
  setcookie("login_token_ex", "", time() - (86400 * 30), "/");
  header('Location: ../login.php');
?>