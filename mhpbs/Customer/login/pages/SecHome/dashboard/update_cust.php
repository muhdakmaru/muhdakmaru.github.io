<?php
session_start();
include 'database.php';
$connection=mysqli_connect("localhost","root","","mhpbs");

if(isset($_POST['update_cust_data']))
{
    $id=$_POST['id'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
	$ic=$_POST['ic'];
    $phone=$_POST['phone'];
	$address=$_POST['address'];

    $query = "UPDATE users SET firstname ='$firstname', lastname='$lastname', email='$email', ic ='$ic', phone='$phone', address='$address' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data updated";
        header("location: profile.php");
		exit;

    }
    else
    {
        $_SESSION['status'] = "not updated";
        header("location: profile.php");
		exit;
    }
}