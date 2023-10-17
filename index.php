<?php
if(isset($_GET["page"])){
    $page = $_GET["page"];

    if($page == "properties"){
        include('properties.php');
    } elseif($page == "profile"){
        include("profile.php");
    } elseif($page == "requests"){
        include("requests.php");
    } elseif($page == "insert"){
        include("insert.php");
    } elseif($page == "single"){
        include("single.php");
    } elseif($page == "users"){
        include("users.php");
    } elseif($page == "payment"){
        include("payment.php");
    } elseif($page = "admin"){
        include("admin.php");
    } elseif($page == "rent"){
        include("rent.php");
    } else{
        include("index.php");
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
    <nav>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="properties.php" >Properties</a>
            <a href="single.php" >Single</a>
            <a href="rent.php" >Rent</a>
            <a href="payment.php" >Payment</a>
            <a href="admin.php" >Admin</a>
            <a href="profile.php" >Profile</a>
        </div>

        <div class="mobile menu">
            <div class="ham">
                <span id="menu-btn" 
                onclick="openToggle()">
                    <span class="ham-top"></span>
                    <span class="ham-middle"></span>
                    <span class="ham-bottom"></span>
                </span>
            </div>
            <div class="m-menu">
                <a href="index.php">Home</a>
                <a href="properties.php" >Properties</a>
                <a href="single.php" >Single</a>
                <a href="rent.php" >Rent</a>
                <a href="payment.php" >Payment</a>
                <a href="admin.php" >Admin</a>
                <a href="profile.php" >Profile</a>
            </div>
        </div>
        <div class="login">
            <a  href="#" id="log">Log In</a>
            <a  href="#" id="reg">Sign Up</a>
        </div>
        <div class="pfp">
            <img src="./assets/pfp.webp" alt="profile" id="pfp-img">
        </div>
    </nav>

    <div class="container">

        <div class="cover">
            <h1>REALERS REAL ESTATE AGENCY</h1>
            <h2>Live with us, live large, live classy</h2>
            <button id="sign-up">Sign Up</button>
        </div>
    </div>
    <div class="mid-section">
        <div class="cards">
            <div class="card1">
                <h2>Affordable</h2>
                <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab necessitatibus optio, accusamus illo qui error voluptates deleniti unde. Odio quaerat vitae obcaecati cum aspernatur ipsum quas similique corrupti explicabo labore!
                </p>
            </div>
            <div class="card2">
                <h2>Classy</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab necessitatibus optio, accusamus illo qui error voluptates deleniti unde. Odio quaerat vitae obcaecati cum aspernatur ipsum quas similique corrupti explicabo labore!
                </p>
            </div>
            <div class="card3">
                <h2>Secure</h2>
                <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab necessitatibus optio, accusamus illo qui error voluptates deleniti unde. Odio quaerat vitae obcaecati cum aspernatur ipsum quas similique corrupti explicabo labore!
                </p>
            </div>
        </div>
    </div>
    <div class="about-us">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum laborum ipsa at quidem temporibus sint repudiandae quis eveniet magni! Sit nisi consequatur laudantium. Consequuntur similique eius delectus libero voluptatibus reiciendis dicta iusto perferendis tenetur asperiores atque porro vel, fuga cum ducimus in sapiente id alias architecto veritatis natus a. Aut aliquam, assumenda maiores soluta a odit, numquam aperiam iste nulla amet dolores, molestias eveniet ratione illo? In, deserunt repellendus. Saepe sed qui possimus optio, asperiores tenetur omnis, dicta ex officiis corporis obcaecati, modi cumque consequatur voluptates perferendis quod adipisci aperiam minus ipsa nemo amet odio! Laudantium accusamus eum fugiat enim!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas praesentium vel aspernatur modi iusto, cumque totam consequuntur beatae, molestiae pariatur ducimus voluptas ab? Veritatis earum doloremque soluta perspiciatis quae tempora mollitia nesciunt pariatur voluptate qui libero id architecto aut suscipit laboriosam, consectetur eaque aliquam repellat hic corporis? Suscipit, tenetur officiis.</p>
    </div>
    <div class="contact-us">
        <h2>Contact Us</h2>
        <p>Send us a message today and we will get back to you as soon as possible</p>
        <form action="contact.php">
            <span>
                <label for="name">Name :</label> <input type="text" name="name" id="name">
            </span>
            <span>
                <label for="subject">Subject : </label><input type="text" name="subject">
            </span>
            <span>
                <label for="message">Message : </label><textarea name="message" id="" cols="30" rows="10"></textarea>
            </span>
            <button type="submit">Send</button>
        </form>
        <ul>
            <li><label for="gmail">Email : </label>realers@gmail.com</li>
            <li><label for="tel">Tel : </label> +254 798 000 000</li>
            <li><label for="location">Location : </label> Realers Plaza Nairobi, Kenya</li>
        </ul>
    </div>
</body>
<footer>
    <span>&copy; copyright 2023 </span>

    <span>Made by Gathai Kariuki</span>
</footer>
</html>