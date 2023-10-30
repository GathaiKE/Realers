<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

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
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <script src="script.js" defer></script>
</head>
<body>

    <nav>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="properties.php" >Properties</a>
            <a href="rent.php" >Rent</a>
            <a href="payment.php" >Payment</a>
            <?php
                    if(isset($_SESSION["role"]) && $_SESSION["role"] === "admin"){
                        echo "<a href='admin.php' >Admin</a>";
                    }
                ?>
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
                <a href="rent.php" >Rent</a>
                <a href="payment.php" >Payment</a>
                <?php
                    if(isset($_SESSION["role"]) && $_SESSION["role"] === "admin"){
                        echo "<a href='admin.php' >Admin</a>";
                    }
                ?>
            </div>
        </div>
        <div class="login">
            <a  href="logout.php" id="log">Log out</a>
        </div>
        <?php if(isset($_SESSION["user_id"])){ ?>
            <div class="pfp">
                <img src="<?php echo $_SESSION["pfp"] ?>" onclick="window.location.href='profile.php'" alt="profile" id="pfp-img">
            </div>
        <?php } ?>
    </nav>
    <div class="pay-container">
        <h1>Rent Payment</h1>
        <form action="process_payment.php" method="post">
            <span>
                <label for="payment-method">Mode of payment : </label>
                <span>
                    <input type="radio" name="payment_method" id="mpesa" value="mpesa">
                    <img src="./assets/mpesa-seeklogo.com.svg" alt="mpesa">
                </span>
                <span>
                    <input type="radio" name="payment_method" id="kcb" value="kcb">
                    <img src="./assets/kcb-group-plc-seeklogo.com.svg" alt="kcb">
                </span>
                <span>
                    <input type="radio" name="payment_method" id="equity" value="equity">
                    <img src="./assets/eqbank.svg" alt="equity">
                </span>
            </span>
            <span>
                <label for="amount">Amount</label>
                <input type="number" name="amount">
            </span>
            <span>
                <label for="code">Transaction Code : </label>
                <input type="text" name="code">
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