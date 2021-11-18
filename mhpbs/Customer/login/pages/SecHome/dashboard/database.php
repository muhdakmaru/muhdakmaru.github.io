<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "mhpbs";

// Create connection
$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?>