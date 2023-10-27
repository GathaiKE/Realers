<?php

$user_id;

if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db="Realers";

$conn = new mysqli($server,$user,$password,$db);
if($conn->connect_error){
    die("Connection to db failed :".$conn->connect_error);
}

$delete_user_stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
$delete_user_stmt->bind_param("i",$user_id);
if(!$delete_user_stmt){
    die("Prepare failed (delete_prop_stmt) :".$conn->error);
}

$delete_user_stmt->execute();

$delete_user_stmt->close();
$conn->close();

header("Location: users.php");
exit;
?>