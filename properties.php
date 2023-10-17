<?php
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page == "properties"){
        include('properties.php');
    } elseif($page == "profile"){
        include("profile.php");
    } elseif($page == "requests"){
        include("requests.php");
    } elseif($page == "insert"){
        include("insert.php");
    } elseif($page == "single"){
        include("single.php");
    } elseif($page == "users"){
        include("users.php");
    } elseif($page == "payment"){
        include("payment.php");
    } elseif($page = "admin"){
        include("admin.php");
    } elseif($page == "rent"){
        include("rent.php");
    } else{
        include("index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="./Css/style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="properties.php" >Properties</a>
            <a href="single.php" >Single</a>
            <a href="rent.php" >Rent</a>
            <a href="payment.php" >Payment</a>
            <a href="admin.php" >Admin</a>
            <a href="profile.php" >Profile</a>
        </div>

        <div class="mobile menu">
            <div class="ham">
                <span id="menu-btn" 
                onclick="openToggle()">
                    <span class="ham-top"></span>
                    <span class="ham-middle"></span>
                    <span class="ham-bottom"></span>
                </span>
            </div>
            <div class="m-menu">
                <a href="index.php">Home</a>
                <a href="properties.php" >Properties</a>
                <a href="single.php" >Single</a>
                <a href="rent.php" >Rent</a>
                <a href="payment.php" >Payment</a>
                <a href="admin.php" >Admin</a>
                <a href="profile.php" >Profile</a>
            </div>
        </div>
        <div class="login">
            <a  href="#" id="log">Log out</a>
        </div>
        <div class="pfp">
            <img src="./assets/pfp.webp" alt="profile" id="pfp-img">
        </div>
    </nav>
    <div class="props-container">
        <div class="search">
                <label for="search">Search : </label>
                <input type="text">
            </div>
        <h1>Our Various Properties Across the country include</h1>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>