<?php
  ini_set('display_errors', 1);
  session_start();
  $gender=$_POST["gender"];
  $year = $_POST["year"];
  if(!isset($year) || !isset($gender)){
    header('Location: babynames.html');
  }else{
    //Turn this on to debug.
    //mysqli_report(MYSQLI_REPORT_ALL);
    //connect to database
    $con = mysqli_connect("localhost","root","root","HW3");
    
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    if($year != "*" && $gender != "*"){
      $sql = "SELECT * FROM BabyNames WHERE year='".$year."' AND gender='".$gender."' LIMIT 5";
      
      $result = mysqli_query($con, $sql);
      if($result == FALSE){
        echo "SQL error, turn this on to debug: mysqli_report(MYSQLI_REPORT_ALL);";
        exit();
      }

      $arr = array();
      while($row = mysqli_fetch_assoc($result)){
        $arr[] =  $row;
      }
      //convert to json or text.
      echo json_encode($arr);

    } else {
      $sql = "SELECT * FROM BabyNames";
      $r = $con->query("SELECT max(year) as max FROM BabyNames")->fetch_assoc();
      $max = $r['max'];
      $r = $con->query("SELECT min(year) as min FROM BabyNames")->fetch_assoc();
      $min = $r['min'];

      //if year is all year and gender is both
      $arr = array();
      $sqliResult = array();
      if($year == "*" && $gender == "*"){
        for($year = $min; $year <= $max; $year++){
          $sql = "SELECT * FROM BabyNames WHERE year=$year AND gender='m' ORDER BY ranking ASC LIMIT 5";
          if($sql != false){
            $sqliResult[] = $con->query($sql);
          }
          $sql = "SELECT * FROM BabyNames WHERE year=$year AND gender='f' ORDER BY ranking ASC LIMIT 5";
          if($sql != false){
            $sqliResult[] = $con->query($sql);
          }
        }

        foreach ($sqliResult as $y) {
          while($r = mysqli_fetch_assoc($y)){
            $arr[] = $r;
          }
        }
      }
      //if gender is both
      elseif ($gender == "*") {
        $sql = "SELECT * FROM BabyNames WHERE year=$year AND gender='m' ORDER BY ranking ASC LIMIT 5";
        if($sql != false){
          $sqliResult[] = $con->query($sql);
        }
        $sql = "SELECT * FROM BabyNames WHERE year=$year AND gender='f' ORDER BY ranking ASC LIMIT 5";
        if($sql != false){
          $sqliResult[] = $con->query($sql);
        }

        foreach ($sqliResult as $y) {
          while($r = mysqli_fetch_assoc($y)){
            $arr[] = $r;
          }
        }
      } else {  //gender is set but year is not
        for($year = $min; $year <= $max; $year++){
          $sql = "SELECT * FROM BabyNames WHERE year=$year AND gender='$gender' ORDER BY ranking ASC LIMIT 5";
          if($sql != false){
            $sqliResult[] = $con->query($sql);
          }
        }

        foreach ($sqliResult as $y) {
          while($r = mysqli_fetch_assoc($y)){
            $arr[] = $r;
          }
        }
      }
      
      echo json_encode($arr);
    }
    mysqli_close($con);
  }
?>