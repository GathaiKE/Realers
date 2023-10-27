<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit;
}

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$user_id = $_SESSION["user_id"];
$occby_id;
$user_rent;
$standing_balance;
$new_balance;
$amount;
$payment_code;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["amount"])){
        echo "Amount cannot be empty";
        exit;
    } else{
        $amount = (int)$_POST["amount"];
    }

    if(empty($_POST["code"])){
        echo "Payment code is required";
        exit;
    } else{
        $payment_code = $_POST["code"];
    }
}

$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection to database failed :".$conn->connect_error);
}

$fetch_details_stmt = $conn->prepare("SELECT * FROM occupied_by WHERE user_id=?");
$fetch_details_stmt->bind_param("i",$user_id);

if(!$fetch_details_stmt){
    die("Prepare failed (fetch_details_stmt) :".$conn->error);
}

$fetch_details_stmt->execute();

$user_result = $fetch_details_stmt->get_result();
$user = $user_result->fetch_assoc();

if($user){
    $occby_id = $user["id"];
}

$get_balance_stmt = $conn->prepare("SELECT * FROM rent_balance WHERE occby_id = ?");
$get_balance_stmt->bind_param("i",$occby_id);
echo "Occby_id : ".$occby_id;

if(!$get_balance_stmt){
    die("Prepare failed (get_balance_stmt) :".$conn->error);
}


$get_balance_stmt->execute();

$balance_result = $get_balance_stmt->get_result();
$temp_balance = $balance_result->fetch_assoc();

if($temp_balance){
    $standing_balance = $temp_balance["amount"];
}

$occ_id = $user["occ_id"];

$get_appart_details_stmt = $conn->prepare("SELECT * FROM occupied WHERE id=?");
$get_appart_details_stmt ->bind_param("i",$occ_id);
if(!$get_appart_details_stmt){
    die("Prepare failed (get_appart_details_stmt) : ".$conn->error);
}

$get_appart_details_stmt->execute();
$appart_result = $get_appart_details_stmt->get_result();

$appartment = $appart_result->fetch_assoc();

$fetch_user_rent = $conn->prepare("SELECT bedsitter,onebr,twobr,threebr,fourbr,fivebr,sixbr FROM costs WHERE appart_id=?");
$fetch_user_rent->bind_param("i",$appartment["appart_id"]);

if(!$fetch_user_rent){
    die("Prepare failed (fetch_user_rent) : ".$conn->error);
}

$fetch_user_rent->execute();
$rent_result = ($fetch_user_rent->get_result())->fetch_assoc();

$type_id = $appartment["type_id"];

switch ($type_id) {
    case 1:
        $user_rent = $rent_result["bedsitter"];
        break;
    case 2:
        $user_rent = $rent_result["onebr"];
        break;
    case 3:
        $user_rent = $rent_result["twobr"];
        break;
    case 4:
        $user_rent = $rent_result["threebr"];
        break;
    case 5:
        $user_rent = $rent_result["fourbr"];
        break;
    case 6:
        $user_rent = $rent_result["fivebr"];
        break;
    case 7:
        $user_rent = $rent_result["sixbr"];
        break;
    default:
        echo $type_id;
        break;
}


$add_payment_stmt = $conn->prepare("INSERT INTO paid_rent(amount, payment_code, occby_id) VALUES(?,?,?)");
$add_payment_stmt -> bind_param("isi",$amount, $payment_code, $occby_id);

if(!$add_payment_stmt){
    die("Prepare failed (add_payment_stmt) : ".$conn->error);
}

$add_payment_stmt->execute();

if($amount >= $standing_balance){
    $new_balance = $amount - $standing_balance;
} else{
    $new_balance = $standing_balance - $amount;
}

$update_balance_stmt = $conn->prepare("UPDATE rent_balance SET amount= ? WHERE occby_id=?");
$update_balance_stmt->bind_param("ii",$new_balance,$occby_id);

if(!$update_balance_stmt){
    die("Prepare failed (update_balance_stmt) : ".$conn->error);
}

$update_balance_stmt->execute();


$fetch_details_stmt->close();
$get_balance_stmt->close();
$update_balance_stmt->close();
$add_payment_stmt->close();
$fetch_user_rent->close();
$get_appart_details_stmt->close();
$conn->close();
?>