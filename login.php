<?php
session_start();
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', 'error.log');

$server = "localhost";
$dbpassword = "Admin@123";
$user = "admin";
$db = "Realers";

if(isset($_GET["page"])){
    $page = $_GET['page'];

    if($page == "register"){
        include("register.php");
    } elseif($page == "properties"){
        include("properties.php");
    } elseif($page == "login"){
        include("login.php");
    }
}

$err;
$entered_email;
$entered_password;
$user_data;
$result;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST)){
        $err = "No details submitted";
        echo $err;
    } else{
        $entered_email = validate_data($_POST["email"]);
        $entered_password = validate_data(($_POST["password"]));

        if(!filter_var($entered_email, FILTER_VALIDATE_EMAIL)){
            $err = "This is not a valid email";
            echo $err;
        }
    }

$conn = new mysqli($server,$user, $dbpassword,$db);

if($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}

    $fetch_stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $fetch_stmt-> bind_param("s",$entered_email);

    if(!$fetch_stmt){
        die("Failed to prepare stmt : ".$conn->error);
    }

    if($fetch_stmt -> execute()){
        $result = $fetch_stmt-> get_result();
        $user_data = $result -> fetch_assoc();

        if($user_data){
            $user_password = $user_data["password"];

            if(!password_verify($entered_password,$user_password)){
                $err = "Incorrect password or email";
                echo $err;
            } else{
                $_SESSION["user_id"] = $user_data['user_id'];
                $_SESSION["role"] = $user_data["role"];
                $_SESSION["pfp"] = $user_data["profile"];
                header("Location:properties.php");
                exit;
            }
        } else{
            $err = "User doesn't exist";
            echo $err;
        }


        $fetch_stmt -> close();
    } else{
        die("Failed to fetch user : ".$conn->error);
    }
    $conn-> close();
}


function validate_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="./Css/style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="logincontainer">

        <h2>Sign Up</h2>
        <form action="<?php  echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <span>
                <label for="email"> Email : </label>
                <input type="email" name="email" placeholder="Johndoe@example.com">
            </span>
            <span>
                <label for="password">Password : </label>
                <input type="password" name="password" placeholder="Enter a strong password">
            </span>
            <button type="submit" onclick="window.location.href='properties.php'">login</button>
        </form>
        <span id="logintag">
            <span>Dont have an account ? </span>
            <a href="register.php">Register</a>
        </span>
    </div>
</body>
</html>