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
    <div class="rent-container">
        <h1>Rent an Appartment</h1>
        <p>Fill in the form below and submit the request to rent your preferred appartment and our team will get back to you to verify your details.</p>
        <form action="">
            <span>
                <label for="name">Tenant Name : </label>
                <input type="text" value="John Doe">
            </span>
            <span>
                <label for="email">Email : </label>
                <input type="text" value="johndoe@email.com">
            </span>
            <span>
                <label for="tel">Tel : </label>
                <input type="text" value="+254712166018">
            </span>
            <span>
                <label for="apartment">Apartment Name</label>
                <input type="text" placeholder="">
            </span>
            <span>
                <select name="rooms" id="rooms">
                    <option value="">Select a room</option>
                    <option value="studio">Studio appartment</option>
                    <option value="one">One Bedroom</option>
                    <option value="two">Two Bedroom</option>
                    <option value="three">Three Bedroom</option>
                </select>
            </span>
            <span id="cost">
                <label for="cost">Rent(monthly) : </label>
                <span>
                    15000
                </span>
            </span>
            <button type="submit">Submit Request</button>
        </form>
    </div>    
</body>
<footer>
        <span>&copy; copyright 2023 </span>

        <span>Made by Gathai Kariuki</span>
</footer>
</html>