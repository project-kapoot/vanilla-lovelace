/**
 * 
 * @param {HTMLElement} nav La barre de navigation
 * @param {HTMLButtonElement} btn Le bouton qui permet d'ouvrir/fermer la barre de navigation
 * @param {HTMLElement} toggler L'élément a modifier pour que la barre de navigation change d'état
 * @returns {HTMLElement} La barre de navigation dont le prototype a été modifié
 * @throws {Error} Envoie une erreur si un argument est incorrect (null/undefined par exemple) ou si l'une des propriétés que l'on souhaite ajouter sur la barre de navigation existe déjà
 */
export function newNavbar(nav, btn, menu) {
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

/**
 * @param {HTMLDialogElement} element La boite de dialogue concernée
 * @returns {[HTMLDialogElement, null] | [null, Error | TypeError]} La boite de dialogue modifiée
 */
export function newDialog(element) {
    if(!(element instanceof HTMLDialogElement)) {
        return [null, new TypeError(`Cannot create a new dialog : argument #1 must be an instance of ${HTMLDialogElement.name} (${typeof element} received)`)];
    }

    const openBtn = document.querySelector(`button[data-dialog-id="${element.id}"]`);

    if(!(openBtn instanceof HTMLButtonElement)) {
        return [null, new TypeError(`Cannot create a new dialog : opening button for ${HTMLDialogElement.name} with id = ${element.id} was not found`)];
    }

    const body = element.querySelector('.dialog__inner');
    
    if(!body) {
        return [null, new Error(`Cannot create a new dialog : dialog must have a body which was not found`)];
    }

    const closeBtn = element.querySelector('[formmethod="dialog"], .close-btn');

    if(!closeBtn) {
        return [null, new Error(`Cannot create a new dialog : dialog must have a closing button which was not found`)];
    }
    
    if(!(closeBtn instanceof HTMLButtonElement)) {
        return [null, new Error(`Cannot create a new dialog : closing button must be an instance of ${HTMLButtonElement}`)];
    }

    const dialog = {
        body: body,
        openBtn: openBtn,
        closeBtn: closeBtn,
    };

    for(const prop in dialog) {
        if(prop in element) {
            return [null, new Error(`Cannot create a new dialog : property ${prop} in already defined on ${element}`)];
        }
        
        element[prop] = dialog[prop];
    }

    return [element, null];
}