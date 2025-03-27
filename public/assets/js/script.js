// afficher le menu déroulant

const toggleBtn = document.querySelector(".toggleBtn");
const navToggler = document.querySelector(".nav-toggler");

toggleBtn.addEventListener('click', function() {
    navToggler.classList.toggle("toggle-menu");
});