<?php

session_start();

    include ("database.php");
    include ("functions.php");

    //Enable This Later After Website Finished
    //$user_data = check_login($connection);

    $error = NULL;

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result =  mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);

    $username = $row['username'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $ic = $row['ic'];
    $phone = $row['phone'];
    $address = $row['address'];
    $createdate = $row['createdate'];

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	  //something was posted
	  $firstname = $_POST['firstname'];
	  $lastname = $_POST['lastname'];	  
	  $email    = $_POST['email'];
	  $ic       = $_POST['ic'];
	  $phone     = $_POST['phone'];
	  $address       = $_POST['address'];	
	  $checkin     = $_POST['checkin'];	
	  $checkout     = $_POST['checkout'];
	  $roomtype    = $_POST['roomtype'];
	  $room_number    = $_POST['room_number'];
		  	 
	  if(!empty($checkin) && !empty($checkout) && !is_numeric($username) && !empty($roomtype) && !empty($room_number))
	  {	
		    //save to database
		    $bookingID = random_num(10);
		    $query = "insert into bookings (bookingID,firstname,lastname,email,ic,phone,address,checkin,checkout,roomtype,room_number) values ('$bookingID','$firstname','$lastname','$email','$ic','$phone','$address','$checkin','$checkout','$roomtype','$room_number')";
		  
		  mysqli_query($connection, $query);
		  
		  header("location:index.php"); 
		  die;
		  
		  
	  }else
	  {
		  $error = "Please Enter Your Room Details!!!";
	  }
  }

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Make Booking Customer</title>
  <script>
    function change_date() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "ajax.php?name=" + document.getElementById("Sname").value, false);
      xmlhttp.send(null);
      document.getElementById("room_number").innerHTML = xmlhttp.responseText;
    }
  </script>		
</head>

<body>
              <form action = "paymentgateaway.php" method="POST" role="form text-left">
                <div class="mb-3">
                  <input type="text" name="firstname" class="form-control" placeholder="First Name" aria-label=" First Name" aria-describedby="email-addon" value="<?php echo $firstname?>" readonly>
                </div>
                <div class="mb-3">
                  <input type="text" name="lastname" class="form-control" placeholder="Last Name" aria-label=" Last Name" aria-describedby="email-addon" value="<?php echo $lastname?>" readonly>
                </div>
                <div class="mb-3">					
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="<?php echo $email?>" readonly>
                </div>
                <div class="mb-3">					
                  <input type="text" name="ic" class="form-control" placeholder="Identification Number" aria-label="Email" aria-describedby="email-addon" value="<?php echo $ic?>" readonly>
                </div>				  
                <div class="mb-3">
                  <input type="text" name="phone" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="email-addon" value="<?php echo $phone?>" readonly>
                </div>	
                <div class="mb-3">					
                  <input type="text" name="address" class="form-control" placeholder="Address Line" aria-label="Email" aria-describedby="email-addon" value="<?php echo $address?>" readonly>
                </div>					  
                <div class="mb-3">
                    <label>Choose your preferred Check In date:
                       <input type="date" name="checkin" min="today" >
                    </label>
                </div>		
                <div class="mb-3">
                    <label>Choose your preferred Check Out date:
                       <input type="date" name="checkout" min="today. getDate();">
                    </label>
                </div>	
                  <div class="col-md-3">
                    <label class="labels" style="font-size: 12px">Choose Room Type</label>
                    <select id="Sname" name="roomtype" class="form-control" onchange="change_date()" required>
                      <option value="">Room Type</option>
                      <?php
                      $con = mysqli_connect("localhost", "root", "", "MHPBS");
                      $sql = "SELECT name FROM rooms WHERE status = 0 group by name";
                      $result = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='{$row['name']}'>" . $row['name'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <br>

                  <div class="col-md-12" id="room_number">
                    <label class="labels" style="font-size: 12px">Choose Room Number</label>
                    <select name="room_number" class="form-control" required>
                      <option value="">Room Number</option>
                    </select>
					</div><br>			  
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
					<br>
                <div class="text-center">
					<input id="button" class="btn bg-gradient-dark w-100 my-4 mb-2" type ="submit" name ="submit" value="Make Booking">				
                </div>	
				  
				  <?php  echo $error ?>
              </form>	
	

</body>
</html>