<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login Form</title>
	<style>
		body{
			background-image: url("../img/grocerybackground.jpg");
			background-repeat:none;
			background-size: cover;
		}

		form, .form{
			background-color:rgba(221, 160, 221, 0.7);
			width:50%;
			margin:auto;
			padding:5px;
			font-size:200%
		}
		h2{
			text-align:center;
			font-size:200%;
		}
		h1{
			font-size:300%;
			font-family:courier;
			background-color:pink;
		}
		#submit{
			background-color:red;
			width:250px;
			height:50px;
			border-radius:100px;
			border:none;
			transition: background-color 0.5s ease;
		}
		#submit:hover{
			background-color:pink;
		}
		input{
			padding:5px;
			font-size:100%;
		}
		
	</style>
</head>

<body>

<?php

require('db.php');
session_start();

	if(isset($_POST['username'])){


		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$query = "SELECT * FROM `customers` WHERE `customer_first_name`='$username' AND `customer_password`='$password';";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		
		if($rows==1){

			$_SESSION['username'] = $username;
			
			header("Location: inventory.php"); 
			die();

		}
		else{

			echo "<div class='form'><h3>Name/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		}

	}
	else{

?>
<h1>Simple Shopper</h1>

<div class="container">	
		<h2>Log In</h2>
		
		<form action="login.php" method="POST" name="login">
			<input type="text" name="username" placeholder="Username (First name only)" required />
			<input type="password" name="password" placeholder="Password" required />
			<input name="submit" type="submit" id="submit" value="Login"/>
			<p>Not registered yet? <a href='register.php'>Register Here</a></p>
		</form>

	</div>

<?php } ?>

</body>

</html>