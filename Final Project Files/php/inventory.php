<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            background-image: url("../img/back.png"), linear-gradient(to right, #a8ff78, #78ffd6);
            font-family: verdana;
            background-repeat:repeat;
        }

        ul {
            list-style-type: none;
            margin: 5px;
            padding: 0;
            overflow: hidden;
            background-color: darkorange;
            font-size:200%;
            border-style: outset;
            border-radius:10px;
        }

        li {
            display:inline;
        }

        li a, .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        li.dropdown {
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: darkred;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color:black;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #welcome{
            font-size:200%;
            color:white;
        }

        

        img{
            width:30px; 
            height:30px;
        }

        #logo{
            width:200px;
            height:200px;
        }

        #submit{
			background-color:red;
			width:250px;
			height:50px;
			border-radius:100px;
			border:none;
            transition: background-color 0.5s ease;
            font-size:120%;
		}
		#submit:hover{
			background-color:pink;
		}

        .topicon{
            display: inline;
            width: 30px;
            height: 30px;
            border-radius: 30px;
            float:right;
            margin:5px;
        }
        #pagecontent{
            width:60%;
            margin:auto;
            background-color: rgb(200, 200, 0);
            padding:5px;
            border-style: outset;
            border-radius:10px;
            text-align:center;
        }

        p{
            font-size: 120%;
        }
        #categories{
            margin:auto;
            border:none;
        }
        td{
            background-color: seagreen;
            width:25%;
            padding:10px;
            margin:0;
        }
        td:hover{
            background-color: red;
            transition: background-color 0.5s ease;
        }
        table {
            table-layout: fixed ;
            width: 100% ;
        }
        

    </style>
</head>

<body>
    <?php 
    require("db.php");
    session_start();
    ?>

    <div>
        <img src="../img/logo.png" style="float:left;" id="logo">
        <p style="background-color:white;">Welcome, <?php echo $_SESSION['username'];?> </p>
    </div>
    <div>
        <ul>
            <li><a href="inventory.php">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Diet Categories</a>
                <div class="dropdown-content">
                    <a href="#">Keto</a>
                    <a href="#">Atkins</a>
                    <a href="#">Paleo</a>
                    <a href="#">Vegetarian</a>
                    <a href="#">Vegan</a>
                    <a href="#">Pescatarian</a>
                    <a href="#">Raw</a>
                    <a href="#">Mediterranean</a>
                </div>
            </li>
            
            <li><a href="viewcart.php" class="topicon" title="View Cart"><img src="../img/cart_icon.png"></a></li>
            <li><a href="profile.php" class="topicon" title="View Profile"><img src="../img/user_icon.png"></a></li>
            <li><a href="logout.php" class="topicon" title="Log Out"><img src="../img/logout_icon.png"></a></li>
        </ul>
    </div>

    <div id="pagecontent">
        <p>Welcome to Simple Shopper, an online grocery service to fulfil all of your dietary needs.</p>
        <p>Choose your diet below, or browse entire inventory here.</p>
        <div id="categories">
            <table>
                <tr>
                <td><a href="#" style="display:block; text-decoration:none;"><h4>Keto</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Atkins</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Paleo</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Vegetarian</h4><p>Insert diet info</p></a></td>
                </tr>
                <tr>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Vegan</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Mediterranean</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Pescatarian</h4><p>Insert diet info</p></a></td>
                    <td><a href="#" style="display:block; text-decoration:none;"><h4>Raw</h4><p>Insert diet info</p></a></td>
                </tr>
            </table>
        </div>
    
    </div>
</body>
</html>