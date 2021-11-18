<?php	
session_start();

  $billcode = $_GET['billcode'];
  $some_data = array(
    'billCode' => $billcode,
    'billpaymentStatus' => '',
  );  

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);

    $result = json_decode($result, true);
    $billpaymentStatus=$result[0]['billpaymentStatus'];
    $billTo=$result[0]['billTo'];
    $billEmail=$result[0]['billEmail'];
    $billPhone=$result[0]['billPhone'];
    $billpaymentAmount=$result[0]['billpaymentAmount'];
    $billpaymentInvoiceNo=$result[0]['billpaymentInvoiceNo'];
    $billName=$result[0]['billName'];
    $billDescription=$result[0]['billDescription'];
    $billSplitPaymentArgs=$result[0]['billSplitPaymentArgs'];

    include ("database.php");

    //Enable This Later After Website Finished
    //$user_data = check_login($connection);

    $error = NULL;

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result =  mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);

  if($billpaymentStatus == 1)
  {
	  //something was posted
	  $lastname = $_POST['lastname'];	  
	  $email    = $_POST['email'];
	  $phone     = $_POST['phone'];	
	  $checkin     = $_POST['checkin'];	
	  $checkout     = $_POST['checkout'];
	  $roomtype    = $_POST['roomtype'];
		  	 
	  
		    //save to database
		    $bookingID = random_num(10);
		    $query = "insert into bookings (bookingID,paymentID,lastname,email,phone,checkin,checkout,roomtype) values ('$bookingID','$billpaymentInvoiceNo','$billTo','$billEmail','$billPhone','$billName','$billDescription','$billSplitPaymentArgs')";
		  
		  mysqli_query($connection, $query);
		  
		  header("location:bookinghistory.php"); 
		  die;
		  
		  
	  }elseif($billpaymentStatus == 3){
	   echo "MANTAP";
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