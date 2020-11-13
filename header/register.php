<?php

	include "../db_connection.php";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'C:/Users/LORENA/vendor/phpmailer/phpmailer/src/Exception.php';
	require 'C:/Users/LORENA/vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'C:/Users/LORENA/vendor/phpmailer/phpmailer/src/SMTP.php';

	$register_err = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		$first_name = $_POST['First_Name'];
		$last_name = $_POST['Last_Name'];
		$password = $_POST['Password'];
		$email= $_POST['Email'];
		$role= "Operator";

		$connection = mysqli_connect($db_hostname, $db_username, $db_password);
		if(!$connection) {
			echo"Database Connection Error...".mysqli_connect_error();
		} else {
			$sql = "SELECT * FROM $database.Users";
			$retval = mysqli_query($connection, $sql);
			if($retval){
				if(mysqli_num_rows($retval) == 0){
					//nu exista user inregistrat in BD
					//primul user va fi mereu admin
					$role = 'Admin';
				}
			}

			$sql= "SELECT * FROM $database.Users WHERE email= '$email'";
			$retval= mysqli_query($connection, $sql);
			if(! $retval ) {
				echo"Error access in table Users ".mysqli_error($connection);
			}
			
			if (mysqli_num_rows($retval) == 0) {
				$sql= "INSERT INTO $database.Users (first_name,last_name,email,password,role) ".
				"VALUES ('$first_name','$last_name','$email','$password','$role')";
				$retval= mysqli_query($connection, $sql);
				if(!$retval ) {
					echo "Error access in table Users ".mysqli_error($connection);
				} else {
					header("location: http://localhost/TehnologiiWeb/header/login.php");
					
				}
			} else {
				$register_err = "User already exists";
			}
		}
		mysqli_close($connection);
	}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="register.css">
	<script type="text/javascript" src="register.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav style="background: #f8f8f8" class="navbar navbar-default navbar-expand-xl navbar-light">
		<div class="navbar-header d-flex col">
			<a class="navbar-brand" href="#"><i class="fa fa-cube"></i>Task<b>Board</b></a>  		
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
				<span class="navbar-toggler-icon"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
</nav>
	<div class="signup-form">
		<form method="post" class="needs-validation" action="" novalidate>
		<h2 class="text-center">Sign Up</h2>
			<!-- First name -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="firstnamePrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="First_Name" placeholder="First name..."
						id="username" aria-describedby="firstnamePrepend" minlength="3" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The minimum length of First name must be 3!
      				</div>
				</div>
			</div>
			<!-- Last name -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="lastnamePrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="Last_Name" placeholder="Last name..."
						id="username" aria-describedby="lastnamePrepend" minlength="3" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The minimum length of Last name must be 3!
      				</div>
				</div>
			</div>
			<!-- Email address -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="emailPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-user"></i></span>
        			</div>
					<input type="text" class="form-control" name="Email" placeholder="Email.."
						id="username" aria-describedby="emailPrepend" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				Please enter a proper email address!
      				</div>
				</div>
			</div>
			<!-- Password -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="passwordPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-lock"></i></span>
        			</div>
					<input type="password" class="form-control" name="Password" placeholder="Password.."
						aria-describedby="passwordPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The password must contain at least a lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters!
      				</div>
				</div>
			</div>
			<!-- Confirm Password -->
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
          				<span class="input-group-text" id="confirmpasswordPrepend" style="display: inline-block; width: 3em;"><i class="fa fa-lock"></i></span>
        			</div>
					<input type="password" class="form-control" name="Confirm_Password" placeholder="Confirm password.."
						aria-describedby="confirmpasswordPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				The password must contain at least a lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters!
      				</div>
				</div>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Sign Up</button>
			</div>
		</form>
		<p class="text-center text-muted small">Already have an account? <a href="http://localhost/TehnologiiWeb/header/login.php">Sign in here!</a></p>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
