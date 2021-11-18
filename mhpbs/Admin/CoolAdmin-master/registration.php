<?php
$error = NULL;
$notice = NULL;

// Import PHPMailer classes into the global namespace

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'database.php';

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
	$checkphone = mysqli_query($mysqli, "SELECT * FROM admin_users WHERE phone = '$phone'");
	
	$uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
	
	if(strlen($username) < 5 ){
		$error = "Your username must be at least 5 Characters";	
	}elseif ($password2 != $password){
		$error = "Your password do not match";
	}elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
		$error = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
	}elseif (mysqli_num_rows($checkemail) > 0){
		$error = "This Email Has Already Been Used";
	}elseif (mysqli_num_rows($checkusername) > 0){
		$error = "This Username Has Already Been Used";
	}elseif (mysqli_num_rows($checkphone) > 0 ){
		$error = "This Phone Number Has Already Been Used";
	}elseif ($hotel_id != "A19DW0589"){
		$error = "Please Contact Hotel Office for Hotel ID";
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
	$message = "<p>Please click the link below to verify your account</p>";
	$message .= "<a href='http://localhost/MHPBS/Admin/CoolAdmin-master/admin_verify.php?vkey=$vkey'>";
	$message .= "Verify Account";
	$message .= "</a>";

	send_mail($email, "MHPBS Admin Verify Email Address", $message);
			
			
			
		}else{
			echo $mysqli->error;
		}
		
	} 
}

function send_mail($to, $subject, $message)
{
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'sposenn.dua@gmail.com';                     // SMTP username
	    $mail->Password   = 'Qazwsx123_';                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    $mail->setFrom('sposenn.dua@gmail.com', 'MHPBS');
	    //Recipients
	    $mail->addAddress($to);

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body    = $message;

	    $mail->send();
	    
		header("Location: admin_thankyou.php");
		exit;
		
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <title>Register</title>

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
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="au-input au-input--full" type="text" name="firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="au-input au-input--full" type="text" name="lastname" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>								
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Repeat Password</label>
                                    <input class="au-input au-input--full" type="password" name="password2" placeholder="Re-Enter Password">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="text" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="au-input au-input--full" type="text" name="phone" placeholder="Phone Number">
                                </div>	
                                <div class="form-group">
                                    <label>Hotel ID</label>
                                    <input class="au-input au-input--full" type="text" name="hotel_id" placeholder="Hotel ID">
                                </div>								
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="aggree">Agree the terms and policy
                                    </label>
                                </div>
								<input class="au-btn au-btn--block au-btn--green m-b-20" id="button" type ="submit" name ="submit" value="Register">
                            </form>
							
<?php
 echo $error;
?>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login.php">Sign In</a>
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