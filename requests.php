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
    <div class="admin-container">
        <div class="sidenav">
            <a href="admin.php">Appartments</a>
            <a href="users.php">Users</a>
            <a href="#" class="active">Requests</a>
        </div>
        <div class="admin-body">
            <span class="searchbar">
                <label for="search">Search : </label>
                <input type="text" class="search">
            </span>
            <div class="user-container">
            <h2>All Users</h2>
            <div class="user">
                <img src="./assets/pfp.webp" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span>Jonass Dorsy</span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                        Queensland Appartment
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                        45
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span>20000</span>
                </span>
               <span class="btns">
                    <button id="expand">Approve</button>
                    <button id="del">Reject</button>
                </span>
            </div>
        </div>
        <div class="user">
                <img src="./assets/pfp.webp" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span>Jonass Dorsy</span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                        Queensland Appartment
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                        45
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span>20000</span>
                </span>
               <span class="btns">
                    <button id="expand">Approve</button>
                    <button id="del">Reject</button>
                </span>
            </div>
        </div>
        <div class="user">
                <img src="./assets/pfp.webp" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span>Jonass Dorsy</span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                        Queensland Appartment
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                        45
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span>20000</span>
                </span>
               <span class="btns">
                    <button id="expand">Approve</button>
                    <button id="del">Reject</button>
                </span>
            </div>
        </div>
        <div class="user">
                <img src="./assets/pfp.webp" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span>Jonass Dorsy</span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                        Queensland Appartment
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                        45
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span>20000</span>
                </span>
               <span class="btns">
                    <button id="expand">Approve</button>
                    <button id="del">Reject</button>
                </span>
            </div>
        </div>
        <div class="user">
                <img src="./assets/pfp.webp" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span>Jonass Dorsy</span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                        Queensland Appartment
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                        45
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span>20000</span>
                </span>
               <span class="btns">
                    <button id="expand">Approve</button>
                    <button id="del">Reject</button>
                </span>
            </div>
        </div>
    </div>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>