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
            <a href="/index.php">Home</a>
            <a href="/properties.php" >Properties</a>
            <a href="/single.php" >Single</a>
            <a href="/rent.php" >Rent</a>
            <!-- <a href="#" >Payment</a> -->
            <a href="/admin.php" >Admin</a>
            <a href="/profile.php" >Profile</a>
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
                <a href="/properties.php" >Properties</a>
                <a href="/single.php" >Single</a>
                <a href="/rent.php" >Rent</a>
                <a href="/payment.php" >Payment</a>
                <a href="/admin.php" >Admin</a>
                <a href="/profile.php" >Profile</a>
            </div>
        </div>
        <div class="login">
            <a  href="#" id="log">Log out</a>
        </div>
        <div class="pfp">
            <img src="./assets/pfp.webp" alt="profile" id="pfp-img">
        </div>
    </nav>

    <div class="profile-container">
        <h2>Your Profile</h2>

        <div class="profile">
            <img src="./assets/pfp.webp" alt="profile picture">
            <span>
                <label for="fname"> First Name : </label>
                <span>John</span>
            </span>
            <span>
                <label for="mname">Maiden Name : </label>
                <span>Doe</span>
            </span>
            <span>
                <label for="sname">Surname : </label>
                <span> Garret</span>
            </span>
            <span>
                <label for="email">Email : </label>
                <span>johndoe@gmail.com</span>
            </span>
            <span>
                <label for="tel">Telephone : </label>
                <span>+254 7121 66 018</span>
            </span>
            <span>
                <label for="appartment">Residence : </label>
                <span>Queensland appartments</span>
            </span>
            <span>
                <label for="houseno">appartment Number : </label>
                <span>40</span>
            </span>
            <span>
                <label for="balance">Balance : </label>
                0
            </span>
            <button id="expand">Update</button>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>