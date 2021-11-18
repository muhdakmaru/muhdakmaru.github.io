<?php

//If not login user will be directed to main page
function check_login($connection)
{
	
  if(isset($_SESSION['id']))
  {
	  
	  $id = $_SESSION['id'];
	  $query = "select * from users where user_id = '$id' limit 1";
	   
	  $result = mysqli_query($connection,$query);
	  if($result && mysqli_num_rows($result) > 0)
	  {
		  $user_data = mysqli_fetch_assoc($result);
		  return $user_data;
	  }
  }
	
	//redirect to Log In 
	header("Location:../../../home.php");
	die;
	
}

//Booking ID Random BookingID Generator
     function random_num($length)
{
	
	$text = "";
	if($length < 5)
	{
		$length = 5; 
	}
	
	$len = rand(4,$length);
	
	for ($i=0; $i < $len; $i++) {
		 
		$text .= rand(0,9);
	}
	
	return $text;
}
?>