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
$prop_id;

if(isset($_GET["appart_id"])){
    $prop_id = $_GET["appart_id"];
}

$server = "localhost";
$user = "admin";
$dbpass = "Admin@123";
$db = "Realers";

$conn = new mysqli($server, $user, $dbpass, $db);

if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}

$fetch_prop_stmt = $conn->prepare("SELECT a.appart_id, a.appart_name, a.appart_picture , a.location, a.description , c.bedsitter,c.onebr,c.twobr,c.threebr,c.fourbr,c.fivebr,c.sixbr FROM appartments AS a INNER JOIN costs AS c ON c.appart_id = a.appart_id where a.appart_id = ?");
$fetch_prop_stmt->bind_param("i",$prop_id);

if(!$fetch_prop_stmt){
    die("Prepare failed : ".$conn->connect_error);
}

$fetch_prop_stmt->execute();

$result = $fetch_prop_stmt->get_result();

$prop = $result->fetch_assoc();

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
        <?php if(isset($_SESSION["user_id"])){ ?>
            <div class="pfp">
                <img src="<?php echo $_SESSION["pfp"] ?>" onclick="window.location.href='profile.php'" alt="profile" id="pfp-img">
            </div>
        <?php } ?>
    </nav>
        <div class="single-prop-container">
        <h1><?php echo $prop["appart_name"] ?></h1>
        <img src="<?php echo $prop["appart_picture"] ?>" alt="">
        <div class="single-part">
            <span>
                <label for="location">Location : </label>
                <span>
                    <?php echo $prop["location"] ?>
                </span>
            </span>
            <span>
                <label for="rooms"> Rooms Available</label>
                <ul>
                    <?php if($prop["bedsitter"] != 0){ ?>
                            <li><?php echo "<span> Bedsitter : Ksh ".$prop["bedsitter"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["onebr"] != 0){ ?>
                            <li><?php echo "<span> 1 Bedroom : Ksh ".$prop["onebr"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["twobr"] != 0){ ?>
                            <li><?php echo "<span> 2 Bedroom : Ksh ".$prop["twobr"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["threebr"] != 0){ ?>
                            <li><?php echo "<span> 3 Bedroom : Ksh ".$prop["threebr"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["fourbr"] != 0){ ?>
                            <li><?php echo "<span> 4 Bedroom : Ksh ".$prop["fourbr"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["fivebr"] != 0){ ?>
                            <li><?php echo "<span> 5 Bedroom : Ksh ".$prop["fivebr"]."</span>" ?></li>
                        <?php }?>
                        <?php if($prop["sixbr"] != 0){ ?>
                            <li><?php echo "<span> 6 Bedroom : Ksh ".$prop["sixbr"]."</span>" ?></li>
                    <?php }?>
                </ul>
            </span>
            <span>
                <label for="desc" id="desc">Description</label>
                <p><?php echo $prop["description"] ?></p>
            </span>
            <span>
                <button onclick='window.location.href="rent.php?appart_id=<?php echo $prop["appart_id"] ?>"' id="expand">Rent Appartment</button>
                <!-- <button id="wish">Wishlist</button> -->
            </span>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>