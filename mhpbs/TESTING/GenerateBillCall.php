<?php

  $billcode = $_GET['billcode'];
  $some_data = array(
    'billCode' => $billcode,
    'billpaymentStatus' => ''
  );  

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/getBillTransactions');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);

    //get value from array result
    $result = json_decode($result, true);
    $billpaymentStatus=$result[0]['billpaymentStatus'];
    $billTo=$result[0]['billTo'];
    $billEmail=$result[0]['billEmail'];
    $billPhone=$result[0]['billPhone'];
    $billpaymentAmount=$result[0]['billpaymentAmount'];
    $billpaymentInvoiceNo=$result[0]['billpaymentInvoiceNo'];


    if ($billpaymentStatus==1) {    
      //connect database connection
      $conn = new mysqli("localhost", "clinicarecustomer", "customer", "clinicare"); 
      $query = mysqli_query($conn, "SELECT * FROM customer WHERE email='$billEmail' ");
      $row = mysqli_fetch_array($query);
      $userID = $row['userID'];

      //update database table
      $sql = "INSERT INTO userpayment (transactionID, userID, name, email, phoneNumber, price, status) 
      VALUES ('$billpaymentInvoiceNo', '$userID', '$billTo', '$billEmail', '$billPhone', '$billpaymentAmount', '$billpaymentStatus')";

      //check if sql success
      if ($conn->query($sql) === TRUE) {
        //delete from database table
        $sql2 = "DELETE FROM usercart WHERE userID = '$userID'";
        //check if sql2 success
        if ($conn->query($sql2) === TRUE) {
          header("Location:/MasterCliniCare/Alerts/successPayment.php");
        } else {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
        }    
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    } else if ($billpaymentStatus==3){
        header("Location:/MasterCliniCare/Alerts/unsuccessPayment.php");
    } else {
      echo "pending";
    }
