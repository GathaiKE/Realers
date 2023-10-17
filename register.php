<?php

$server = $_SERVER["SERVER_NAME"];
$user= "admin";
$dbpassword = "Admin@123";
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

$firstname;
$maidenname;
$surname;
$email;
$password;
$err;
$phone;
$role = "user";


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty($_POST['fname'])){
        $err = "First name is required";
    } elseif(empty($_POST['mname'])){
        $err = "Maiden / Middle name is necessary";
    } elseif(empty($_POST["surname"])){
        $err = "Surname is Required";
    } elseif(empty($_POST["email"])){
        $err = "Email is necessary";
    } elseif(empty($_POST["password"])){
        $err = "Password is required";
    } elseif(empty($_POST["phone"])){
        $err = "Phone number is required";
    } else{
        $firstname = validate_data($_POST["fname"]);
        $maidenname = validate_data($_POST["mname"]);
        $surname = validate_data($_POST["surname"]);
        $email = validate_data($_POST["email"]);
        $password = validate_data($_POST["password"]);
        $phone = validate_data($_POST["phone"]);
        $password = password_hash($password,PASSWORD_DEFAULT);
    }


    $conn = new mysqli($server, $user, $dbpassword,$db);

    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }

    $reg_stmt = $conn->prepare("INSERT INTO users (firstname, maidenname,surname,email,phone,role,password,profile) VALUES(?,?,?,?,?,?,?,?)");
    $reg_stmt->bind_param("ssssssss",$firstname,$maidenname,$surname,$email, $phone, $role, $password,$profile);

    if(!$reg_stmt){
        die("Reg prepare failed!".$conn->error);
    }


    $reg_stmt->execute();

    echo "Registration Successfull!";


    function validate_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $reg_stmt->close();
    $conn->close();
} else{
    echo "Unknown error occured";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="./Css/style.css">
</head>
<body>
    <div class="rcontainer">

        <h2>Sign Up</h2>
        <form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
            <span>
                <label for="fname"> First Name : </label>
                <input type="text" name="fname" placeholder="John">
            </span>
            <span>
                <label for="mname"> Maiden Name : </label>
                <input type="text" name="mname" placeholder="Doe">
            </span>
            <span>
                <label for="surnamename"> Surname : </label>
                <input type="text" name="surname" placeholder="Russel">
            </span>
            <span>
                <label for="email"> Email : </label>
                <input type="email" name="email" placeholder="Johndoe@example.com">
            </span>
            <span>
                <label for="phone"> Phone : </label>
                <span id="phoneflx">
                    <span>+254</span>
                    <input type="text" name="phone" placeholder="700 000 111">
                </span>
            </span>
            <span>
                <label for="password">Password : </label>
                <input type="password" name="password" placeholder="Enter a strong password">
            </span>
            <button type="submit" onclick="window.location.href='login.php'">Register</button>
        </form>
        <span id="logintag">
            <a href="login.php">log in</a>
        </span>
    </div>
</body>
</html>