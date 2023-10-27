<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $to = "briannjeri9@gmail.com";
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $email = $_POST["email"];

    $headers= "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    mail($to,$subject,$message,$headers);
}

header("Location: index.php");
exit;

?>