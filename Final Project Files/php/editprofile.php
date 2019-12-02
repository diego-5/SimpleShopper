<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body,h1,h2,h3,h4,h5,h6 {
            font-family: courier;
        }

        body, html {
            height: 100%;
            line-height: 1.8;
            background-color:floralwhite;
        }

        .bar .button {
            padding: 16px;
            white-space:normal;
        }

        .top{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            z-index:1;
            background-color:lightgreen;
        }
        .card{
            box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        }

        .right{
            float:right;
        }

        .bar-item{
            padding:8px 16px;
            float:left;
            width:auto;
            border:none;
            display:block;
            outline:0;
        }

        .button{
            border:none;
            display:inline-block;
            padding:8px 16px;
            vertical-align:middle;
            overflow:hidden;
            text-decoration:none;
            color:#000;
            background-color:lightgreen;
            text-align:center;
            cursor:pointer;
            white-space:nowrap;

        }

        .button:hover{
            color:#000;
            background-color:salmon;
        }

        .wide{
            letter-spacing:4px;
        }

        .container{
            padding:128px 16px;
            clear:both;
        }

        .cell-row{
            display:table;
            width:100%;
        }
        .cell{
            display:table-cell;
            text-align:center;
            width:25%;
        }


        a{
            text-decoration:none;
            color:black;
        }
        a:hover{
            color:darkorange;
        }
        .text-input{
            padding:8px;
            display:block;
            border:none;
            border-bottom:1px solid #ccc;
            width:100%
        }
    </style>

</head>

<body>
<?php

require('db.php');
session_start(); 

?>
    <div class="top card">
            <div class="bar" id="myNavbar">
                <a href="#home" class="bar-item button wide">SIMPLE SHOPPER</a>
                <span class="bar-item" style="padding-left:175px;"><?php echo "Welcome, " . $_SESSION['username'] . "!";?></span>
                <!-- Right-sided navbar links -->
                <div class="right">
                <a href="#about" class="bar-item button"><i class="fa fa-group"></i> ABOUT US</a>
                <a href="profile.php" class="bar-item button"><i class="fa fa-user"></i> PROFILE</a>
                <a href="viewcart.php" class="bar-item button"><i class="fa fa-cart-arrow-down"></i> VIEW CART</a>
                <a href="inventory.php?username=<?php echo $_SESSION['username'];?>" class="bar-item button"><i class="fa fa-book"></i> OUR DIETS</a>
                <a href="logout.php" class="bar-item button"><i class="fa fa-sign-out"></i> LOG OUT</a>
                </div>
        </div>
    </div>
    



<?php 

if(isset($_POST['submit'])){
    $userpattern = "/^[a-zA-Z]*$/";
    $passpattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,20})/";
    $numpattern = "/^[0-9]*$/";
    $s = $_SESSION['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['emailaddress'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $fnameErr= $lnameErr= $passErr= $emailErr= $phoneErr= $addressErr= $cityErr= $stateErr= $zipErr = "";

        if(!empty($lastname) && preg_match($userpattern, $lastname)){
            $lname_query = "UPDATE `customers` SET `customer_last_name`='$lastname' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$lname_query);
        }else{
            $lnameErr = "<p>- Last name is not valid.</p>";
        }
        if(!empty($password) && preg_match($passpattern, $password)){
            $pass_query = "UPDATE `customers` SET `customer_password`='$password' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$pass_query);
        }else{
            $passErr = "<p>- Password is not valid.</p>";
        }
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_query = "UPDATE `customers` SET `customer_email_address`='$email' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$email_query);
        }else{
            $emailErr = "<p>- Email address is not valid.</p>";
        }
        if(!empty($phone) && preg_match($numpattern, $phone) && strlen($phone)==10){
            $phone_query = "UPDATE `customers` SET `customer_phone_number`='$phone' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$phone_query);
        }else{
            $phoneErr = "<p>- Phone number is not valid.</p>";
        }
        if(!empty($address)){
            $address_query = "UPDATE `customers` SET `customer_address`='$address' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$address_query);
        }else{
            $addressErr = "<p>- Address is empty.</p>";
        }
        if(!empty($city)){
            $city_query = "UPDATE `customers` SET `customer_city`='$city' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$city_query);
        }else{
            $cityErr = "<p>- City is not valid.</p>";
        }
        if(!empty($state) && strlen($state)==2){
            $state_query = "UPDATE `customers` SET `customer_state`='$state' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$state_query);
        }else{
            $stateErr = "<p>- State code is not valid.</p>";
        }
        if(!empty($zipcode) && strlen($zipcode)==5){
            $zip_query = "UPDATE `customers` SET `customer_zipcode`='$zipcode' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$zip_query);
        }else{
            $zipErr = "<p>- Zip code is not valid.</p>";
        }
        if(!empty($firstname) && preg_match($userpattern, $firstname)){
            $fname_query = "UPDATE `customers` SET `customer_first_name`='$firstname' WHERE `customer_first_name` = '$s'";
            mysqli_query($con,$fname_query);
        }else{
            $fnameErr = "<p>- First name is not valid.</p>";
        }

        if(empty($fnameErr) && empty($lnameErr) && empty($passErr) && empty($emailErr) && empty($phoneErr) && empty($addressErr) && empty($cityErr) && empty($stateErr) && empty($zipErr)){
            $_SESSION['username'] = $firstname;
        }
}



?>

    <div class="card container">
    <h1>Edit Profile</h1>
    <p>Note: You must enter a value for each field to change any part of your profile. If you don't want to change a value, enter your current information for that field. The values you enter here must follow the guidelines for registration. <a href ="reghelp.html" class="button">Click here to see those guidelines.</a></p>
    <p>Second note: If there is no error for a specific field but other fields have errors, note that the field without error will have changed. Keep track of what you changed!</p>
    <p>Changes will appear when a different page is loaded.</p>
    <div id = "error" style="color:red;">
        <?php echo $fnameErr. $lnameErr. $passErr. $emailErr. $phoneErr. $addressErr. $cityErr. $stateErr. $zipErr; ?>
    </div>

        <form action="editprofile.php" method="POST">
            First Name <input type="text" name="firstname" class="text-input" id="lastname" placeholder="First Name"/>
            Last Name <input type="text" name="lastname" class="text-input" id="lastname" placeholder="Last Name"/>
			Password <input type="password" name="password" class="text-input" id="password" placeholder="Password"/>
			Email <input type="text" name="emailaddress" class="text-input" id="emailaddress" placeholder="Email"/>
			Phone <input type="text" name="phone" class="text-input" id="phone" placeholder="Phone Number"/>
			Street Address <input type="text" name="address" class="text-input" id="address" placeholder="Street Address"/>
			City <input type="text" name="city" class="text-input" id="city" placeholder="City"/>
			State<input type="text" name="state" class="text-input" id="state" placeholder="State"/>
			Zip Code <input type="text" name="zipcode" class="text-input" id="zipcode" placeholder="Zip Code"/>
			<input name="submit" type="submit" id="submit" value="Submit Changes"/>
        </form>
    </div>

</body>
</html>