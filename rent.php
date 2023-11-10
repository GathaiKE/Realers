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

$server = "localhost";
$user = "admin";
$dbpassword = "Admin@123";
$db = "Realers";

$appart_id;
$user_id = $_SESSION["user_id"];

if(isset($_GET["appart_id"])){
    $appart_id = $_GET["appart_id"];
}

$conn = new mysqli($server, $user, $dbpassword, $db);

if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}


$fetch_appart = $conn->prepare("SELECT a.appart_name, c.bedsitter, c.onebr, c.twobr, c.threebr, c.fourbr, c.fivebr, c.sixbr FROM appartments AS a INNER JOIN costs AS c ON a.appart_id = c.appart_id WHERE a.appart_id = ?");


$fetch_appart->bind_param("i",$appart_id);

if(!$fetch_appart){
    die("Prepare failed (fetch_appart) : ".$conn->error);
}

$fetch_appart->execute();
$result = $fetch_appart->get_result();
$appart = $result->fetch_assoc();

$fetch_user = $conn->prepare("SELECT firstname, maidenname, surname, phone, email FROM users WHERE user_id =?");
$fetch_user -> bind_param("i",$user_id);

if(!$fetch_user){
    die("Prepare failed (fetch_user) : ".$conn->error);
}

$fetch_user->execute();
$user_result = $fetch_user->get_result();
$user = $user_result->fetch_assoc();

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
    <div class="rent-container">
        <h1>Rent an Appartment</h1>
        <p>Fill in the form below and submit the request to rent your preferred appartment and our team will get back to you to verify your details.</p>
        <form action="sendreq.php" method="POST">
            <input type="hidden" name="appart_id" value="<?php echo $appart_id ?>">
            <span>
                <label for="name">Tenant Name : </label>
                <input type="text" value="<?php echo $user["firstname"]." ". $user["maidenname"]." ".$user["surname"]; ?>" >
            </span>
            <span>
                <label for="email">Email : </label>
                <input type="text" value="<?php echo $user["email"] ?>">
            </span>
            <span>
                <label for="tel">Tel : </label>
                <input type="text" value="<?php echo "+254".$user["phone"] ?>">
            </span>
            <span>
                <label for="apartment">Apartment Name</label>
                <input type="text" placeholder="Enter the appartment you'd like to rent in" value="<?php echo $appart["appart_name"] ?>">
            </span>
            <span>
                <select name="room_type" id="rooms" onchange="showUser(<?php echo $appart_id ?>)">
                    <option value="">Select a room</option>
                    <?php if($appart["bedsitter"]){ ?>
                        <option value="bedsitter">Studio appartment</option>
                    <?php } ?>
                    <?php if($appart["onebr"]){ ?>
                        <option value="onebr">One Bedroom</option>
                    <?php } ?>
                    <?php if($appart["twobr"]){ ?>
                        <option value="v">Two Bedroom</option>
                    <?php }?>
                    <?php if($appart["threebr"]){ ?>
                        <option value="threebr">Three Bedroom</option>
                    <?php } ?>
                    <?php if($appart["fourbr"]){ ?>
                        <option value="fourbr">Four Bedroom</option>
                    <?php } ?>
                    <?php if($appart["fivebr"]){ ?>
                        <option value="five">Five Bedroom</option>
                    <?php } ?>
                    <?php if($appart["sixbr"]){ ?>
                        <option value="sixbr">Six Bedroom</option>
                    <?php } ?>
                </select>
            </span>
            <button type="submit">Submit Request</button>
        </form>
        <script>
            function showUser(id) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let appartment = this.response
                            
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","getcost.php?appart_id="+id,true);
                    xmlhttp.send();
                }
            }
        </script>
    </div>    
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>