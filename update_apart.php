<?php
session_start();
ini_set('display_errors',1);
ini_set("log_errors",1);
error_reporting(E_ALL);
ini_set('error_log','error_log');

if(!isset($_SESSION["user_id"])){
    header("Location:login.php");
    exit;
}
if($_SESSION["role"] !== "admin"){
    echo "Access denied. Admin Privileges required";
    exit;
}

$server="localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$appart_id;

if(isset($_GET["appart_id"])){
    $appart_id = $_GET["appart_id"];
}

$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection failed :".$conn->connect_error);
}

$fetch_appart_stmt = $conn->prepare("SELECT a.appart_name,a.rooms_count, a.description,a.location, a.appart_picture, t.bedsitter as tbs, t.onebr as t1br, t.twobr as t2br, t.threebr as t3br, t.fourbr as t4br, t.fivebr as t5br, t.sixbr as t6br, c.bedsitter as cbs, c.onebr as c1br, c.twobr as c2br, c.threebr as c3br, c.fourbr as c4br, c.fivebr as c5br, c.sixbr as c6br FROM appartments AS a LEFT JOIN appartment_type as t ON a.appart_id = t.appart_id LEFT JOIN costs as c ON t.appart_id = c.appart_id WHERE a.appart_id = ?");
$fetch_appart_stmt->bind_param("i",$appart_id);

if(!$fetch_appart_stmt){
    die("Prepare failed (fetch_appart_stmt) :".$conn->error);
}

$fetch_appart_stmt->execute();
$result = $fetch_appart_stmt->get_result();

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
        <div class="larger">
            <h2>Update Property Information</h2>
                <?php while($prop = $result->fetch_assoc()) {?>
                    <form action="update_apart_script.php" method="POST" enctype="multipart/form-data">
                        <span>
                            <label for="name">Appartment Name : </label>
                            <input type="text" name="appart_name" value="<?php echo $prop["appart_name"] ?>">
                        </span>
                        <span>
                            <label for="rooms">No of Rooms : </label>
                            <input type="text" name="rooms_count" value="<?php echo $prop["rooms_count"] ?>">
                        </span>
                        <span>
                            <label for="location">Location : </label>
                            <input type="text" name="location" value="<?php echo $prop["location"] ?>">
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="bscount">No of Bedsitters </label>
                                <input type="text" name="bscount" value="<?php echo $prop["tbs"] ?>">
                            </span>
                            <span>
                                <label for="bedsittercost">Cost </label>
                                <input type="text" name="bscost" value="<?php echo $prop["cbs"] ?>">
                            </span>
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="onebrcount">No of 1Brs </label>
                                <input type="text" name="onebrcount" value="<?php echo $prop["t1br"] ?>">
                            </span>
                            <span>
                                <label for="onebrcost">Cost </label>
                                <input type="text" name="onebrcost" value="<?php echo $prop["c1br"] ?>">
                            </span>
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="twobrcount">No of 2Brs </label>
                                <input type="text" name="twobrcount" value="<?php echo $prop["t2br"] ?>">
                            </span>
                            <span>
                                <label for="twobrcost">Cost </label>
                                <input type="text" name="twobrcost" value="<?php echo $prop["c2br"] ?>">
                            </span>
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="threebrcount">No of 3Brs </label>
                                <input type="text" name="threebrcount" value="<?php echo $prop["t3br"] ?>">
                            </span>
                            <span>
                                <label for="threebrcost">Cost </label>
                                <input type="text" name="threebrcost" value="<?php echo $prop["c3br"] ?>">
                            </span>
                        </span>

                        <span class="apprt_parts">
                            <span>
                                <label for="fourbrcount">No of 4Brs </label>
                                <input type="text" name="fourbrcount" value="<?php echo $prop["t4br"] ?>">
                            </span>
                            <span>
                                <label for="fourbrcost">Cost </label>
                                <input type="text" name="fourbrcost" value="<?php echo $prop["c4br"] ?>">
                            </span>
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="fivebrcount">No of 5Brs </label>
                                <input type="text" name="fivebrcount" value="<?php echo $prop["t5br"] ?>">
                            </span>
                            <span>
                                <label for="fivebrcost">Cost </label>
                                <input type="text" name="fivebrcost" value="<?php echo $prop["c5br"] ?>">
                            </span>
                        </span>
                        <span class="apprt_parts">
                            <span>
                                <label for="sixbrcount">No of 6Brs </label>
                                <input type="text" name="sixbrcount" value="<?php echo $prop["t6br"] ?>">
                            </span>
                            <span>
                                <label for="sixbrcost">Cost </label>
                                <input type="text" name="sixbrcost" value="<?php echo $prop["c6br"] ?>">
                            </span>
                        </span>
                        <span>
                            <label for="file">Appartment Image</label>
                            <img src="<?php echo $prop["appart_picture"]; ?>" alt="Appartment Image">
                            <input type="file" name="appartment" value="<?php echo $prop["appart_picture"] ?>">    
                        </span>
                        <span>
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"><?php echo $prop["description"] ?></textarea>
                        </span>
                        <input type="hidden" name="appart_id" value="<?php  echo $appart_id ?>">
                        <button type="submit">Update Property</button>
                    </form>
                <?php } ?>
        </div>
    </div>
</body>
<footer>
    <span>&copy; copyright 2023 </span>

    <span>Made by Gathai Kariuki</span>
</footer>
</html>