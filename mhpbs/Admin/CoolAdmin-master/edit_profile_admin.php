<?php
	session_start();
	include 'database.php';

	$id = $_SESSION['id'];

	$sql = "SELECT * FROM admin_users WHERE id = '$id'";
	$result =  mysqli_query($connection,$sql);
	$row=mysqli_fetch_assoc($result);

	$username = $row['username'];
	$email = $row['email'];
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$phone = $row['phone'];

?>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="profile.php">Back</a></li>
            </ol>
          </nav>

          <!-- /Breadcrumb -  -->


			
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							
								<?php 
									if(isset($_SESSION['status']))
									{
										echo "<h4>". $_SESSION['status']. "</h4>";
										unset($_SESSION['status']);
									}
									?>

									<!-- Form with php -->
								<form action="update_admin.php" method="POST">


								<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">id</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input readonly type="text" name="id" class="form-control" value="<?php echo $id?>">
								</div>
							</div>

								<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">First Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="firstname" class="form-control" value="<?php echo $firstname?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Last Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="lastname" class="form-control" value="<?php echo $lastname?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input readonly type="text" name="email" class="form-control" value="<?php echo $email?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone No.</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="phone" class="form-control" value="<?php echo $phone?>">
								</div>
							</div>

							
							
								<!-- Update button-->
                
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<button type="submit" name="update_admin_data" class= "btn-btn">Update</button>			
								</div>							
							</div>
						</div>
					</div>
					</form>
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style>
	body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}