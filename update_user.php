<?php
session_start();
ini_set('display_errors',1);
ini_set("log_errors",1);
error_reporting(E_ALL);
ini_set('error_log','error_log');


if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Realers";

$conn = new mysqli($server,$user, $password, $db);

if($conn->connect_error){
    die("Connection to DB failed :".$conn->connect_error);
}

$fetch_user_stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
$fetch_user_stmt->bind_param("i",$_SESSION["user_id"]);

if(!$fetch_user_stmt){
    die("Prepare failed (fetch_user_stmt) :".$conn->error);
}
$fetch_user_stmt->execute();

$result = $fetch_user_stmt->get_result();


$fetch_user_stmt->close();
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="./Css/style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="script.js"></script>
</head>
<body>
    <div class="rcontainer">
        <h2>Update Profile</h2>
        <form action="update_user_script.php" method="POST" enctype="multipart/form-data">
        <?php while($user = $result->fetch_assoc()) { ?>
            <span class="update_user">
                <img src="<?php echo $user["profile"] ?>" alt="avatar">
                <span>
                    <label for="pfp">New Avatar:</label>
                    <input type="file" name="profile">
                </span>
            </span>
            <span>
                <label for="fname"> First Name : </label>
                <input type="text" name="fname" placeholder="John" value="<?php echo $user["firstname"] ?>">
            </span>
            <span>
                <label for="mname"> Maiden Name : </label>
                <input type="text" name="mname" placeholder="Doe" value="<?php echo $user["maidenname"] ?>">
            </span>
            <span>
                <label for="surnamename"> Surname : </label>
                <input type="text" name="surname" placeholder="Russel" value="<?php echo $user["surname"] ?>">
            </span>
            <span>
                <label for="email"> Email : </label>
                <input type="email" name="email" placeholder="Johndoe@example.com"  value="<?php echo $user["email"] ?>">
            </span>
            <span>
                <label for="phone"> Phone : </label>
                <span id="phoneflx">
                    <span>+254</span>
                    <input type="text" name="phone" placeholder="700 000 111" value="<?php echo $user["phone"] ?>">
                </span>
            </span>
            <button type="submit">Update</button>
            <?php } ?>
        </form>
        <span id="logintag">
            <a href="login.php">log in</a>
        </span>
    </div>
</body>
</html>