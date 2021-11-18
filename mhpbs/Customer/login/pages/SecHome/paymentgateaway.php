<?php
	  $lastname = $_POST['lastname'];	  
	  $email    = $_POST['email'];
	  $ic       = $_POST['ic'];
	  $phone     = $_POST['phone'];	
	  $checkin     = $_POST['checkin'];	
	  $checkout     = $_POST['checkout'];
	  $roomtype    = $_POST['roomtype'];




  $some_data = array(
    'userSecretKey'=>'izdu7g06-a3kq-nzzn-qyno-hzroc7ovdxpw',
    'categoryCode'=>'2xqmmf66',
    'billName'=>$checkin,
    'billDescription'=>$checkout,
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>25000,
    'billReturnUrl'=>'http://localhost/MHPBS/Customer/login/pages/SecHome/generatebill.php',
    'billCallbackUrl'=>'',
    'billExternalReferenceNo' => 'AFR341DFI',
    'billTo'=>$lastname,
    'billEmail'=>$email,
    'billPhone'=>$phone,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>$roomtype,
    'billPaymentChannel'=>'0',
    'billContentEmail'=>'Thank you for making booking with us!',
    'billChargeToCustomer'=>0,
  );  

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  $obj = json_decode($result,true);
  $billcode=$obj[0]['BillCode'];

?>

<script type="text/javascript">    window.location.href="https://dev.toyyibpay.com/<?php echo $billcode;?>";   </script>