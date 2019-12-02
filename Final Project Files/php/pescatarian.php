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
                <a href="inventory.php?username=<?php echo $_GET['username'];?>" class="bar-item button"><i class="fa fa-book"></i> OUR DIETS</a>
                <a href="logout.php" class="bar-item button"><i class="fa fa-sign-out"></i> LOG OUT</a>
                </div>
        </div>
    </div>
    
    <div class="container" style="text-align:center;background-image: url('../img/grocerybackground.jpg');background-repeat:none; background-attachment: fixed;">
        <div class="card" style="background-color: rgba(255,250,240,0.7)">
        <h1>Welcome to Simple Shopper!</h1>
        <p>Simple Shopper is an online grocery service to fulfil all of your dietary needs. Choose your diet below, or browse entire inventory below.</p>
    </div>
    </div>
<div style="padding:5px;">
    <div class="cell-row">
        <div class="cell" style="background-color:#6f6456;">
            <a href="keto.php?username=<?php echo $_GET['username'];?>"><h2>Keto</h2>
            <p>A low-carb, high-fat diet to go into ketosis and burn fat.</p></a>
        </div>
        <div class="cell" style="background-color:#cddc49;">
            <a href="atkins.php?username=<?php echo $_GET['username'];?>"><h2>Atkins</h2>
            <p>Similar to the keto diet, but with less restrictions on carbs.</p></a>
        </div>
        <div class="cell" style="background-color:#cb7e94;">
            <a href="paleo.php?username=<?php echo $_GET['username'];?>"><h2>Paleo</h2>
            <p>The diet of early humans, with no dairy, grains, or processed foods.</p></a>
        </div>
        <div class="cell" style="background-color:#e94b30;">
            <a href="vegetarian.php?username=<?php echo $_GET['username'];?>"><h2>Vegetarian</h2>
            <p>A meat-free diet. Dairy and eggs are still included in this diet.</p></a>
        </div>
    </div>
    <div class="cell-row">
        <div class="cell" style="background-color:#fee659;">
            <a href="mediterranean?username=<?php echo $_GET['username'];?>"><h2>Mediterranean</h2>
            <p>A diet full of fresh fruits, beans, nuts, yogurt, cheese, and other staple foods of Southern Europe.</p></a>
        </div>
        <div class="cell" style="background-color:#a1cfdd;">
            <a href="vegan.php?username=<?php echo $_GET['username'];?>"><h2>Vegan</h2>
            <p>A 100% plant based diet</p></a>
        </div>
        <div class="cell" style="background-color:#b0ffbd;">
            <a href="raw.php?username=<?php echo $_GET['username'];?>"><h2>Raw</h2>
            <p>A diet of organic, uncooked, and unprocessed foods.</p></a>
        </div>
        <div class="cell" style="background-color:#4fcfad;">
            <a href="pescatarian.php?username=<?php echo $_GET['username'];?>"><h2>Pescatarian</h2>
            <p>A diet where the only meat involved is fish.</p></a>
        </div>
    </div>
</div>

<div class="container">
<h2 id="inv">Our Inventory</h2>
<?php 
    $query= "SELECT * FROM `food_inventory` WHERE `pescatarian_diet`=1";
    $result= mysqli_query($con,$query) or die(mysql_error());
    while($row=mysqli_fetch_assoc($result)){
        echo "<div class='card wide' style='padding:5px; overflow:auto;'>";
        echo "<img src='../img/" . $row['food_image'] . "' style='width:300px; height:300px; float:left; padding-right:20px;'>";
        echo "<div style='padding:5px;'>";
        echo "<p>Item: " . $row['food_desc'] . "</p>";
        echo "<p>Price: " . $row['price'] . "</p>";
        echo "<p>Stock: " . $row['stock'] . "</p>";
        echo "<p> Diets: ";
        if($row['keto_diet']!=0){
            echo "Keto ";
        }
        if($row['paleo_diet']!=0){
            echo "Paleo ";
        }
        if($row['atkins_diet']!=0){
            echo "Atkins ";
        }
        if($row['vegetarian_diet']!=0){
            echo "Vegetarian ";
        }
        if($row['pescatarian_diet']!=0){
            echo "Pescatarian ";
        }
        if($row['vegan_diet']!=0){
            echo "Vegan ";
        }
        if($row['raw_diet']!=0){
            echo "Raw ";
        }
        if($row['mediterranean_diet']!=0){
            echo "Mediterranean ";
        }
        echo "</p>";
?>
<form action="viewcart.php" method="post">
    <input type="hidden" name="submit_id" value= "<?php echo $row['food_id']?>">
    <i class="fa fa-plus-square"></i><input type='submit' name ="submit" class="button" name="<?php echo $row['food_id']?>"  value='Add to Cart'>
</form>
<?php
    echo "</div>";
    echo "</div>";
}

?>

<?php 

?>

</div>
</body>

</html>