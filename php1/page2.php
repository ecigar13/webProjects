<?php
  session_start();
  echo $_POST["username"]." ".$_POST["password"];

  $username = $_POST["username"];
  $pwd=$_POST["password"];

  if(empty($username) || empty($pwd)){
    header('Location: page1.html');
  }else{
    //connect to database
    $con=mysqli_connect("localhost","root","password","test",'3306');
    $sql="SELECT * FROM users WHERE username='$username' AND password='$pwd'";
    echo $sql;
    $result=mysqli_query($con,$sql);
    //print_r($result);

    if(mysqli_num_rows($result) !=0){
      $_SESSION["usr"]=$username;
      echo "session variable has been set.";

    }else {
      echo "User credentials are not valid.";
    }

    mysqli_close($con);
  }

?>