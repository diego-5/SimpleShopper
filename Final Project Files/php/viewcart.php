<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<h2>Your Cart Items</h2>
<?php 
require("db.php");
session_start();

$total=0;
$user_id= $_SESSION['username'];

$food_id = $_POST['submit_id'];


$user_id = mysqli_real_escape_string($con,$user_id);
$food_id = mysqli_real_escape_string($con, $food_id);

$query="INSERT INTO `cart`(`customer`, `food_id`) VALUES ('$user_id', '$food_id')";
mysqli_query($con, $query);

$aquery="SELECT * FROM `cart`";
$aresult=mysqli_query($con, $aquery) or die(mysql_error()); 
while($arow=mysqli_fetch_assoc($aresult)){
    $n=$arow['food_id'];

    $food_query= "SELECT * FROM `food_inventory` WHERE `food_id`='$n'";
    $food_result=mysqli_query($con, $food_query) or die(mysql_error());
    while($line=mysqli_fetch_assoc($food_result)){
        echo "<div class='card'>";
        echo "<p>Food ID Number: " . $line['food_id'] . "<br>";
        echo "<p>Food Name: " . $line['food_desc'] . "</p>";
        echo "<p>Price: " . $line['price'] . "</p>";
        echo"</div>";
        $total = $total + $line['price'];
        echo "<br><br>";
    }
}
echo "<div id='total'>";
echo "<p>Cart Total: $" . $total . "</p>";
?>

<form action="checkout.php" method="post">
    <input type="hidden" name="items" value="<?php echo $total;?>">
    <input type="submit" class="button" name="checkout" id="submit" value="Buy Items">
</form>

<a href="inventory.php?username=<?php echo $_SESSION['username'];?>" class="button">Continue Shopping</a>
<?php echo "</div>"; ?>



</body>
</html>
