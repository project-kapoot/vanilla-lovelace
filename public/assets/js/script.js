import { newNavbar } from './modules/functions.js';

const navbar = newNavbar(
    document.querySelector('.navbar'),
    document.getElementById('navbar-toggle'),
    document.querySelector('.nav-toggler')
);

navbar.btn.addEventListener('click', function() {
    navbar.toggle();
});

document.addEventListener('click', function(ev) {
    if(!navbar.contains(ev.target) && navbar.isOpened === true) {
        navbar.close();
    }
});