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

$appartImagePath;
$appart_name;
$rooms_count;
$description;
$location;
$bedsittercount;
$onebrcount;
$twobrcount;
$threebrcount;
$fourbrcount;
$fivebrcount;
$sixbrcount;
$bedsittercost;
$onebrcost;
$twobrcost;
$threebrcost;
$fourbrcost;
$fivebrcost;
$sixbrcost;


function validate_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["appart_name"])){
        echo "The appartment name is necessary";
    } elseif(empty($_POST["rooms_count"])){
        echo "Please specify how many rooms there are";
    } elseif(empty($_POST["location"])){
        echo "Specify where the Appartment is located please";
    } elseif(!empty($_POST["bscount"]) && empty($_POST["bscost"])){
        echo "Specify the cost of bedsiters indicated above";
    }elseif(empty($_POST["bscount"]) && !empty($_POST["bscost"])){
        echo "The appartment has no bedsitters";
    } elseif(!empty($_POST["onebrcount"]) && empty($_POST["onebrcost"])){
        echo "Specify the cost of One bedrooms indicated above";
    }elseif(empty($_POST["onebrcount"]) && !empty($_POST["onebrcost"])){
        echo "The appartment has no One bedrooms";
    }  elseif(!empty($_POST["twobrcount"]) && empty($_POST["twobrcost"])){
        echo "Specify the cost of 2 bedrooms indicated";
    }elseif(empty($_POST["twobrcount"]) && !empty($_POST["twobrcost"])){
        echo "The appartment has no 2 bedrooms";
    }  elseif(!empty($_POST["threebrcount"]) && empty($_POST["threebrcost"])){
        echo "Specify the cost of 3 bedrooms indicated above";
    }elseif(empty($_POST["threebrcount"]) && !empty($_POST["threebrcost"])){
        echo "The appartment has no 3 bedrooms";
    }  elseif(!empty($_POST["fourbrcount"]) && empty($_POST["fourbrcost"])){
        echo "Specify the cost of 4 bedrooms indicated above";
    }elseif(empty($_POST["fourbrcount"]) && !empty($_POST["fourbrcost"])){
        echo "The appartment has no four bedrooms";
    }  elseif(!empty($_POST["fivebrcount"]) && empty($_POST["fivebrcost"])){
        echo "Specify the cost of 5 bedrooms indicated above";
    }elseif(empty($_POST["fivebrcount"]) && !empty($_POST["fivebrcost"])){
        echo "The appartment has no 5 bedrooms";
    }  elseif(!empty($_POST["sixbrcount"]) && empty($_POST["sixbrcost"])){
        echo "Specify the cost of 6 bedrooms indicated above";
    }elseif(empty($_POST["sixbrcount"]) && !empty($_POST["sixbrcost"])){
        echo "The appartment has no 6 bedrooms";
    } elseif(empty($_POST["description"])){
        echo "Please provide a description for the users";
    } else{
        $appart_name = validate_input($_POST["appart_name"]);
        $rooms_count = $_POST["rooms_count"];
        $location = validate_input($_POST["location"]);
        $bedsittercount = validate_input($_POST["bscount"]);
        $bedsittercost = validate_input($_POST["bscost"]);
        $onebrcount = validate_input($_POST["onebrcount"]);
        $onebrcost = validate_input($_POST["onebrcost"]);
        $twobrcost = validate_input($_POST["twobrcost"]);
        $twobrcount = validate_input($_POST["twobrcount"]);
        $threebrcount = validate_input($_POST["threebrcount"]);
        $threebrcost = validate_input($_POST["threebrcost"]);
        $fourbrcount = validate_input($_POST["fourbrcount"]);
        $fourbrcost = validate_input($_POST["fourbrcost"]);
        $fivebrcount = validate_input($_POST["fivebrcount"]);
        $fivebrcost = validate_input($_POST["fivebrcost"]);
        $sixbrcount = validate_input($_POST["sixbrcount"]);
        $sixbrcost = validate_input($_POST["sixbrcost"]);
        $description = validate_input($_POST["description"]);
    }

    $targetDirectory = "uploads/appartments/";

    if(!file_exists($targetDirectory)){
        mkdir($targetDirectory,0777,true);
    }


    $appartImagePath = $targetDirectory . basename($_FILES["appartment"]["name"]);

    move_uploaded_file($_FILES["appartment"]["tmp_name"],$appartImagePath);

    $server = "localhost";
    $user = "admin";
    $dbpassword = "Admin@123";
    $db = "Realers";

    $conn = new mysqli($server,$user,$dbpassword,$db);

    if($conn->connect_error){
        die("Failed to connect to DB : ".$conn->connect_error);
    }

    $post_appartment_stmt = $conn->prepare("INSERT INTO appartments (appart_name,rooms_count,description,appart_picture,location) VALUES(?,?,?,?,?)");
    $post_appartment_stmt -> bind_param("sisss",$appart_name,$rooms_count,$description,$appartImagePath,$location);

    if(!$post_appartment_stmt){
        die("Prepare failed (post_appartment_stmt) : ".$conn->error);
    }

    $post_appartment_stmt->execute();
    $appart_id = $post_appartment_stmt->insert_id;

    $post_appart_type_stmt = $conn->prepare("INSERT INTO appartment_type (bedsitter,onebr,twobr,threebr,fourbr,fivebr,sixbr,appart_id) VALUES(?,?,?,?,?,?,?,?)");
    $post_appart_type_stmt->bind_param("iiiiiiii",$bedsittercount,$onebrcount,$twobrcount,$threebrcount,$fourbrcount,$fivebrcount,$sixbrcount,$appart_id);

    if(!$post_appart_type_stmt){
        die("Prepare failed (post_appart_type_stnt) : ". $conn->error);
    }


    
    $post_appart_costs_stmt = $conn->prepare("INSERT INTO costs (bedsitter,onebr,twobr,threebr,fourbr,fivebr,sixbr,appart_id) VALUES(?,?,?,?,?,?,?,?)");
    $post_appart_costs_stmt->bind_param("iiiiiiii",$bedsittercost,$onebrcost,$twobrcost,$threebrcost,$fourbrcost,$fivebrcost,$sixbrcost,$appart_id);

    if(!$post_appart_costs_stmt){
        die("Prepare failed (post_appart_costs_stmt) : ".$conn->error);
    }


        $post_appart_costs_stmt->execute();        
        $post_appart_type_stmt->execute();


    $post_appart_costs_stmt->close();
    $post_appart_type_stmt->close();
    $post_appartment_stmt->close();
    $conn->close();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="./Css/insert.css">
    <script src="script.js"></script>
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

    <div class="icontainer">
        <div class="sidenav">
            <a href="admin.php">Appartments</a>
            <a href="users.php">Users</a>
            <a href="requests.php">Requests</a>
            <a href="#" class="active">New Property</a>
        </div>
        <div class="larger">
            <h2>Add property details</h2>
            <form action="<?php  echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                <span>
                    <label for="name">Appartment Name : </label>
                    <input type="text" name="appart_name">
                </span>
                <span>
                    <label for="rooms">No of Rooms : </label>
                    <input type="text" name="rooms_count">
                </span>
                <span>
                    <label for="location">Location : </label>
                    <input type="text" name="location">
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="bscount">No of Bedsitters </label>
                        <input type="text" name="bscount">
                    </span>
                    <span>
                        <label for="bedsittercost">Cost </label>
                        <input type="text" name="bscost">
                    </span>
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="onebrcount">No of 1Brs </label>
                        <input type="text" name="onebrcount">
                    </span>
                    <span>
                        <label for="onebrcost">Cost </label>
                        <input type="text" name="onebrcost">
                    </span>
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="twobrcount">No of 2Brs </label>
                        <input type="text" name="twobrcount">
                    </span>
                    <span>
                        <label for="twobrcost">Cost </label>
                        <input type="text" name="twobrcost">
                    </span>
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="threebrcount">No of 3Brs </label>
                        <input type="text" name="threebrcount">
                    </span>
                    <span>
                        <label for="threebrcost">Cost </label>
                        <input type="text" name="threebrcost">
                    </span>
                </span>

                <span class="apprt_parts">
                    <span>
                        <label for="fourbrcount">No of 4Brs </label>
                        <input type="text" name="fourbrcount">
                    </span>
                    <span>
                        <label for="fourbrcost">Cost </label>
                        <input type="text" name="fourbrcost">
                    </span>
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="fivebrcount">No of 5Brs </label>
                        <input type="text" name="fivebrcount">
                    </span>
                    <span>
                        <label for="fivebrcost">Cost </label>
                        <input type="text" name="fivebrcost">
                    </span>
                </span>
                <span class="apprt_parts">
                    <span>
                        <label for="sixbrcount">No of 6Brs </label>
                        <input type="text" name="sixbrcount">
                    </span>
                    <span>
                        <label for="sixbrcost">Cost </label>
                        <input type="text" name="sixbrcost">
                    </span>
                </span>
                <span>
                    <label for="file">Appartment Image</label>
                    <input type="file" name="appartment">    
                </span>
                <span>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter a good description of the property you are adding for the appartment hunters"></textarea>
                </span>
                <button type="submit">Add Property</button>
            </form>
        </div>
    </div>
</body>
<footer>
    <span>&copy; copyright 2023 </span>

    <span>Made by Gathai Kariuki</span>
</footer>
</html>