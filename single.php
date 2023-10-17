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
    
    <div class="single-prop-container">
        <h1>Queensland Appartments</h1>
        <img src="./assets/landing.jpg" alt="">
        <div class="single-part">
            <span>
                <label for="location">Location : </label>
                <span>
                    Naivasha
                </span>
            </span>
            <span>
                <label for="cost">Rent Per Month : </label>
                <span>
                    15000 - 20000
                </span>
            </span>
            <span>
                <label for="rooms"> Rooms Available</label>
                <ul>
                    <li>Studio : 15000</li>
                    <li>One Bedroom : 25000</li>
                    <li>Two Bedroom : 30000</li>
                    <li>Three Bedroom : 40000</li>
                </ul>
            </span>
            <span>
                <label for="desc" id="desc">Description</label>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem numquam molestiae veritatis minus assumenda ea porro eos necessitatibus, itaque tempore id ipsum quasi deleniti, hic saepe consectetur libero. Sed aspernatur doloremque, nesciunt asperiores fuga dignissimos quaerat amet illo voluptatum delectus esse libero totam officia reiciendis nobis aut nihil quos eum?</p>
            </span>
            <span>
                <button id="expand">Rent Appartment</button>
                <button id="wish">Wishlist</button>
            </span>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>