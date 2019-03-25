<?php
  session_start();
  require_once("BookRouteHandler.php");

  $view = "";
  if(isset($_GET["view"]))
	  $view = $_GET["view"];

  $request_uri = explode('?', $_SERVER['REQUEST_URI'], null);

  //connect to database
  $con = mysqli_connect("localhost","root","root","PW7");
  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  // Route it up!
  switch($request_uri[0]){
    case '/':
      get_root($con);
      break;
    case '/books':
        get_book($con, $request_uri);
        break;
      default:
        echo "Invalid route.";
  }

  function get_root($con){
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
  }

  function get_book($con, $request_uri){
    if(isset($request_uri[1]) && $request_uri[1] == ''){
      get_root($con);
    } elseif($request_uri[1]){
      $sql = "SELECT * FROM Book WHERE Book_id = $request_uri[1]"; //need to join
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

    }

  }


?>