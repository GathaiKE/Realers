<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if($_SESSION["role"] !== "admin"){
    echo "Access denied! Admin privileges required";
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
$dbpassword = "Admin@123";
$db = "Realers";


$conn = new mysqli($server, $user, $dbpassword, $db);

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

// $fetch_users_stmt = $conn->prepare("SELECT u.user_id,u.firstname, u.profile, u.maidenname, u.surname, a.appart_id, a.appart_name, o.room_no, rb.amount FROM users AS u LEFT JOIN occupied_by AS ob ON ob.user_id=u.user_id LEFT JOIN occupied AS o ON o.id=ob.occ_id LEFT JOIN appartments AS a ON a.appart_id=o.appart_id LEFT JOIN rent_balance AS rb ON rb.occby_id=ob.id WHERE u.user_id=ob.user_id AND u.role='user'");

$fetch_users_stmt = $conn->prepare("SELECT u.user_id, u.firstname, u.profile, u.maidenname, u.surname, a.appart_id, a.appart_name, o.room_no, rb.amount FROM users AS u LEFT JOIN occupied_by AS ob ON ob.user_id = u.user_id LEFT JOIN occupied AS o ON o.id = ob.occ_id LEFT JOIN appartments AS a ON a.appart_id = o.appart_id LEFT JOIN rent_balance AS rb ON rb.occby_id = ob.id WHERE u.role = 'user'");



if(!$fetch_users_stmt){
    die("Prepare failed (fetch_users_stmt) : ".$conn->error);
}

$fetch_users_stmt->execute();

$result = $fetch_users_stmt->get_result();
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
            <a href="admin.php" >Admin</a>
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
                <a href="admin.php" >Admin</a>
            </div>
        </div>
        <div class="login">
            <a  href="logout.php" id="log">Log out</a>
        </div>
        <div class="pfp">
            <img src="<?php echo $_SESSION["pfp"] ?>" alt="profile" id="pfp-img">
        </div>
    </nav>
    <div class="admin-container">
        <div class="sidenav">
            <a href="admin.php">Appartments</a>
            <a href="#" class="active">Users</a>
            <a href="requests.php">Requests</a>
            <a href="insert.php">New Property</a>
        </div>
        <div class="admin-body">
            <span class="searchbar">
                <label for="search">Search : </label>
                <input type="text" class="search">
            </span>
            <div class="user-container">
            <h2>All Users</h2>
        
            <?php while($user = $result->fetch_assoc()) {?>
        <div class="user">
                <img src="<?php echo $user["profile"] ?>" alt="house">
             <div class="user-parts">
                <span class="user-part">
                    <label for="name">Name : </label>
                    <span><?php echo $user["firstname"]." ".$user["maidenname"]." ".$user["surname"] ?></span>
                </span>
                <span class="user-part">
                    <label for="appartment">Appartment : </label>
                    <span>
                    <?php echo $user["appart_name"] ?>
                    </span>
                </span>
                <span class="user-part">
                    <label for="appartment">Room Number : </label>
                    <span>
                    <?php echo $user["room_no"] ?>
                    </span>
                </span>
                <span class="user-part">
                    <label for="name">Balance : </label>
                    <span><?php echo $user["amount"] ?></span>
                </span>
               <span class="btns">
                    <button id="del" onclick='window.location.href="delete_user.php?user_id=<?php echo $user["user_id"] ?>"'>Remove</button>
                </span>
            </div>
        </div>
        <?php } ?>
    </div>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html> 