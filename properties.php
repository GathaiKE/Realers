<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realers</title>
    <link rel="stylesheet" href="/Css/">
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <div class="menu">
            <a href="#">Home</a>
            <a href="#" >Properties</a>
            <a href="#" >Single</a>
            <a href="#" >Rent</a>
            <a href="#" >Payment</a>
            <a href="#" >Admin</a>
            <a href="#" >Profile</a>
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
                <a href="#">Home</a>
                <a href="#" >Properties</a>
                <a href="#" >Single</a>
                <a href="#" >Rent</a>
                <a href="#" >Payment</a>
                <a href="#" >Admin</a>
                <a href="#" >Profile</a>
            </div>
        </div>
        <div class="login">
            <a  href="#" id="log">Log out</a>
        </div>
        <div class="pfp">
            <img src="./assets/pfp.webp" alt="profile" id="pfp-img">
        </div>
    </nav>
    <div class="props-container">
        <h1>Our Various Properties Across the country include</h1>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
        <div class="prop">
            <img src="./assets/landing.jpg" alt="house">
            <div class="parts">
                <span class="part">
                    <label for="name">Name : </label>
                    <span>Queenland Appartments</span>
                </span>
                <span class="part">
                    <label for="Cost">Rent(Monthly) : </label>
                    <span>Ksh 20000</span>
                </span>
                <span class="location">
                    <label for="name">Location : </label>
                    <span>Naivasha</span>
                </span>
               <span class="btns">
                    <button id="expand">Expand</button>
                    <button id="wish">Wishlist</button>
                </span>
            </div>
        </div>
    </div>
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>