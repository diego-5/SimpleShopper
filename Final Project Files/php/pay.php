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
require("db.php");
session_start();
?>

<div class="top card">
            <div class="bar" id="myNavbar">
                <a href="#home" class="bar-item button wide">SIMPLE SHOPPER</a>
                <!-- Right-sided navbar links -->
                <div class="right">
                <a href="#about" class="bar-item button"><i class="fa fa-group"></i> ABOUT US</a>
                <a href="profile.php" class="bar-item button"><i class="fa fa-user"></i> PROFILE</a>
                <a href="viewcart.php" class="bar-item button"><i class="fa fa-cart-arrow-down"></i> VIEW CART</a>
                <a href="inventory.php" class="bar-item button"><i class="fa fa-book"></i> OUR DIETS</a>
                <a href="logout.php" class="bar-item button"><i class="fa fa-sign-out"></i> LOG OUT</a>
                </div>
        </div>
    </div>

<div class="card container">
        

<?php 
function check_cc($cc){

    $visa = "/(4\d{12}(?:\d{3})?)/";
    $amex = "/(3[47]\d{13})/";
    $discover = "/^6(?:011|5[0-9]{2})[0-9]{12}$/";
    $mastercard = "/(5[1-5]\d{14})/";
    $cc = str_replace(" ", "", $cc);

    if(preg_match($visa, $cc) || preg_match($amex, $cc) || preg_match($discover, $cc) || preg_match($mastercard, $cc)){
        return true;
    }
    else{
        return false;
    }

}

$cardErr="";
if(!check_cc($_POST['cardnum'])){
    $cardErr= "Card must match the valid card types above.";
}else{
    $user = $_SESSION['username'];
    $q1 = "SELECT * FROM `customers` WHERE customer_first_name = '$user'";
    $r1 = mysqli_query($con, $q1) or die(mysql_error());
    while($row=mysqli_fetch_assoc($r1)){
        $id = $row['customerId'];
    }
    $q2 = "INSERT INTO `customer_orders` (`order_date`,`status`, `customerId`) VALUES (now(),'PENDING FOR DELIVERY',  $id)";
    mysqli_query($con, $q2);
    $q3 = "DELETE FROM `cart` WHERE `customer` = '$user'";
    mysqli_query($con, $q3);
    echo "<p>Your order has been placed! <a href='inventory.php' class='button'>Return to Inventory</a> or <a href='logout.php' class='button'>Log Out</a></p>";
}
?>
<form action="pay.php" method="POST" name="add">
        <p>Name on Card <input type="text" class="text-input" name="cardname" placeholder="Name" required /></p>
        <p>
            Card Number
            <i class="fa fa-cc-mastercard"></i>
            <i class="fa fa-cc-amex"></i>
            <i class="fa fa-cc-visa"></i>
            <i class="fa fa-cc-discover"></i>
            <input type="text" class="text-input" name="cardnum" placeholder="Card Number" required />
            <p style="color:red;"><?php echo $cardErr;?></p>
        </p>
        <p>
            Expiration Date
            <select>
            <option value="01">January</option>
            <option value="02">February </option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <select>
            <option value="20"> 2020</option>
            <option value="21"> 2021</option>
            <option value="22"> 2022</option>
            <option value="23"> 2023</option>
            <option value="24"> 2024</option>
            <option value="25"> 2025</option>
        </select>

        </p>
        <p>
            CCV 
            <input type="text" class="text-input" name="cardccv" placeholder="CCV (nummber on back of card)" required />
        </p>
        <input type="submit" class="button text-input" name="submit" value="Submit Item"/>
    </form>
</div>



</body>
</html>