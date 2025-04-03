const id = 'dialog-answer';
const dialog = document.getElementById(id);

if(dialog instanceof HTMLDialogElement) {
    /** @type { HTMLButtonElement[] } */
    const answers = document.querySelectorAll(`button[data-dialog-id="${id}"]`);

    /** @type { HTMLButtonElement|null } */
    const closeButton = dialog.querySelector('button.dialog-close');
    
    for(const answer of answers) {
        answer.addEventListener('click', () => {
            dialog.showModal();
        });
    }

    closeButton?.addEventListener('click', () => {
        dialog.close();
    });

    window.addEventListener("click", (e) => {
        if(e.target === dialog) {
            dialog.close();
        }
    });
}
