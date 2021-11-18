<?php
include 'database.php';

if(isset($_GET['deleteid'])){
    $id =$_GET['deleteid'];

    $sql= "DELETE  FROM users WHERE id = '$id'";
    $result=mysqli_query($connection,$sql);

    //if delete succes
    if($result){
        //Echo "delete succesfull";
        header('location:viewcust.php');

    }else{
        die("Connection failed: " . $connection->connect_error);
        }
    }


?>