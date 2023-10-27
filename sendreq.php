<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', 'error.log');

$server = "localhost";
$user="admin";
$dbpassword = "Admin@123";
$db = "Realers";

$appart_id;
$user_id = 4;
$approved;
$disapproved;
$type_id;
$room_type;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST)){
        echo "No values passed";
        exit;
    }
    
    
    $appart_id = $_POST["appart_id"];
    $room_type = $_POST["room_type"];
    $disapproved = 0;
    $approved = 0;
}
echo $_POST["room_type"];

if(strtolower($room_type) == "bedsitter"){
    $type_id = 1;
} elseif(strtolower($room_type) == "onebr"){
    $type_id = 2;
} elseif(strtolower($room_type) == "twobr"){
    $type_id = 3;
} elseif(strtolower($room_type) == "threebr"){
    $type_id = 4;
} elseif(strtolower($room_type) == "fourbr"){
    $type_id = 5;
} elseif(strtolower($room_type) == "fivebr"){
    $type_id = 6;
} elseif(strtolower($room_type) == "sixbr"){
    $type_id = 7;
} else{
    echo "Invalid value";
}

var_dump($type_id);

$conn = new mysqli($server, $user, $dbpassword, $db);

if($conn->connect_error){
    die("Connection to DB failed:". $conn->connect_error);
}

$send_req_stmt = $conn->prepare("INSERT INTO requests (user_id, approved, disapproved, appart_id, type_id) VALUES(?,?,?,?,?)");
$send_req_stmt->bind_param("iiiii",$user_id, $approved, $disapproved, $appart_id, $type_id);

if(!$send_req_stmt){
    die("Failed to prepare (send_req_stmt) : ".$conn->error);
}

$send_req_stmt->execute();

$send_req_stmt->close();
$conn->close();


header("Location: properties.php");
exit;

?>
