document.addEventListener('DOMContentLoaded', function () {
    //--------------- ajouter une image
    const addImage = document.querySelector('#add-image');
    const imagePreview = document.querySelector('#image-preview');
    const quizImage = document.querySelector('#quiz-image');

    // ouvrir l'explorateur de fichier au click sur le button (+)
    addImage.addEventListener('click', function() {
        quizImage.click();
    });

    // Afficher l'image
    quizImage.addEventListener('change', function () {
        const regexImage = /image\/png|image\/jpeg|image\/jpg/g;
        const file = quizImage.files[0];

        // verifier si le fichier existe
        if (quizImage.files && file) {

            // verifier si c'est un image
            if (regexImage.test(file.type)) {
                const reader = new FileReader();
                reader.onload = function () {
                    imagePreview.src = reader.result;
                    console.log(reader.result);
                }
            // lire le contenu du fichier et le convertir en URL (base64) 
            // https://developer.mozilla.org/fr/docs/Web/API/FileReader/readAsDataURL
            reader.readAsDataURL(file);
            } else {

                // afficher un message d'erreur si le fichier chargé n'est pas une image.
                const errorMessage = document.querySelector('#error-message');
                errorMessage.textContent = "Fichier non supporté !";

                setTimeout(()=> {
                    errorMessage.style.display = "none";
                }, 5000);
            }
        }
    });

    // 
    
});