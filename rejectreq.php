<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

if($_SESSION["role"] !== "admin"){
    echo "Access denied! Admin privileges required";
    header("Location: login.php");
    exit;
}

$server= "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST["reqid"]){
        $req_id = $_POST["reqid"];
    }
    if($_POST["feedback"]){
        $feedback = $_POST["feedback"];
    }
}

$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection to database failed :".$conn->connect_error);
}

$reject_stmt = $conn->prepare("UPDATE requests SET disapproved=1 WHERE req_id=?");
$reject_stmt->bind_param("i",$req_id);

if(!$reject_stmt){
    die("Prepare statement failed : ".$conn->error);
}

$reject_stmt->execute();
$reject_stmt->close();

$send_feedback_stmt = $conn->prepare("INSERT INTO feedback (feedback, req_id) VALUES(?,?)");
$send_feedback_stmt->bind_param("si",$feedback,$req_id);
if(!$send_feedback_stmt){
    die("Prepare failed :".$conn->error);
}

$send_feedback_stmt->execute();

$send_feedback_stmt->close();
$conn->close();

header("Location: requests.php");
exit;
?>