
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION["name"] = trim($_POST["name"]);
$_SESSION["email"] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$_SESSION["password"] = trim($_POST["password"]);

function validate(){
  //validate empty
  if(empty($_SESSION["name"]) || empty($_SESSION["email"]) || empty($_SESSION["password"])){
    return FALSE;
  }

  //validate length and email validity
  if (filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL) && strlen($_SESSION["password"]) >= 6){
    return TRUE;
  } else {
    return FALSE;
  }
}

if(validate() === FALSE){
  session_unset();
  header("Location: ../login.html"); /* Redirect browser */
  exit();
} else {
  header("Location: welcome.php"); /* Redirect browser */
  exit();
}
?>