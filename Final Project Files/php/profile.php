<!DOCTYPE html>
<html>
<head>
    <style>
        body,h1,h2,h3,h4,h5,h6, #submit{
            font-family: courier;
            text-align:center;
        }

        body, html{
            height: 100%;
            line-height: 1.8;
            background-color:floralwhite;
        }

        .bar .button {
            padding: 16px;
            white-space:normal;
        }

        .card{
            box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
            background-color: rgba(255,255,0, 0.4);
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

        a{
            text-decoration:none;
            color:black;
        }
        a:hover{
            color:darkorange;
        }
    </style>
</head>

<body>

<h1>User Profile</h1>

<?php 
require("db.php");
session_start();

$id = $_SESSION['username'];
$id = mysqli_real_escape_string($con, $id);


echo "<div class='card'>";
echo "<h3>Personal Info</h3>";
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
echo "</div>";

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

<a href="inventory.php" class="button">Return to Inventory</a>
<a href="login.php" class="button">Login as Different User</a>
<a href="editprofile.php" class="button">Edit Profile</a>
</body>
</html>

