<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "project1";

// Create connection
$connect=mysqli_connect($server,$username,$password,$db);

// Check connection
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected with databse  successfully";
?>