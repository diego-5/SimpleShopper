<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-image: linear-gradient(to right, #a8ff78, #78ffd6);
        }
        .history{
            background-color: rgba(0,0,150, 0.7);
            color:white;
            font-size:150%;
            width:50%;
			margin:auto;
			padding:5px;
        }
        h2{
            text-align:center;
            font-size:200%;
        }

        a{
            color:white;
            background-color:coral;
            transition: background-color 0.5s ease;
            float:right;
            padding:5px;
            margin:5px;
        }
        a:hover{
            background-color:pink;
        }
    </style>
</head>

<body>

<h2>User Profile</h2>

<?php 
require("db.php");
session_start();

$id = $_GET['username'];
$id = mysqli_real_escape_string($con, $id);

echo "<div class='history'>";
echo "Username: " . $id . "<br>";


$cust_query = "SELECT * FROM `customers` WHERE `customer_first_name`='$id'";
$cust_result = mysqli_query($con, $cust_query) or die(mysql_error());
while($row=mysqli_fetch_assoc($cust_result)){
    echo "<p>Name: " . $row['customer_first_name'] . " " . $row['customer_last_name'] ."</p>";
    echo "<p>Password: " . $row['customer_password'] . "</p>";
    echo "<p>Email Address: " . $row['customer_email_address'] . "</p>";
    echo "<p>Phone Number: " . $row['customer_phone_number'] . "</p>";
    echo "<p>Address: " . $row['customer_address'] . ", " . $row['customer_city'] . ", " . $row['customer_state'] . " " . $row['customer_zipcode']. "</p>";
    
}

/*
while($row=mysqli_fetch_assoc($cust_result)){
    $n=$row['car_id'];
    $query = "SELECT * FROM `inventory` WHERE `car_id` = '$n'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    
    while($arow=mysqli_fetch_assoc($result)){

        echo "<p>Car Name: " . $arow['car_name'] . " " . $arow['car_make'] . "</p>";
        echo "<p>Car Type: " . $arow['car_type'] . "</p>";
        echo "<p>Car Price: $" . $arow['price'] . " per day</p>";
        echo "<br><br>";
        
    }
}
*/

?>

<a href="inventory.php">Return to Inventory</a>
<a href="login.php">Login as Different User</a>
</body>
</html>

