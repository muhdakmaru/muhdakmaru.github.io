<?php
session_start();

$error = NULL;

if(isset($_POST['submit'])){
	//Connect to the Database
	$username = $_POST ['username'];
	$password = $_POST ['password'];	
	
	$mysqli = new MySQLi('localhost','root','','MHPBS');
	
	//Get form data
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$password = md5 ($password);
	
	//Query the database
	$resultSet = $mysqli->query("SELECT * FROM admin_users WHERE username = '$username' AND password = '$password' LIMIT 1");
	
	if($resultSet->num_rows !=0){
		//Process Login
		$row = $resultSet->fetch_assoc();
		$verified = $row['verified'];
		$email = $row['email'];
		$date = $row['createdate'];
		$date = strtotime($date);
		$date = date('M d Y',$date);
		
		
		if($verified == 1){
			//Continue Processing
			echo "Your account was verified and you have been logged in";
			
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['user'] = $username;	
			
			header ('location:admin_index.php');
			die;
		}else{
			$error = "This account has not yet been verified. An email was sent to $email on $date";	
		}
	}else{
		//Invalid Credentials
		$error = "The Username Or Password you entered is incorect";
	}
	
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="admin_style.css">
	
</head>
<body>																							
	<div id="frm">
	<div class="loginbox">
	<img src="../Pictures/Login Customer/avatar.jpg" class="avatar">	
		<h1>Admin Login</h1>
	    <form method="post">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username" required>																								
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password" required>
			<br>
			<input type ="submit" name = "submit" value="Login">
			<?php  echo $error  ?>
			
			<a href="admin_registration.php"><b>Sign Up Admin Account</b></a>
		</form>

		<a href="admin_forgot.php">Forgot Password?</a>

		
	</div>
	</div>
	
</body>
</html>