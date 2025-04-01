document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal-answer");
    const modalText = document.querySelector(".modal-text");
    const closeModalBtn = document.querySelector(".close-modal");
    const answerButtons = document.querySelectorAll(".answers button");

    /* ✨ Explication codée en dur (à remplacer par une variable dynamique via BDD plus tard)   
const explanation = "Contenu récupéré via l'API ou la base de données";
On pourra très simplement remplacerpar une valeur dynamique récupérée avec fetch() ou injectée depuis PHP.
*/
const explanation = `
<p>En PHP, déclarer une variable est très simple. Il suffit de la nommer en commençant par le symbole <span style="color:red;">$</span> et de lui affecter une valeur avec l'opérateur <span style="color:red;">=</span>. Par exemple :</p>
<pre style="background-color:rgb(197, 197, 197); padding: 1rem; border-radius: 10px; font-family: 'Courier New', monospace;">
&lt;?php<br>
<span style="color: red;">$nom</span> = "Guillaume";<br>
<span style="color: red;">$age</span> = 30;<br><br>
<span style="color: green;">echo</span> "<span style="color: green;">Bonjour, je m'appelle</span> $nom <span style="color: green;">et j'ai</span> $age <span style="color: green;">ans.</span>";<br>
?&gt;
</pre>
`;


    // Affiche la modale avec l'explication
    const openModal = (text) => {
        modalText.innerHTML = text;
        modal.style.display = "flex";
    };

    // Ferme la modale
    const closeModal = () => {
        modal.style.display = "none";
    };

    // Clic sur une réponse = ouvre la modale
    answerButtons.forEach((button) => {
        button.addEventListener("click", () => {
            openModal(explanation);
        });
    });

    // Fermer avec le bouton (croix)
    closeModalBtn.addEventListener("click", closeModal);

    // Fermer en cliquant en dehors du contenu
    window.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });
});
