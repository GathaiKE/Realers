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
    <div class="pay-container">
        <h1>Rent Payment</h1>
        <form action="">
            <span>
                <label for="appname">Appartment Name : </label>
                <select name="appartment" id="">
                    <option value="queensland">Queensland Appartment</option>
                    <option value="Kings">Kings Villa</option>
                </select>
            </span>
            <span>
                <label for="tenant">Tenant Name : </label>
                <input type="text" value="John Doe">
            </span>
            <span>
                <Label>Room No : </Label>
                <input type="text" value="45">
            </span>
            <span>
                <label for="payment-method">Mode of payment : </label>
                <span>
                    <input type="radio" name="mpesa" id="mpesa" checked>
                    <img src="./assets/mpesa-seeklogo.com.svg" alt="mpesa">
                </span>
                <span>
                    <input type="radio" name="kcb" id="kcb">
                    <img src="./assets/kcb-group-plc-seeklogo.com.svg" alt="kcb">
                </span>
                <span>
                    <input type="radio" name="equity" id="equity">
                    <img src="./assets/eqbank.svg" alt="equity">
                </span>
            </span>
            <span>
                <label for="amount">Amount</label>
                <input type="text" value="20000">
            </span>
            <span>
                <label for="code">Transaction Code : </label>
                <input type="text" value="MK3JU44352">
            </span>
            <button type="submit" id="expand">Submit Payment</button>
        </form>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>