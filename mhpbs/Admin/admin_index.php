                    <!--ADMIN INDEX PAGE 10% COMPLETED -->
       <!-- AFTER ADMIN LOG IN, THEY WILL BE DIRECTED TO THIS PAGE -->
                        <!-- For FrontEnd Devs-->        
       <!-- 1.NEED TO ADD FEATURES AND DESIGN FOR CUSTOMER TO NAVIGATE IN THE PAGE-->
               <!-- 2. !!!DO NOT DELETE THE PHP CODING!!!-->
              <!-- AKMAL LAST UPDATED ON 9/10/2021 8:30 PM-->            

<?php 
session_start();
?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<h1>ADMIN PAGE WKWKWK</h1> <br>
	<?php echo "Welcome"?> <br>
	<?php echo $_SESSION['user'] ?> <br>
	
	<a href="admin_logout.php">Click here to Log Out</a>
<body>
</body>
</html>