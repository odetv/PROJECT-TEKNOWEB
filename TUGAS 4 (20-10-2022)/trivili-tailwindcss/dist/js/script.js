// Membuat Navbar Fixed
window.onscroll = function() {
    const header   = document.querySelector('header');
    const fixedNav = header.offsetTop;
    const btnReturn= document.querySelector('#btn-return');

    if(window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
        btnReturn.classList.remove('hidden'); //Toggle Return Home
        btnReturn.classList.add('flex');
    }
    else {
        header.classList.remove('navbar-fixed');
        btnReturn.classList.remove('flex'); //Toggle Return Home
        btnReturn.classList.add('hidden');
    }
};

// Membuat Menu Hamburger
const menuHamburger = document.querySelector('#menu-hamburger');
const navMenu = document.querySelector('#nav-menu');
menuHamburger.addEventListener('click', function() {
    menuHamburger.classList.toggle('menu-hamburger-active');
    navMenu.classList.toggle('hidden');
});

// Klik Without Menu Hamburger
window.addEventListener('click', function(e) {
    if(e.target != menuHamburger && e.target != navMenu) {
        menuHamburger.classList.remove('menu-hamburger-active');
        navMenu.classList.add('hidden');
    }
});

// Dark Mode
// const darkToggle = document.querySelector('#dark-toggle');
// const html = document.querySelector('html');

// darkToggle.addEventListener('click', function() {
//     if(darkToggle.checked) {
//         html.classList.add('dark');
//     }
//     else {
//         html.classList.remove('dark');
//     }
// });