<?php
$error = NULL;
$notice = NULL;

if(isset ($_POST['submit'])){
	
    $mysqli = new MySQLi('localhost','root','','MHPBS');	
	
	//Get form data
	$name = $_POST['name'];
	$room_number = $_POST['room_number'];
	$price = $_POST['price'];

	
	$checkroom_number = mysqli_query($mysqli, "SELECT * FROM rooms WHERE room_number = '$room_number'");
	
	if(mysqli_num_rows($checkroom_number) > 0){
		$error = "This Room Number Has Already Been Registered!";
	}else{
		//Form Is Valid 
		
		//Connect To Database
		$mysqli = new MySQLi('localhost','root','','MHPBS');
		
		//Sanitize 	form data
		$name = $mysqli->real_escape_string($name);
		$room_number = $mysqli->real_escape_string($room_number);
		$price = $mysqli->real_escape_string($price);

		$insert = $mysqli->query("INSERT into rooms(name,room_number,price) VALUES ('$name','$room_number','$price')");
		
		if($insert){
			
			header("Location: index.php");
		    exit;				
		
		}else{
			echo $mysqli->error;
		}
		
	} 
}

?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Room Name</label>
                                    <input class="" type="text" name="name" placeholder="Room Name">
                                </div>
                                <div class="form-group">
                                    <label>Room Number</label>
                                    <input class="" type="text" name="room_number" placeholder="Room Number">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="" type="text" name="price" placeholder="Price">
                                </div>															
								<input class="au-btn au-btn--block au-btn--green m-b-20" id="button" type ="submit" name ="submit" value="Add Room">
                            </form>
							
<?php
 echo $error;
?>