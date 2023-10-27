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

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$conn = new mysqli($server,$user, $password, $db);

if($conn->connect_error){
    die("Connection to DB failed :".$conn->connect_error);
}

$u_firstname;
$u_maidenname;
$u_surname;
$u_email;
$u_phone;
$u_profile;

function validate_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["fname"]) && !empty($_POST["fname"])){
        $u_firstname = validate_data($_POST["fname"]);
    }

    if(isset($_POST["mname"]) && !empty($_POST["mname"])){
        $u_maidenname = validate_data($_POST["mname"]);
    }

    if(isset($_POST["surname"]) && !empty($_POST["surname"])){
        $u_surname = validate_data($_POST["surname"]);
    }

    if(isset($_POST["email"]) && !empty($_POST["email"])){
        $u_email = validate_data($_POST["email"]);
    }

    if(isset($_POST["phone"]) && !empty($_POST["phone"])){
        $u_phone = validate_data($_POST["phone"]);
    }
}

$targetDirectory = "uploads/profile_pictures/";

    if(!file_exists($targetDirectory)){
        mkdir($targetDirectory,0777,true);
    }

    $u_profile = $targetDirectory . basename($_FILES["profile"]["name"]);

    move_uploaded_file($_FILES["profile"]["tmp_name"],$u_profile);


    $update_stmt = $conn->prepare("UPDATE users SET profile=?, firstname=?,maidenname=?,surname=?,email=?,phone=? WHERE user_id = ?");
    $update_stmt->bind_param("ssssssi",$u_profile,$u_firstname,$u_maidenname,$u_surname,$u_email,$u_phone,$_SESSION["user_id"]);

    if(!$update_stmt){
        die("Prepare failed (update_stmt) :".$conn->error);
    }

    $update_stmt->execute();

    $update_stmt->close();
    $conn->close();

    header("Location: profile.php");
    exit;

?>