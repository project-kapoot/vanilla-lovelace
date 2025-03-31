// afficher le menu déroulant

const navbar = newNavbar(
    document.querySelector('.navbar'),
    document.getElementById('navbar-toggle'),
    document.querySelector('.nav-toggler')
);

/**
 * 
 * @param {HTMLElement} nav La barre de navigation
 * @param {HTMLButtonElement} btn Le bouton qui permet d'ouvrir/fermer la barre de navigation
 * @param {HTMLElement} toggler L'élément a modifier pour que la barre de navigation change d'état
 * @returns {HTMLElement} La barre de navigation dont le prototype a été modifié
 * @throws {Error} Envoie une erreur si un argument est incorrect (null/undefined par exemple) ou si l'une des propriétés que l'on souhaite ajouter sur la barre de navigation existe déjà
 */
function newNavbar(nav, btn, menu) {
    const toggleClass = 'toggle-menu';

    for(let i = 0; i < arguments.length; i++) {
        const arg = arguments[i];
    
        if(arg === null) {
            throw new Error(`Cannot create a new navbar : argument ${arg} is null`);
        }

        if(arg === undefined) {
            throw new Error(`Cannot create a new navbar : argument ${arg} is undefined`);
        }
    }

    const navbar = {
        btn: btn,
        isOpened: false,
        close: function() {
            this.isOpened = false;

            menu.classList.remove(toggleClass);
        },
        open: function() {
            this.isOpened = true;

            menu.classList.add(toggleClass)
        },
        toggle: function() {
            (menu.classList.contains(toggleClass)) ? this.close() : this.open();
        },
    }

    for(const prop in navbar) {
        if(nav[prop] !== undefined) {
            throw new Error(`Cannot create a new navbar : property ${prop} is already defined on ${nav}`);
        }

        nav[prop] = navbar[prop];
    }

    return nav;
}

navbar.btn.addEventListener('click', function() {
    navbar.toggle();
});

document.addEventListener('click', function(ev) {
    if(!navbar.contains(ev.target) && navbar.isOpened === true) {
        navbar.close();
    }
});