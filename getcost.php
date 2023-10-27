<?php

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
    die("Connection failed : ".$conn->connect_error);
}

$get_cost = $conn->prepare("SELECT * FROM costs WHERE appart_id = ?");
$get_cost->bind_param("i",$appart_id);

if(!$get_cost){
    die("Prepare failed (get_cost) : ".$conn->error);
}

$get_cost->execute();
$result = $get_cost->get_result();
$costs = $result->fetch_assoc();

echo json_encode($costs);

$get_cost->close();
$conn->close();

?>
