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
		//Process Loginaa
		$row = $resultSet->fetch_assoc();
		$verified = $row['verified'];
        $id = $row['id'];
		$email = $row['email'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$phone = $row['phone'];
		$createdate = $row['createdate'];
		$date = $row['createdate'];
		$date = strtotime($date);
		$date = date('M d Y',$date);;
		
		
		if($verified == 1){
			//Continue Processing
			echo "Your account was verified and you have been logged in";
			
			$_SESSION['loggedin'] = TRUE;
            $_SESSION['id'] = $id;
			$_SESSION['username'] = $username;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['email'] = $email;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['phone'] = $phone;
			$_SESSION['createdate'] = $createdate;
			
			header ('location:index.php');
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
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/admindashboard1.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="admin_forgot.php">Forgotten Password?</a>
                                    </label>
                                </div>
											<input class="au-btn au-btn--block au-btn--green m-b-20" type ="submit" name = "submit" value="Sign In">
                            </form>
                            <div class="register-link">
                                <p>
									<?php  echo $error  ?><br><br>
                                    Don't Have An Account?
                                    <a href="registration.php">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->