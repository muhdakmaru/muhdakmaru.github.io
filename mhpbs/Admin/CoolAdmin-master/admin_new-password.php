<?php

$email = $_POST['email'];
$reset_token = $_POST['reset_token'];
$new_password =  $_POST['new_password'];

$connection = new MYSQLi('localhost', 'root', '', 'mhpbs');

$sql = "SELECT * FROM admin_users WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0)
{
	$user = mysqli_fetch_object($result);
	if ($user->reset_token == $reset_token)
	{
		$new_password = md5 ($new_password);
		$sql = "UPDATE admin_users SET reset_token='', password='$new_password' WHERE email='$email'";
		mysqli_query($connection, $sql);

			header("Location: successpassword.php");
		    exit;		
	}
	else
	{
			header("Location: expired.php");
		    exit;	
	}
}
else
{
			header("Location: unsuccessemail.php");
		    exit;	
}
