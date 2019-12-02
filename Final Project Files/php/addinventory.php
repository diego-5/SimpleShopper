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

        .info{
            overflow:auto;
            padding-left:200px;
            font-size:120%;
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
if($_SESSION['username']!="admin"){
    header("Location: login.php");
    exit();
}
   
?>
    
    <div class="top card">
            <div class="bar" id="myNavbar">
                <a href="admininventory.php?username=<?php echo $_SESSION['username'];?>"  class="bar-item button wide">SIMPLE SHOPPER</a>
                <!-- Right-sided navbar links -->
                <div class="right">
                <a href="#about" class="bar-item button"><i class="fa fa-group"></i> ABOUT US</a>
                <a href="addinventory.php" class="bar-item button"><i class="fa fa-cart-plus"></i> ADD INVENTORY</a>
                <a href="admininventory.php?username=<?php echo $_SESSION['username'];?>" class="bar-item button"><i class="fa fa-book"></i> OUR DIETS</a>
                <a href="logout.php" class="bar-item button"><i class="fa fa-sign-out"></i> LOG OUT</a>
                </div>
        </div>
    </div>


    <div class="card container">
        <form action="addinventory.php" method="POST" name="add">
            <p>Password <input type="password" class="text-input" name="adminpass" placeholder="Admin Password" required /></p>
            <p>Name of Food <input type="text" class="text-input" name="food_desc" placeholder="Product Name" required /></p>
            <p>Price <input type="number" class="text-input" name="price" step="any" placeholder="Price" required /></p>
            <p>Image File Name <input type="text" class="text-input" name="food_image" placeholder="File name with file extension (.jpg, .png, etc)" required /></p>
            <p>Diet Type (choose any)</p>
            <div style="display:inline;">
            | <input type="checkbox" name="keto"> Keto 
            | <input type="checkbox" name="atkins"> Atkins 
            | <input type="checkbox" name="paleo"> Paleo 
            | <input type="checkbox" name="vegetarian"> Vegetarian 
            </div>
            <div style="display:inline;">
            | <input type="checkbox" name="pescatarian"> Pescatarian 
            | <input type="checkbox" name="vegan"> Vegan 
            | <input type="checkbox" name="raw"> Raw 
            | <input type="checkbox" name="mediterranean"> Mediterranean 
            </div>
			<input type="submit" class="button text-input" name="submit" value="Submit Item"/>
        </form>
    </div>

<?php 
    $keto = 0;
    $paleo = 0;
    $atkins = 0;
    $vegetarian = 0;
    $pescatarian = 0;
    $vegan = 0;
    $raw = 0;
    $mediterranean = 0;
if(isset($_POST['submit'])){
    $desc = $_POST['food_desc'];
    $img = $_POST['food_image'];
    $price = $_POST['price'];

        if(!empty($_POST['keto'])){
            $keto = 1;
        }
        if(!empty($_POST['atkins'])){
            $atkins = 1;
        }
        if(!empty($_POST['paleo'])){
            $paleo = 1;
        }
        if(!empty($_POST['vegetarian'])){
            $vegetarian = 1;
        }
        if(!empty($_POST['pescatarian'])){
            $pescatarian = 1;
        }
        if(!empty($_POST['raw'])){
            $raw = 1;
        }
        if(!empty($_POST['vegan'])){
            $vegan = 1;
        }
        if(!empty($_POST['mediterranean'])){
            $mediterranean = 1;
        }
        $add_query= "INSERT INTO `food_inventory` (`food_desc`, `stock`, `price`, `food_image`, `keto_diet`, `paleo_diet`, `atkins_diet`, `vegetarian_diet`, `pescatarian_diet`, `vegan_diet`, `raw_diet`, `mediterranean_diet`) VALUES('$desc', 1, $price, '$img', $keto, $paleo, $atkins, $vegetarian, $pescatarian, $vegan, $raw, $mediterranean)";
        mysqli_query($con, $add_query);
}
echo $desc . " " . $img . " " . $keto . " " . $price;

?>

</body>
</html>