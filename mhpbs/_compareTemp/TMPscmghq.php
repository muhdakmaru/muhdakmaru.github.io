<?php	
session_start();
$billcode = $_GET['billcode'];
  $some_data = array(
    'billCode' => $billcode,
    'billpaymentStatus' => '1'
  );  

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);

  $result = json_decode($result, true);     $billpaymentStatus=$result[0]['billpaymentStatus'];

    if ($billpaymentStatus==1) {    
      //connect database connection
      $conn = new mysqli("localhost", "root", "", "mhpbs"); 
      $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id' ");
      $row = mysqli_fetch_array($query);
      $id = $row['id'];

      //update database table
      $sql = "INSERT INTO bookings (bookingID,firstname,lastname,email,ic,phone,address,checkin,checkout,roomtype,room_number) 
      VALUES ('$bookingID','$firstname','$lastname','$email','$ic','$phone','$address','$checkin','$checkout','$roomtype','$room_number')";

      //check if sql success
      if ($conn->query($sql) === TRUE) {
        header("Location:bookinghistory.php"); 
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    } else if ($billpaymentStatus==3){
        header("Location:/MasterCliniCare/Alerts/unsuccessPayment.php");
    } else {
      echo "pending";
    }


  
?>

<?php
     function random_num($length)
{
	
	$text = "";
	if($length < 5)
	{
		$length = 5; 
	}
	
	$len = rand(4,$length);
	
	for ($i=0; $i < $len; $i++) {
		 
		$text .= rand(0,9);
	}
	
	return $text;
}
?>