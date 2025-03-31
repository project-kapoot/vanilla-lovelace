"use strict";

import { newNavbar, newDialog } from './modules/functions.js';

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

const dialog = newDialog('dialog-profile');

dialog.openBtn.addEventListener('click', function() {
    dialog.showModal();
});

dialog.closeBtn.addEventListener('click', function() {
    dialog.close();
});

dialog.addEventListener('click', function(ev) {
    if(!dialog.body.contains(ev.target)) {
        dialog.close();
    }  
});