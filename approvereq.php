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

$server = "localhost";
$user = "admin";
$dbpassword = "Admin@123";
$db = "Realers";


$appart_id;
$user_id;
$house_no;
$message;
$type_id;
$appart_id;
$payment_code;



$req_id;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST)){
        echo "Cannot accept empty form";
    }

    $house_no = $_POST["house_no"];
    $feedback = $_POST["feedback"];
    $req_id = $_POST["reqid"];
}

$conn = new mysqli($server, $user, $dbpassword, $db);

if($conn->connect_error){
    die("Connection to DB failed : ".$conn->connect_error);
}

$fetch_req= $conn->prepare("SELECT r.user_id, r.appart_id, r.type_id  FROM requests AS r INNER JOIN appartments AS a ON a.appart_id = r.appart_id WHERE a.appart_id = r.appart_id AND r.req_id = ?");
$fetch_req->bind_param("i",$req_id);

if(!$fetch_req){
    die("Failed to prepare request (fetch_req) : ".$conn->error);
}

$fetch_req->execute();

$result = $fetch_req->get_result();
$request = $result->fetch_assoc();

if(!$request){
  echo "Request not found"; 
  exit;
}

$user_id = $request["user_id"];
$type_id = $request["type_id"];
$appart_id = $request["appart_id"];


$assign_room_stmt = $conn->prepare("INSERT INTO occupied (room_no, appart_id, type_id) VALUES(?,?,?)");
$assign_room_stmt->bind_param("iii",$house_no, $appart_id, $occby);


if(!$assign_room_stmt){
    die("Prepare failed (assign_room_stmt) :".$conn->error);
}

$assign_room_stmt->execute();

$update_apprv_stmt = $conn->prepare("UPDATE requests SET approved = 1 WHERE req_id = ?");
$update_apprv_stmt->bind_param("i",$req_id);

if(!$update_apprv_stmt){
    die("prepare failed (update_apprv_stmt) :".$conn->error);
}

$update_apprv_stmt->execute();

$occ_id = $assign_room_stmt->insert_id;

$set_room_occupied = $conn->prepare("INSERT INTO occupied_by (user_id, occ_id) VALUE(?,?)");
$set_room_occupied->bind_param("ii",$user_id,$occ_id);

if(!$set_room_occupied){
    die("Prepare failed (set_room_occupied) :".$conn->error);
}

$set_room_occupied->execute();

$occby_id = $set_room_occupied->insert_id;

$add_feedback_stmt = $conn->prepare("INSERT INTO feedback (feedback, req_id) VALUES(?, ?)");
$add_feedback_stmt -> bind_param("si",$feedback,$req_id);

if(!$add_feedback_stmt){
    die("Prepare failed (add_feedback_stmt) :".$conn->error);
}

$add_feedback_stmt->execute();


$fetch_cost = $conn->prepare("SELECT * FROM costs WHERE appart_id=?");
$fetch_cost->bind_param("i",$request["appart_id"]);

if(!$fetch_cost){
    die("Prepare failed (Fetch_cost) :".$conn->error);
}

$fetch_cost->execute();

$cost = ($fetch_cost->get_result())->fetch_assoc();

switch ($request["type_id"]) {
    case 1:
        $amount = $cost["bedsitter"];
        break;
    case 2:
        $amount = $cost["onebr"];
        break;
    case 3:
        $amount = $cost["twobr"];
        break;
    case 4:
        $amount = $cost["threebr"];
        break;
    case 5:
        $amount = $cost["fourbr"];
        break;
    case 6:
        $amount = $cost["fivebr"];
        break;
    case 7:
        $amount = $cost["sixbr"];
        break;
    default:
        $amount = 0;
        break;
}

$set_balance_stmt = $conn->prepare("INSERT INTO rent_balance (amount, occby_id) VALUES(?,?)");
$set_balance_stmt->bind_param("ii", $amount, $occby_id);

if(!$set_balance_stmt){
    die("Prepare failed (set_balance_stmt) :".$conn->error);
}

$set_balance_stmt->execute();

$fetch_req->close();
$assign_room_stmt->close();
$update_apprv_stmt->close();
$set_room_occupied->close();
$add_feedback_stmt->close();
$set_balance_stmt->close();
$conn->close();

header("Location:requests.php");
Exit;

?>