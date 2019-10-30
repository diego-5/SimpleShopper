<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registration Form</title>
	<style>
		body{
			background-image: url("../img/grocerybackground.jpg");
			background-repeat:none;
			background-size: cover;
			background-attachment: fixed;
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
			margin:5px;
			font-size:100%;
		}

		
	</style>
</head>

<body>

<?php

require('db.php');
session_start();



	if(isset($_POST['submit'])){

		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);

		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$lastname = stripslashes($_REQUEST['lastname']);
		$lastname = mysqli_real_escape_string($con,$lastname);

		$emailaddr = stripslashes($_REQUEST['emailaddress']);
		$emailaddr = mysqli_real_escape_string($con,$emailaddr);

		$phonenum = stripslashes($_REQUEST['phone']);
		$phonenum = mysqli_real_escape_string($con,$phonenum);

		$addr = stripslashes($_REQUEST['address']);
		$addr = mysqli_real_escape_string($con,$addr);

		$city = stripslashes($_REQUEST['city']);
		$city= mysqli_real_escape_string($con,$city);

		$state = stripslashes($_REQUEST['state']);
		$state = mysqli_real_escape_string($con,$state);

		$zipcode = stripslashes($_REQUEST['zipcode']);
		$zipcode = mysqli_real_escape_string($con,$zipcode);

		$query = "SELECT * FROM `customers` WHERE customer_first_name='$username'";

		$result = mysqli_query($con,$query) or die(mysql_error());

        $rows = mysqli_num_rows($result);
		$user = mysqli_fetch_assoc($result);
		

		if($user){
            if($user['customer_first_name']===$username){
                echo "<div class='form'><h3>Username already exists.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}
        }else{
			$userpattern = "/^[a-zA-Z]*$/";
			$passpattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,20})/";
			$numpattern = "/^[0-9]*$/";
			if(!preg_match($userpattern, $_POST['username'])){
				echo "<div class='form'><h3>Username is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}elseif(!preg_match($userpattern, $_POST['lastname'])){
				echo "<div class='form'><h3>Last name is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}elseif (!preg_match($passpattern, $_POST["password"])){
				echo "<div class='form'><h3>Password is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}elseif (!filter_var($_POST["emailaddress"], FILTER_VALIDATE_EMAIL)){
				echo "<div class='form'><h3>Email is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}elseif($_POST["phone"].length>10 || !preg_match($numpattern, $_POST["phone"])){
				echo "<div class='form'><h3>Phone number is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";				
			}elseif($_POST["state"].length!=2){
				echo "<div class='form'><h3>State code is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";
			}elseif($_POST["zipcode"].length>8 || !preg_match($numpattern, $_POST["zipcode"])){
				echo "<div class='form'><h3>Zipcode is not correct format.</h3><br/>Click here to <a href='register.php'>Register Again</a></div>";	
			}
			else{	
				$query2 = "INSERT INTO `customers` (`customer_first_name`, `customer_last_name`, `customer_email_address`,  `customer_password`, `customer_phone_number`,`customer_address`, `customer_city`, `customer_state`, `customer_zipcode`) VALUES('$username', '$lastname', '$emailaddr', '$password', '$phonenum', '$addr', '$city', '$state', '$zipcode')";
				mysqli_query($con, $query2);
				$_SESSION['username'] = $username;
				echo $_SESSION['username'];
				echo "<div class='form'><h3>Congratulations! You have registered.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
			}
		}
	}
	else{

?>
<h1>Simple Shopper</h1>
<div class="container">	
		<h2>Register</h2>
		<p id="error" style="display:none;">One of the fields has incorrect information. Please try again.</p>
		<form action="register.php" method="POST" onsubmit="return validate();" name="login" id="register">
			<input type="text" name="username" id="username" placeholder="First Name" required />
			<span class="error"> <?php echo $usernameErr;?> </span>

			<input type="text" name="lastname" id="lastname" placeholder="Last Name" required />
			<input type="password" name="password" id="password" placeholder="Password" required />
			<input type="text" name="emailaddress" id="emailaddress" placeholder="Email" required />
			<input type="text" name="phone" id="phone" placeholder="Phone Number" required />
			<input type="text" name="address" id="address" placeholder="Street Address" required />
			<input type="text" name="city" id="city" placeholder="City" required />
			<input type="text" name="state" id="state" placeholder="State" required />
			<input type="text" name="zipcode" id="zipcode" placeholder="Zip Code" required />
			<input name="submit" type="submit" id="submit" onclick="validate()"value="Register"/>
			<p>Don't know the registration requirements? <a href='reghelp.html'>Get Help Here</a></p>
			<p>Already registered? <a href='login.php'>Login Here</a></p>
		</form>

	</div>

<?php } ?>

</body>

</html>