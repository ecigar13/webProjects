<?php
session_start();
require_once("BookRouteHandler.php");

$view = "";
if (isset($_GET["view"])) $view = $_GET["view"];

$request_uri = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($request_uri);

  //connect to database
$con = mysqli_connect("localhost", "root", "root", "HW4");
/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

// Route it up!
switch ($request_uri[1]) {
	case '':
		get_root($con);
		break;

	case 'books':
		get_book($con, $request_uri);
		break;

	default:
		echo "Invalid route.";
}

function get_root($con)
{
	$sql = "SELECT * FROM Book";
    //echo $sql."<br>";

	$result = mysqli_query($con, $sql);
	$rows = array();

	if ($result == FALSE) {
		echo "SQL error, turn this on to debug: mysqli_report(MYSQLI_REPORT_ALL);";
	} else {
		foreach ($result as $row) {
			$rows[] = $row;
		}
		print json_encode($rows);
	}
}

function get_book($con, $request_uri)
{
	if ($request_uri[2]) {
		$sql = "SELECT Book.Book_id, Title, Year, Price, Category, GROUP_CONCAT(Authors.Author_Name) AS Author FROM Book 
    INNER JOIN Book_Authors ON Book.Book_id = Book_Authors.Book_id 
    INNER JOIN Authors ON Book_Authors.Author_id = Authors.Author_id 
    WHERE Book.Book_id = $request_uri[2]
    GROUP BY Book.Book_id";
	} else {
		$sql = "SELECT Book.Book_id, Title, Year, Price, Category, GROUP_CONCAT(Authors.Author_Name) AS Author FROM Book 
    INNER JOIN Book_Authors ON Book.Book_id = Book_Authors.Book_id 
    INNER JOIN Authors ON Book_Authors.Author_id = Authors.Author_id
    GROUP BY Book.Book_id";
	}

	$result = mysqli_query($con, $sql);
	$rows = array();

	if ($result == FALSE) {
		echo "SQL error, turn this on to debug: mysqli_report(MYSQLI_REPORT_ALL);";
	} else if(mysqli_num_rows($result) == 0){
    echo "No result";
  } else {
		foreach ($result as $row) {
			$rows[] = $row;
		}
		print json_encode($rows);
	}
}
mysqli_close($con);

?>