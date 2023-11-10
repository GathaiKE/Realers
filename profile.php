<?php
session_start();
ini_set('display_errors',1);
ini_set("log_errors",1);
error_reporting(E_ALL);
ini_set('error_log','error_log');

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


$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$user_id = $_SESSION["user_id"];

$conn = new mysqli($server, $user, $password, $db);
 if($conn->connect_error){
    die("Connection to db failed :".$conn->connect_error);
 }

 $fetch_user_stmt = $conn->prepare("SELECT u.firstname, u.profile, u.maidenname, u.surname,u.email,u.phone, a.appart_id, a.appart_name, o.room_no, rb.amount FROM users AS u LEFT JOIN occupied_by AS ob ON ob.user_id=u.user_id LEFT JOIN occupied AS o ON o.id=ob.occ_id LEFT JOIN appartments AS a ON a.appart_id=o.appart_id LEFT JOIN rent_balance AS rb ON rb.occby_id=ob.id WHERE u.user_id =?");

 $fetch_user_stmt->bind_param("i",$user_id);

 if(!$fetch_user_stmt){
    die("Prepare failed (fetch_user_stmt) : ".$conn->error);
 }

 $fetch_user_stmt->execute();

 $user_result = $fetch_user_stmt->get_result();

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

    <div class="profile-container">
        <h2>Your Profile</h2>

        <div class="profile">
            <?php while($user = $user_result->fetch_assoc()) {?>
            <img src="<?php echo $user["profile"] ?>" alt="profile picture">
            <span>
                <label for="fname"> First Name : </label>
                <span><?php echo $user["firstname"] ?></span>
            </span>
            <span>
                <label for="mname">Maiden Name : </label>
                <span><?php echo $user["maidenname"] ?></span>
            </span>
            <span>
                <label for="sname">Surname : </label>
                <span><?php echo $user["surname"] ?></span>
            </span>
            <span>
                <label for="email">Email : </label>
                <span><?php echo $user["email"] ?></span>
            </span>
            <span>
                <label for="tel">Telephone : </label>
                <span>+254 <?php echo $user["phone"] ?></span>
            </span>
            <span>
                <label for="appartment">Residence : </label>
                <span><?php echo $user["appart_name"] ?></span>
            </span>
            <span>
                <label for="houseno">appartment Number : </label>
                <span><?php echo $user["room_no"] ?></span>
            </span>
            <span>
                <label for="balance">Balance : </label>
                <?php echo $user["amount"] ?>
            </span>
            <button id="expand" onclick="window.location.href='update_user.php'">Update</button>
            <?php } ?>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>