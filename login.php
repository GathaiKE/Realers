<?php

$server = getenv("DB_HOST");
$user = getenv("DB_USER");
$password = getenv("DB_PASS");
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
        <form action="" method="post">
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