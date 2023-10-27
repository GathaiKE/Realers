<?php

$appart_id;

if(isset($_GET["appart_id"])){
    $appart_id = $_GET["appart_id"];
}

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db="Realers";

$conn = new mysqli($server,$user,$password,$db);
if($conn->connect_error){
    die("Connection to db failed :".$conn->connect_error);
}

$delete_prop_stmt = $conn->prepare("DELETE FROM appartments WHERE appart_id=?");
$delete_prop_stmt->bind_param("i",$appart_id);
if(!$delete_prop_stmt){
    die("Prepare failed (delete_prop_stmt) :".$conn->error);
}

$delete_prop_stmt->execute();

$delete_prop_stmt->close();
$conn->close();

header("Location: admin.php");
exit;
?>