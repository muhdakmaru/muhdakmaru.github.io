<?php
$conn = mysqli_connect("localhost", "root", "", "MHPBS");

error_reporting(0);

$room_number = $_GET['rn'];

$query = "DELETE FROM rooms WHERE room_number = '$room_number'";

$data  = mysqli_query($conn,$query);

if ($data){
	
	echo "Succesfully Deleted";
}else{
	echo " Failed to Delete";
}
?>