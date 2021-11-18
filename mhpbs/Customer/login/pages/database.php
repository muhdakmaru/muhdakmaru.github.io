<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "mhpbs";

// Create connection
$con = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>