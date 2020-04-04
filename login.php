<?php
session_start();

if(!empty($_POST["submit"])) {
    if($_POST["email"] === "admin" && $_POST["pass"] === "123")
    {
    	$_SESSION['user'] = $_POST["email"];
    	header("Location:index.php");
    }
    else
    {
    	echo "<script>alert('Wrong credentials');</script>";
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
					<h3>Login For Admin</h3>
					<hr>
					<form name="frmToy" method="post" action="" id="frmToy" >
					  <div class="form-group">
					    <label for="email">Username:</label>
					    <input type="text" class="form-control" placeholder="Enter Email" id="email"  name="email" required>
					  </div>
					  <div class="form-group">
					    <label for="pass">Text:</label>
					    <input type="password" class="form-control" placeholder="Enter password" id="pass" name="pass" required>
					  </div>
				     <input type="submit" name="submit" id="btnAddAction" value="Login"  class="btn btn-primary" />
				    </form>
				</div>
				<div class="col-sm-2">
					
				</div>	
			</div>
			
		</div>

	</body>
</html>



