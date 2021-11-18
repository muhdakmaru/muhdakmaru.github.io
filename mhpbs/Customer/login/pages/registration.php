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
	$ic = $_POST['ic'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
	$checkemail = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$email'");
	$checkusername = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");	
	$checkphone = mysqli_query($mysqli, "SELECT * FROM users WHERE phone = '$phone'");
	$checkic = mysqli_query($mysqli, "SELECT * FROM users WHERE ic = '$ic'");
	
	$uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
	
	if(strlen($username) < 5 ){
		$error = "Your username must be at least 5 Characters";	
	}elseif ($password2 != $password){
		$error = "Your password do not match";
	}elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
		$error = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
	}elseif (mysqli_num_rows($checkemail) > 0){
		$error = "This Email Has Already Been Used";
	}elseif (mysqli_num_rows($checkusername) > 0) {
		$error = "This Username Has Already Been Used";
	}elseif (mysqli_num_rows($checkphone) > 0 ){
		$error = "This Phone Number Has Already Been Used";
	}elseif (mysqli_num_rows($checkic) > 0 ){
		$error = "This Identification Number Has Already Been Used";
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
		

		
		//Generate Vkey
		$vkey = md5(time().$username);

		
		//Insert account into database
		$password = md5 ($password);
		$insert = $mysqli->query("INSERT into users(firstname,lastname,username,password,email,ic,phone,address,vkey) VALUES ( '$firstname','$lastname','$username','$password','$email','$ic','$phone','$address','$vkey')");
		
		if($insert){
			
			//Send Email
	$message = "<p>Please click the link below to verify your account</p>";
	$message .= "<a href='http://localhost/MHPBS/Customer/login/pages/verify.php?vkey=$vkey'>";
	$message .= "Verify Account";
	$message .= "</a>";

	send_mail($email, "MHPBS Verify Account", $message);
			
			
			
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
	    
		header("Location: thankyou.php");
		exit;
		
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Hotel Guest Registration
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <!-- Navbar -->
  
  <!-- End Navbar -->
  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome, Honored Guest</h1>
            <p class="text-lead text-white">Please Enter Your Credentials To Register As An Official Customer of Marriot Putrajaya Hotel</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              
            <div class="card-body">
              <form method="POST" action = "" role="form text-left">
                <div class="mb-3">
                  <input type="text" name="firstname" class="form-control" placeholder="First Name" aria-label=" First Name" aria-describedby="email-addon">
                </div>
                <div class="mb-3">
                  <input type="text" name="lastname" class="form-control" placeholder="Last Name" aria-label=" Last Name" aria-describedby="email-addon">
                </div>
                <div class="mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="email-addon">
                </div>
                <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                </div>
                <div class="mb-3">
                  <input type="password" name="password2" class="form-control" placeholder="Re-Enter Password" aria-label="Password" aria-describedby="password-addon">
                </div>
                <div class="mb-3">					
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                </div>
                <div class="mb-3">					
                  <input type="text" name="ic" class="form-control" placeholder="Identification Number" aria-label="Identification Number" aria-describedby="email-addon">
                </div>				  
                <div class="mb-3">
                  <input type="text" name="phone" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="email-addon">
                </div>	
                <div class="mb-3">					
                  <input type="text" name="address" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="email-addon">
                </div>					  
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
                <div class="text-center">
					<input id="button" class="btn bg-gradient-dark w-100 my-4 mb-2" type ="submit" name ="submit" value="Register">				
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login.php" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
				<br>
<div class="text-center">				
<?php
 echo $error;
?>	
 </div>	
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by Creative Tim.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>