<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
    $query = "INSERT INTO toy(username, email, text) VALUES('".$_POST["username"]."','".$_POST["email"]."','".$_POST["text"]."')";
        $result = $db_handle->executeQuery($query);
    if(!$result){
			$message="Problem in Adding to database. Please Retry.";
	} else {
		  echo "<script>alert('Successfully Added'); window.location = 'index.php';</script>";
		// header("Location:index.php");
	}
}
?>
<html>
	<head>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>


		
			<nav class="navbar navbar-expand-lg navbar-light bg-primary">
			 <a class="navbar-brand" href="index.php">List Tasks</a>
			 
			  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="nav navbar-nav ml-auto">
			      <li class="nav-item active">
			      	<?php

			      	?>
			        <a class="nav-link" href="login.php" style="color: white">Profile</a>
			      </li>
			    </ul>
			</div>
			</nav>
			<div class="container">
				<br>
				<br>

			<div class="row">
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-8">
					<h3>Add new Test</h3>
					<hr>
					<form name="frmToy" method="post" action="" id="frmToy" >
					  <div class="form-group">
					    <label for="username">UserName:</label>
					    <input type="text" class="form-control" placeholder="Enter username" id="username" name="username" required>
					  </div>
					  <div class="form-group">
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" placeholder="Enter Email" id="email"  name="email" required>
					  </div>
					  <div class="form-group">
					    <label for="text">Text:</label>
					    <input type="text" class="form-control" placeholder="Enter text" id="text" name="text" required>
					  </div>
				     <input type="submit" name="submit" id="btnAddAction" value="Add"  class="btn btn-primary" />
				    </form>
				</div>
				<div class="col-sm-2">
					
				</div>	
			</div>
			
		</div>

	</body>
</html>



