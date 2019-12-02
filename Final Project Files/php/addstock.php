<?php 
require("db.php");
session_start();
$s = $_POST['submit_id'];

$query= "SELECT * FROM `food_inventory`";
$result= mysqli_query($con,$query) or die(mysql_error());
if($row=mysqli_fetch_assoc($result)){
    $q1 = "UPDATE `food_inventory` SET `stock` =  (`stock` + 1) WHERE `food_id`='$s'" ;
    mysqli_query($con, $q1);
}

header("Location: admininventory.php"); 
die();

?>