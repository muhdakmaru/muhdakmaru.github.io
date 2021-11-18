<?php

    include ("database.php");
    include ("functions.php");

	  $firstname = $_POST['firstname'];
	  $lastname = $_POST['lastname'];	  
	  $email    = $_POST['email'];
	  $ic       = $_POST['ic'];
	  $phone     = $_POST['phone'];
	  $address       = $_POST['address'];	
	  $checkin     = $_POST['checkin'];	
	  $checkout     = $_POST['checkout'];
	  $roomtype    = $_POST['roomtype'];


// Create connection
$dbconnect=mysqli_connect('localhost','root','','mhpbs');

$bookingID = random_num(10);

$sql = "INSERT INTO bookings (bookingID,firstname,lastname,email,ic,phone,address,checkin,checkout,roomtype) VALUES ('$bookingID','$firstname','$lastname','$email','$ic','$phone','$address','$checkin','$checkout','$roomtype')";

$qry =mysqli_query($dbconnect,$sql);

echo $sql;


if($qry){
	echo '<script>alert("Booking Was Successful")</script>';
	header("Location: bookinghistory.php");
	
}
else{
	echo"Failed to insert";
}
	
?>