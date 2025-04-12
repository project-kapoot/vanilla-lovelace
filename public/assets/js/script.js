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

// Remplacement du try ... catch pour une méthode plus élaborée et qui assure qu'on doit prendre en compte l'erreur
// Voir : https://www.youtube.com/watch?v=Y6jT-IkV0VM pour une méthode qui reprend un peu ce principe
const [dialog, error] = newDialog('dialog-profile');

if(dialog !== null) {
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
}

const port = '8080'
const socket = new WebSocket(`${window.location.origin}:${port}`)

socket.addEventListener('error', function(ev) {
    console.log('Websocket error : ', ev)
})

socket.addEventListener('close', function(ev) {
    console.log('Websocket closing : ', ev)
})

socket.addEventListener('open', function(ev) {
    console.log('Websocket opened')
    const string = 'x'.repeat(124)
    socket.send(string)
})