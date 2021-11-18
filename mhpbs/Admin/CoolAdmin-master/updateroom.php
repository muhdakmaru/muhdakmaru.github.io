<?php
include 'database.php';
$room_number = $_GET['updateroom_number'];

//Show data frm database
$sql="SELECT * FROM rooms where room_number = $room_number";
$result=mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($result);

$name=$row['name'];
$price=$row['price']; 


//update new data 
if(isset($_POST['submit'])){
    $room_number=$_POST['room_number'];
    $name=$_POST['name'];
    $price=$_POST['price'];

    $sql="UPDATE rooms SET room_number=$room_number, name='$name',price='$price' where room_number=$room_number ";
    $result=mysqli_query($connection,$sql);
    
    if($result){
        //echo"update succesfully";
        header('location:viewroom.php');
		exit;
    }else{
        die("Connection failed " . $connection->connect_error);
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
    <title>Update Customer Detail</title>

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
                                    <label>Room Number</label>
                                    <input class="au-input au-input--full" type="text" name="room_number" placeholder="Room Number" value="<?php echo $row['room_number'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Room Type</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Room Type" value="<?php echo $row['name'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="au-input au-input--full" type="text" name="price" placeholder="Price" value="<?php echo $row['price'];?>">
                                </div>

								                <input class="au-btn au-btn--block au-btn--green m-b-20" id="button" type ="submit" name ="submit" value="Update">
                            </form>
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