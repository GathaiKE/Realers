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


$u_appart_name;
$u_location;
$u_description;
$u_rooms_count;
$u_appart_picture;
$u_bs_cost;
$u_1br_cost;
$u_2br_cost;
$u_3br_cost;
$u_4br_cost;
$u_5br_cost;
$u_6br_cost;
$u_bs_cost;
$u_bs_count;
$u_1br_count;
$u_2br_count;
$u_3br_count;
$u_4br_count;
$u_5br_count;
$u_6br_count;
$appart_id;

function validate_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $u_appart_name = validate_data($_POST["appart_name"]);
    $u_rooms_count = validate_data($_POST["rooms_count"]);
    $u_location = validate_data($_POST["location"]);
    $u_description = validate_data($_POST["description"]);
    $u_bs_count = $_POST["bscount"];
    $u_bs_cost = $_POST["bscost"];
    $u_1br_count = $_POST["onebrcount"];
    $u_1br_cost = $_POST["onebrcost"];
    $u_2br_count = $_POST["twobrcount"];
    $u_2br_cost = $_POST["twobrcost"];
    $u_3br_count = $_POST["threebrcount"];
    $u_3br_cost = $_POST["threebrcost"];
    $u_4br_count = $_POST["fourbrcount"];
    $u_4br_cost = $_POST["fourbrcost"];
    $u_5br_count = $_POST["fivebrcount"];
    $u_5br_cost = $_POST["fivebrcost"];
    $u_6br_count = $_POST["sixbrcount"];
    $u_6br_cost = $_POST["sixbrcost"];
    $appart_id = (int)$_POST["appart_id"];
    $u_4br_count = $_POST["fourbrcount"];
}

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$conn = new mysqli($server, $user, $password, $db);
if($conn->connect_error){
    die("Database connection failed :".$conn->connect_error);
}

$targetDirectory = "uploads/appartments/";

if(!file_exists($targetDirectory)){
    mkdir($targetDirectory,0777,true);
}

$u_imagePath = $targetDirectory.basename($_FILES["appartment"]["name"]);

move_uploaded_file($_FILES["appartment"]["tmp_name"],$u_imagePath);

$u_appart_picture=$u_imagePath;

$update_prop_stmt = $conn->prepare("UPDATE appartments SET appart_name=?,rooms_count=?,description=?,appart_picture=?,location=? WHERE appart_id=?");
$update_prop_stmt->bind_param("sisssi",$u_appart_name,$u_rooms_count,$u_description,$u_appart_picture,$u_location,$appart_id);
if(!$update_prop_stmt){
    die("Prepare failed (update_prop_stmt)".$conn->error);
}
$update_prop_stmt->execute();

$update_costs_stmt = $conn->prepare("UPDATE costs SET bedsitter=?,onebr=?,twobr=?,threebr=?,fourbr=?,fivebr=?,sixbr=? WHERE appart_id=?");
$update_costs_stmt->bind_param("iiiiiiii",$u_bs_cost,$u_1br_cost,$u_2br_cost,$u_3br_cost,$u_4br_cost,$u_5br_cost,$u_6br_cost,$appart_id);
if(!$update_costs_stmt){
    die("Prepare failed (update_costs_stmt) :".$conn->error);
}
$update_costs_stmt->execute();

$update_type_stmt = $conn->prepare("UPDATE appartment_type SET bedsitter=?, onebr=?, twobr=?, threebr=?, fourbr=?, fivebr=?, sixbr=? WHERE appart_id=?");
$update_type_stmt->bind_param("iiiiiiii",$u_bs_count,$u_1br_count,$u_2br_count,$u_3br_count,$u_4br_count,$u_5br_count,$u_6br_count,$appart_id);
if(!$update_type_stmt){
    die("Prepare failed (update_type_stmt) :".$conn->error);
}
$update_type_stmt->execute();

header("Location: admin.php");
exit;
?>