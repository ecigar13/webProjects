<?php
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
    /* check connection */
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    if($year == "*"){
      $yearFilter='1';
    } else $yearFilter="year='$year'";
    if($gender == "*"){
      $genderFilter='1';
    } else $genderFilter="gender='$gender'";

    $sql="SELECT * FROM BabyNames WHERE ".$yearFilter." AND ".$genderFilter." LIMIT 5";
    $result=mysqli_query($con,$sql);

    if($result == FALSE){
      echo "SQL error, turn this on to debug: mysqli_report(MYSQLI_REPORT_ALL);";
    }else if($result->num_rows == 0){
      echo $year." does not have a most common name.<br>";
    }else {
      //convert to json or text.
      foreach($result as $row){
        $arr[] = ['name' =>$row["name"], 'ranking' =>$row["ranking"],'gender' => $row["gender"], 'year' => $row["year"]];
        //echo $row["name"]." ".$row["ranking"]." ".$row["gender"]." ".$row["year"]."<br>";
      }
    }


    mysqli_close($con);
  }
  echo json_encode($arr);

?>