let mobileMenu = document.querySelector('.mobile');
let menuBtn = document.querySelector('.menu-btn');

let show = true

function openToggle() {
    mobileMenu.classList.toggle('open')
}


window.addEventListener("beforeunload", function (event) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", false);
    xhr.send();
});


window.addEventListener("beforeunload", function (event) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php?tab_closed=true", false);
    xhr.send();
});

