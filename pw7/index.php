<?php
  session_start();

  $request_uri = explode('?', $_SERVER['REQUEST_URI'], null);

  // Route it up!
  if ($request_uri[0] == '/' || $request_uri[0] == '/books') {
    //connect to database
  $con = mysqli_connect("localhost","root","root","PW7");
  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

    $sql = "SELECT * FROM Book";
    //echo $sql."<br>";

    $result=mysqli_query($con,$sql);
    //var_dump($result);
    $rows = array();

    if($result == FALSE){
      echo "SQL error, turn this on to debug: mysqli_report(MYSQLI_REPORT_ALL);";
    }else {
      foreach($result as $row){
        $rows[]= $row;
      }
      print json_encode($rows);
    }

    mysqli_close($con);
  }else{
    echo "Invalid route.";
  }



?>