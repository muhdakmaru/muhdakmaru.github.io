                                 <!--ADMIN REGISTRATION 100% COMPLETED -->
  <!-- CURRENT DATABASE ARE (ID,FIRSTNAME,LASTNAME,USERNAME,PASSWORD,EMAIL,PHONE,HOTEL_ID,VKEY,VERIFIED,CREATEDATE-->
                                       <!-- For FrontEnd Devs --> 
                 <!-- 1. GUNA CODING AKU AND TEST DEKAT TEMPLATE KORANG UNTUK CHECK -->

                                      <!-- GROUP REMARKS -->    
              <!-- 1. PLESE TELL ME IF YOU GUYS WANT TO ADD MORE DATA INTO ADMIN'S INFORMATION-->
         <!-- 2. JUST ADD DESIGN TO THE REGISTRATION PAGE ( NO NEED TO CHANGE PHP CODING ITS 100% DONE)-->

                             <!-- AKMAL LAST UPDATED ON 9/10/2021 8:30 PM-->


<?php
$error = NULL;

if(isset ($_POST['submit'])){
	
    $mysqli = new MySQLi('localhost','root','','MHPBS');	
	
	//Get form data
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$hotel_id = $_POST['hotel_id'];
	
	$checkemail = mysqli_query($mysqli, "SELECT * FROM admin_users WHERE email = '$email'");
	$checkusername = mysqli_query($mysqli, "SELECT * FROM admin_users WHERE username = '$username'");	
	
	if(strlen($username) < 5 ){
		$error = "Your username must be at least 5 Characters";	
	}elseif ($password2 != $password){
		$error = "Your password do not match";
	}elseif (mysqli_num_rows($checkemail) > 0){
		$error = "This Email Has Already Been Used";
	}elseif (mysqli_num_rows($checkusername) > 0){
		$error = "This Username Has Already Been Used";
	}else{
		//Form Is Valid 
		
		//Connect To Database
		$mysqli = new MySQLi('localhost','root','','MHPBS');
		
		//Sanitize 	form data
		$firstname = $mysqli->real_escape_string($firstname);
		$lastname = $mysqli->real_escape_string($lastname);
		$username = $mysqli->real_escape_string($username);
		$password = $mysqli->real_escape_string($password);
		$password2 = $mysqli->real_escape_string($password2);
		$email = $mysqli->real_escape_string($email);
		$phone = $mysqli->real_escape_string($phone);
		$hotel_id = $mysqli->real_escape_string($hotel_id);
		

		
		//Generate Vkey
		$vkey = md5(time().$username);

		
		//Insert account into database
		$password = md5 ($password);
		$insert = $mysqli->query("INSERT into admin_users(firstname,lastname,username,password,email,phone,hotel_id,vkey) VALUES ( '$firstname','$lastname','$username','$password','$email','$phone','$hotel_id','$vkey')");
		
		if($insert){
			
			//Send Email
			$to = $email;
			$subject = "Email Verification";
			$message = "<a href='http://localhost/MHPBS/Admin/admin_verify.php?vkey=$vkey'>Register Account</a>";
			$headers = "From: muhdakmaru@gmail.com \r\n";	
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
			mail ($to,$subject,$message,$headers);
			
			header ('location:admin_thankyou.php');
	
			
		}else{
			echo $mysqli->error;
		}
    } 
		
} 


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Signup</title>
	<link rel="stylesheet" type="text/css" href="admin_style.css">
	
</head>
<body>     

	<div class="loginbox">
	<img src="../Pictures/Login Customer/signup.png" class="avatar">	
		<h1>Sign Up Here</h1>
	    <form method="POST" action = "">	
			<p>First Name</p>
			<input id="text" type="text" name="firstname" placeholder="Enter First Name" required>			
			<p>Last Name</p>
			<input id="text" type="text" name="lastname" placeholder="Enter Last Name" required>			
			<p>Username</p>
			<input id="text" type="text" name="username" placeholder="Enter Username" required>																		
			<p>Password</p>
			<input id="text" type="password" name="password" placeholder="Enter Password" required>
			<p>Repeat Password</p>
			<input id="text" type="password" name="password2" placeholder="Re-Enter Password" required>	
			<p>Email</p>
			<input id="text" type="text" name="email" placeholder="Enter Email" required>	
			<p>Phone Number</p>
			<input id="text" type="text" name="phone" placeholder="Enter Phone Number" required>
			<p>Hotel ID</p>
			<input id="text" type="text" name="hotel_id" placeholder="Enter Hotel ID" required>			
			
			<input id="button " type ="submit" name ="submit" value="Register">

		</form>
<?php
 echo $error;
?>
		
	</div>
	
</body>
</html>