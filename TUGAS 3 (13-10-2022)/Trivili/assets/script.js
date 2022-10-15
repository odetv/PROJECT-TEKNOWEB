//console.log("created by Gelgel");
//const testing = document;
//console.log(testing);

const menuBar = document.querySelector(".menu-bar");
const menuNav = document.querySelector(".menu-navigation");
menuBar.addEventListener("click", function () {
    menuNav.classList.toggle("active");
});