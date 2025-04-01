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

const socket = new WebSocket('http://kapoot.localhost:443')

socket.addEventListener('error', function(ev) {
    console.log('Websocket error : ', ev)
})

socket.addEventListener('close', function(ev) {
    console.log('Websocket closing : ', ev)
})
