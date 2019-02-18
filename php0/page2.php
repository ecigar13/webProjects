<?php
session_start();
echo $_POST["username"]." ".$_POST["password"];
$_SESSION["usr"] = $_POST["username"];
?>