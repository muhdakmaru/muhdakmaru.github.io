<?php

$name=$_POST['custName'];
$email=$_POST['custEmail'];
$phoneNumber=$_POST['custPhone'];
$totalPrice=$_POST['totalPrice'];

$totalPrice=($totalPrice*100);
$some_data = array(
    'userSecretKey'=> '8qr0fm5a-ashs-hkap-yis0-rwlj81wmi2fu',
    'categoryCode'=> '8y8nt1c3',
    'billName'=> 'CliniCare Medicine Checkout',
    'billDescription'=> 'CliniCare Checkout',
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>$totalPrice,
    'billReturnUrl'=>'http://localhost/MasterCliniCare/Customer/Index%20Pages/medicine/GenerateBillCall.php',
    'billCallbackUrl'=>'',
    'billExternalReferenceNo'=>'',
    'billTo'=>$name,
    'billEmail'=>$email,
    'billPhone'=>$phoneNumber,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>0,
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
<!--SEND USER TO TOYYIBPAY PAYMENT-->
<script type="text/javascript">
    //redirect to payment gateway
   window.location.href="https://dev.toyyibpay.com/<?php echo $billcode;?>"; 
 </script>
