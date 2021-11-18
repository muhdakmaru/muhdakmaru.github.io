<?php
session_start();
include 'database.php';
$connection=mysqli_connect("localhost","root","","mhpbs");

if(isset($_POST['update_admin_data']))
{
    $id=$_POST['id'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
  


    $query = "UPDATE admin_users SET firstname ='$firstname', lastname='$lastname', email='$email', phone='$phone' WHERE id='$id'";
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