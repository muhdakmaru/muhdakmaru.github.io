<?php
session_start();
require_once 'database.php';
if(isset($_POST['upload_image_admin'])){

        //insert image into database and uploads folder
        move_uploaded_file($_FILES['image_admin']['tmp_name'],"uploads/".$_FILES['image_admin']['name']);
        $connection = mysqli_connect("localhost","root","","mhpbs");

        if(!$connection){
          echo mysqli_error();
        }else{
            $id = $_SESSION['id'];
          $sql = mysqli_query($connection,"UPDATE admin_users SET image_admin = '".$_FILES['image_admin']['name']."' WHERE id = '".$id."'");
          echo "<script>
                  
                  window.location.href='profile.php';
                  </script>";
        }

}

?>
