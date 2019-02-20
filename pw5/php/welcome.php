<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$logout = "Welcome ".$_SESSION["name"]."<br><a href='logout.php'>Logout</a>";

if (!isset($_SESSION["name"])) {
  //redirect to login.html
  session_unset();
  header("Location: ../login.html"); /* Redirect browser */
  exit();
} else { 
  echo htmlspecialchars_decode($logout);
}
?>