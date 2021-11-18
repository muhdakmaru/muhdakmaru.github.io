<!DOCTYPE html>
<html>
<head>
<title>Rooms</title>
<?php
include 'database.php';
	session_start();
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
    <title>Forms</title>

    <!-- Fontfaces CSS-->		
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
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
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index.php">
                    <img src="images/icon/admindashboard.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list"></ul>
                        </li>
                        <li class="active">
                            <a href="viewcust.php">
                                <i class="far fa-check-square"></i>Customer</a>
                        </li>
                        <li>
                            <a href="addroom.php">
                                <i class="fas fa-calendar-alt"></i>Add Rooms</a>
                        </li>
                        <li>
                            <a href="viewroom.php">
                                <i class="fas fa-calendar-alt"></i>View Rooms</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['username'] ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['firstname'] ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['email'] ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="profile.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="../../Customer/home.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <link rel="stylesheet" href="table.css">
								<h3>Pending Bookings</h3>
                                    <table class="content-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Booking ID</th>
												<th scope="col">Payment ID</th>
												<th scope="col">Name</th>
												<th scope="col">Email</th>
												<th scope="col">Checkin</th>
												<th scope="col">Checkout</th>
												<th scope="col">Room Type</th>
												<th scope="col">Status</th>
												<th scope="col">Actions</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "MHPBS");
                                                // Check connection
                                                if ($conn->connect_error) 
                                                {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = "SELECT bookingID, paymentID, lastname, email, checkin, checkout, roomtype, status  FROM bookings WHERE status = '0'";
                                                $result = $conn->query($sql);
																								
                                                if ($result->num_rows > 0)  
                                                {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['bookingID'] .  "</td>";
													echo "<td>" . $row['paymentID'] .  "</td>";
													echo "<td>" . $row['lastname'] .  "</td>";	
													echo "<td>" . $row['email'] .  "</td>";
													echo "<td>" . $row['checkin'] . "</td>";
													echo "<td>" . $row['checkout'] . "</td>";	
													echo "<td>" . $row['roomtype'] . "</td>";		
																			 									
	                                            if ($row['status']  == 0) {
											        echo "<td style='color:#FFB900'>Pending</td>";
                                                } elseif ($row['status']  == 1) { 
                                                    echo "<td style='color:#00D100'>Accepted</td>";
                                                } elseif ($row['status']  == 2){
													echo "<td style='color:#D10000'>Rejected</td>";
												} elseif ($row['status']  == 3){
													echo "<td style='color:#6495ED'>Finished</td>";
												} else {
													echo "ERROR 404";
												}
													
												$bookingID = $row['bookingID'];		
														
                    echo '<td><form action="functions2.php" method="POST">';

                    echo '<input type="hidden" name="appToAccept" 
												value="' . $bookingID . '" >';
                    echo '<button type="submit" value="Accept Booking" 
												name="acceptBooking" class="btn btn-icon btn-success">
												<h7>Accept<h7></button>';	
														
                    echo '&nbsp;&nbsp;<input type="hidden" name="appToReject" 
												value="' . $bookingID  . '" >';
                    echo '<button type="submit" value="Reject Booking" 
												name="rejectBooking" class="btn btn-icon btn-danger">
												<h7>Reject<h7></button>';
                    echo '</form></td>';
														
  
														
	
												
													
														
																											
														
                                                }
                                                echo "</table>";
                                                } 
                                                else 
                                                { 
                                                    echo "0 results"; 	
                                                }
                                                    $conn->close();									
                                            ?>
											
                                        </tbody>
                                    </table>
								 <br>
								 <h3>Accepted Bookings</h3>
                                    <table class="content-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Booking ID</th>
												<th scope="col">Payment ID</th>
												<th scope="col">Name</th>
												<th scope="col">Email</th>
												<th scope="col">Checkin</th>
												<th scope="col">Checkout</th>
												<th scope="col">Room Type</th>
												<th scope="col">Status</th>
												<th scope="col">Actions</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "MHPBS");
                                                // Check connection
                                                if ($conn->connect_error) 
                                                {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = "SELECT bookingID, paymentID, lastname, email, checkin, checkout, roomtype, status  FROM bookings WHERE status = '1'";
                                                $result = $conn->query($sql);
																								
                                                if ($result->num_rows > 0)  
                                                {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['bookingID'] .  "</td>";
													echo "<td>" . $row['paymentID'] .  "</td>";
													echo "<td>" . $row['lastname'] .  "</td>";	
													echo "<td>" . $row['email'] .  "</td>";
													echo "<td>" . $row['checkin'] . "</td>";
													echo "<td>" . $row['checkout'] . "</td>";	
													echo "<td>" . $row['roomtype'] . "</td>";		
																			 									
																				if ($row['status']  == 0) {
																					echo "<td style='color:#FFB900'>Pending</td>";
																				} elseif ($row['status']  == 1) { 
																					echo "<td style='color:#00D100'>Accepted</td>";
																				} elseif ($row['status']  == 2){
																					echo "<td style='color:#D10000'>Rejected</td>";
																				} elseif ($row['status']  == 3){
																					echo "<td style='color:#6495ED'>Finished</td>";
																				} else {
																					echo "ERROR 404";
																				}
													
												$bookingID = $row['bookingID'];		
														
                    echo '<td><form action="functions2.php" method="POST">';

                    echo '<input type="hidden" name="appToFinish" 
												value="' . $bookingID . '" >';
                    echo '<button type="submit" value="Finish Booking" 
												name="finishBooking" class="btn btn-icon btn-success">
												<h7>Finish<h7></button>';	
														
                    echo '</form></td>';
																					
														
  
														
	
												
													
														
																											
														
                                                }
                                                echo "</table>";
                                                } 
                                                else 
                                                { 
                                                    echo "0 results"; 	
                                                }
                                                    $conn->close();									
                                            ?>
											
                                        </tbody>
                                    </table>

								 <br>
								 <h3>Rejected Bookings</h3> 
                                    <table class="content-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Booking ID</th>
												<th scope="col">Payment ID</th>
												<th scope="col">Name</th>
												<th scope="col">Email</th>
												<th scope="col">Checkin</th>
												<th scope="col">Checkout</th>
												<th scope="col">Room Type</th>
												<th scope="col">Status</th>
												<th scope="col">Actions</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "MHPBS");
                                                // Check connection
                                                if ($conn->connect_error) 
                                                {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = "SELECT bookingID, paymentID, lastname, email, checkin, checkout, roomtype, status FROM bookings WHERE status = '2'";
                                                $result = $conn->query($sql);
																								
                                                if ($result->num_rows > 0)  
                                                {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['bookingID'] .  "</td>";
													echo "<td>" . $row['paymentID'] .  "</td>";
													echo "<td>" . $row['lastname'] .  "</td>";
													echo "<td>" . $row['email'] .  "</td>";
													echo "<td>" . $row['checkin'] . "</td>";
													echo "<td>" . $row['checkout'] . "</td>";	
													echo "<td>" . $row['roomtype'] . "</td>";		
																			 									
	                                            if ($row['status']  == 0) {
											        echo "<td style='color:#FFB900'>Pending</td>";
                                                } elseif ($row['status']  == 1) { 
                                                    echo "<td style='color:#00D100'>Accepted</td>";
                                                } elseif ($row['status']  == 2){
													echo "<td style='color:#D10000'>Rejected</td>";
												} elseif ($row['status']  == 3){
													echo "<td style='color:#6495ED'>Finished</td>";
												} else {
													echo "ERROR 404";
												}
													
														
												$bookingID = $row['bookingID'];		
														
                    echo '<td><form action="functions2.php" method="POST">';
														
					echo '<input type="hidden" value="' . $bookingID . '" name="appToDelete">';		
                    echo '<input type="submit" class="btn btn-danger" name="deleteBooking" value="Delete">';					          
														
                    echo '</form></td>';
														
																																							
																																											
														
                                                }
                                                echo "</table>";
                                                } 
                                                else 
                                                { 
                                                    echo "0 results"; 	
                                                }
                                                    $conn->close();									
                                            ?>
											
                                        </tbody>
                                    </table>

								
								 <br>
								 <h3>Finished Bookings</h3>	
								
                                    <table class="content-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Booking ID</th>
												<th scope="col">Payment ID</th>
												<th scope="col">Name</th>
												<th scope="col">Email</th>
												<th scope="col">Checkin</th>
												<th scope="col">Checkout</th>
												<th scope="col">Room Type</th>
												<th scope="col">Status</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "MHPBS");
                                                // Check connection
                                                if ($conn->connect_error) 
                                                {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                                                $sql = "SELECT bookingID, paymentID, lastname, email, checkin, checkout, roomtype, status FROM bookings WHERE status = '3'";
                                                $result = $conn->query($sql);
																								
                                                if ($result->num_rows > 0)  
                                                {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['bookingID'] .  "</td>";
													echo "<td>" . $row['paymentID'] .  "</td>";
													echo "<td>" . $row['lastname'] .  "</td>";	
													echo "<td>" . $row['email'] .  "</td>";
													echo "<td>" . $row['checkin'] . "</td>";
													echo "<td>" . $row['checkout'] . "</td>";	
													echo "<td>" . $row['roomtype'] . "</td>";		
																			 									
	                                            if ($row['status']  == 0) {
											        echo "<td style='color:#FFB900'>Pending</td>";
                                                } elseif ($row['status']  == 1) { 
                                                    echo "<td style='color:#00D100'>Accepted</td>";
                                                } elseif ($row['status']  == 2){
													echo "<td style='color:#D10000'>Rejected</td>";
												} elseif ($row['status']  == 3){
													echo "<td style='color:#6495ED'>Finished</td>";
												} else {
													echo "ERROR 404";
												}
													
												$bookingID = $row['bookingID'];		
													
                                                }
                                                echo "</table>";
                                                } 
                                                else 
                                                { 
                                                    echo "0 results"; 	
                                                }
                                                    $conn->close();									
                                            ?>
											
                                        </tbody>
                                    </table>
								
                                </link>
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