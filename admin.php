<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
} 

if($_SESSION["role"] !== "admin"){
    echo "Access denied. Admin privileges required";
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


$conn = new mysqli($server, $user, $password, $db);


if($conn->connect_error){
    die("Failed to connect to database : ".$conn->connect_error);
}

$fetch_props_stmt = $conn->prepare("SELECT a.appart_id, a.appart_name, a.appart_picture , a.location, c.bedsitter,c.onebr,c.twobr,c.threebr,c.fourbr,c.fivebr,c.sixbr FROM appartments AS a INNER JOIN costs AS c ON c.appart_id = a.appart_id");

if(!$fetch_props_stmt){
    echo "Prepare failed : ".$conn->error;
}

$fetch_props_stmt->execute();

$result = $fetch_props_stmt->get_result();

if(!$result->num_rows > 0){
    echo "No properties were found";
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
    <div class="admin-container">
        <div class="sidenav">
            <a href="#" class="active">Appartments</a>
            <a href="users.php">Users</a>
            <a href="requests.php">Requests</a>
            <a href="insert.php">New Property</a>
        </div>
        <div class="admin-body">
                    <label for="search">Search : </label>
                    <input type="text" class="search">
            </span>
            <div class="props-container">
            <h2>All Appartments</h2>

            <?php while($prop = $result->fetch_assoc()){ ?>
                <div class="prop">
                <img src="<?php echo $prop["appart_picture"] ?>" alt="house">
                <div class="parts">
                    <span class="part">
                        <label for="name">Name : </label>
                        <span><?php  echo $prop["appart_name"] ?></span>
                    </span>
                    <span class="part rent_bedrooms">
                        <label for="Cost">Rent(Monthly)</label>
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
                    <span class="location">
                        <label for="name">Location : </label>
                        <?php echo "<span>".$prop["location"]."</span>" ?>
                    </span>
                    <span class="btns">
                    <button onclick='window.location.href="single.php?appart_id=<?php echo $prop["appart_id"] ?>"' id="expand">Details</button>
                    <button id="wish" onclick="window.location.href='update_apart.php?appart_id=<?php echo $prop['appart_id'] ?>'">Update</button>
                    <button id="del" onclick='window.location.href="delete_prop.php?appart_id=<?php echo $prop["appart_id"] ?>"''>Delete</button>
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