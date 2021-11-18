                                           <!-- Admin Verification Coding 100% COMPLETED -->
<!-- NO NEED TO CHANGE ANYTHING SINCE THIS CODE IS FOR CHANGING VERIFIED STATUS IN DATABASE FROM 0 TO 1 AFTER CLICKING A LINK FROM REGISTERED EMAIL-->
                                            <!-- AKMAL LAST UPDATED ON 9/10/2021 8:30 PM-->

<?php
if(isset($_GET['vkey'])){
	//Verification Process
	$vkey = $_GET['vkey'];
	
	$mysqli = new MySQLi('localhost','root','','MHPBS');
	
	$resultSet = $mysqli->query("SELECT verified,vkey FROM admin_users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
	
	if($resultSet->num_rows == 1){
		//Validate The Email 
		$update = $mysqli->query("UPDATE ADMIN_USERS SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
		
		if($update){
			echo "Your account has been verified. You may now log in.";
		}else{
			echo $mysqli->error;	
		}
	}else{
		echo "This account is invalid or already verified";
	}
	
}else{
	die("Something whet wrong");
}

?>

<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>