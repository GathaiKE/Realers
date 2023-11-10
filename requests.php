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

$users = $appartments = $costs = array();

$conn = new mysqli($server, $user, $dbpassword, $db);

if($conn->connect_error){
    die("Connection to the database failed : ".$conn->connect_error);
}

$fetch_req_stmt= $conn->prepare("SELECT u.profile,u.user_id,u.firstname,u.maidenname,u.surname,r.req_id as reqid,r.user_id,r.approved,r.disapproved,r.appart_id,r.type_id,a.appart_name,c.bedsitter,c.onebr,c.twobr,c.threebr,c.fourbr,c.fivebr,c.sixbr  FROM users AS u INNER JOIN requests AS r ON u.user_id=r.user_id INNER JOIN appartments AS a ON a.appart_id=r.appart_id INNER JOIN costs AS c ON a.appart_id=c.appart_id WHERE u.user_id=r.user_id AND a.appart_id=r.appart_id AND c.appart_id=r.appart_id AND r.approved=0 AND r.disapproved=0");

if(!$fetch_req_stmt){
    die("Prepare failed : ".$conn->error);
}

$fetch_req_stmt->execute();

$result = $fetch_req_stmt->get_result();



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
    <div class="admin-container">
        <div class="sidenav">
            <a href="admin.php">Appartments</a>
            <a href="users.php">Users</a>
            <a href="#" class="active">Requests</a>
            <a href="insert.php">New Property</a>
        </div>
        <div class="admin-body">
            <!-- <span class="searchbar">
                <label for="search">Search : </label>
                <input type="text" class="search">
            </span> -->
            <div class="user-container">
            <h2>All Requests</h2>
            <?php
            if($result->num_rows > 0) {
             while($req = $result->fetch_assoc()){ 
                $req_id = $req["reqid"];
                ?>
                <div class="user">
                    <img src="<?php echo $req["profile"] ?>" alt="house">
                    <div class="user-parts">
                        <span class="user-part">
                            <label for="name">Name : </label>
                            <span><?php echo $req["firstname"]. " ".$req["maidenname"]." ".$req["surname"] ?></span>
                        </span>
                        <span class="user-part">
                            <label for="appartment">Appartment : </label>
                            <span>
                            <?php echo $req["appart_name"] ?>
                            </span>
                        </span>

                        <span class="user-part">
                            <label for="name">Cost : </label>
                            <?php 
                                if ($req["bedsitter"] > 0 && $req["type_id"] == 1) {
                                        echo "<span>".$req["bedsitter"]."</span>";
                                } elseif($req["onebr"] > 0 && $req["type_id"] == 2){
                                        echo "<span>".$req["onebr"]."</span>";
                                } elseif($req["twobr"] > 0 && $req["type_id"] == 3){
                                    echo "<span>".$req["twobr"]."</span>";
                                } elseif($req["threebr"] > 0 && $req["type_id"] == 4){
                                    echo "<span>".$req["threebr"]."</span>";
                                } elseif($req["fourbr"] > 0 && $req["type_id"] == 5){
                                    echo "<span>".$req["fourbr"]."</span>";
                                } elseif($req["fivebr"] > 0 && $req["type_id"] == 6){
                                    echo "<span>".$req["fivebr"]."</span>";
                                } elseif($req["sixbr"] >  0 && $req["type_id"] == 7){
                                    echo "<span>".$req["sixbr"]."</span>";
                                } else{
                                    echo "<span>No Room Type Specified.</span>";
                                }
                            ?>
                        </span>
                        <span class="btns">
                            <button id="expand" onclick="window.location.href='approve_request.php?reqid=<?php echo $req['reqid']; ?>'">Approve</button>
                            <button id="del" onclick='window.location.href="reject_request.php?reqid=<?php echo $req["reqid"]; ?>"'>Reject</button>
                        </span>
                    </div>
                </div>
            <?php } 
        } else {?>
            <div class="full">
                <p>There are no requests at the moment</p>
            </div>
        <?php }?>
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