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
	$resultSet = $mysqli->query("SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");
	
	if($resultSet->num_rows !=0){
		//Process Login
		$row = $resultSet->fetch_assoc();
        $id = $row['id'];
		$verified = $row['verified'];
		$email = $row['email'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$phone = $row['phone'];
		$createdate = $row['createdate'];
		$date = $row['createdate'];
		$date = strtotime($date);
		$date = date('M d Y',$date);
		
		
		if($verified == 1){
			//Continue Processing
			echo "Your account was verified and you have been logged in";
			
			
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['email'] = $email;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['phone'] = $phone;
			$_SESSION['createdate'] = $createdate;
			
			header ("location:SecHome/index.php");
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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Marriot Hotel | Best Hotel In Putrajaya
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

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-40 end-0 mx-40">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../../home.php">
              Home
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome Back</h3>
                  <p class="mb-0">Enter Your Username & Password To Sign In</p>
                </div>
                <div class="card-body">
                  <form method="POST" action = "" role="form">
                    <label>Username</label>
                    <div class="mb-3">
                      <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
<div class="text-center">				
<?php
 echo $error;
?>	
 </div>							
                    </div>
                    <div class="text-center">
					 <input id="button " type ="submit" name ="submit" value="Login" class="btn bg-gradient-info w-100 mt-4 mb-0">	
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Forgot your password?
                    <a href="forgot.php" class="text-info text-gradient font-weight-bold">Reset Password</a>
                  </p>					
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="registration.php" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  
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