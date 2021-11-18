<?php
session_start();
require_once 'database.php';
if(isset($_POST['upload_image_customer'])){

        //insert image into database and uploads folder
        move_uploaded_file($_FILES['image_customer']['tmp_name'],"uploads/".$_FILES['image_customer']['name']);
        $connection = mysqli_connect("localhost","root","","mhpbs");

        if(!$connection){
          echo mysqli_error();
        }else{
        $id = $_SESSION['id'];
        $sql = mysqli_query($connection,"UPDATE users SET image_customer = '".$_FILES['image_customer']['name']."' WHERE id = '".$id."'");
          
        header("location: profile.php");
                  
        }

}

?>