<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création quiz</title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">

    <script src="/assets/js/script.js" type="module"></script>
    <script src="/assets/js/creation_quiz.js" defer></script>
</head>
<body>
    <!-- header -->
    <?php templatePart('navbar.php') ?>
    <!-- main content -->
    <main class="quiz-container">
        <form method="" class="creation-quiz container-1200">
            <!-- title-question -->
            <section class="title-question">
                <div class="thumb">
                    <img id="image-preview" src="/assets/img/placeholder.png" alt="image du quiz">
                    <input type="file" name="quiz-image" id="quiz-image" accept=".png, .jpeg, .jpg">
                    <i id="add-image" class="ri-add-circle-fill"></i>
                </div>
                <p id="error-message"></p>
                <div class="info-quiz">
                    <label for="quiz-title" class="form-title">Titre du quiz :</label>
                    <input class="form-input" type="text" name="quiz-title" id="quiz-title" placeholder="Entrer le titre du quiz" required>
                    <label for="quiz-description" class="form-title">Description :</label>
                    <input class="form-input" type="text" name="quiz-description" id="quiz-description" placeholder="Entrer la description du quiz" required>
                    <label for="quiz-difficult" class="form-title">Difficulté :</label>
                    <select name="quiz-difficult" id="quiz-difficult" required>
                        <option value="beginner">Débutant</option>
                        <option value="intermediate">Intermédiaire</option>
                        <option value="advanced">Avancé</option>
                    </select>
                </div>
            </section>
            <!-- quiz-question -->
            <section class="quiz-question">
                <div class="question-container">
                    <div class="question">
                        <label for="quiz-question" class="form-title">Question :</label>
                        <textarea class="form-input area" name="quiz-question" id="quiz-question" placeholder="Entrer la question" required></textarea>
                        <label for="question-type" class="form-title">Type de réponse :</label>
                        <select name="question-type" id="question-type" required>
                            <option value="value1">Vrai ou Faux</option>
                            <option value="value2">Choix multiple</option>
                            <option value="value3">Réponse numérique</option>
                        </select>
                    </div>
                    <div class="boolean-response">
                        <label class="form-title">La bonne réponse est :
                            <p><input class="form-input" type="radio" class="reponse-true" name="question-reponse">VRAI</p>
                            <p><input class="form-input" type="radio" class="reponse-false" name="question-reponse">FAUX</p> 
                        </label>
                    </div>
                    <div class="numeric-response">
                        <label for="numeric-response" class="form-title">Réponse numérique:</label>
                        <input class="form-input" type="text" name="numeric-response" id="numeric-response" placeholder="Entrer la réponse" required>
                    </div>
                    <div class="choice-response">
                        <label class="form-title">Réponse A :
                            <input class="form-input" type="text" name="responseA" placeholder="Entrer la réponse" required>
                            <p><input class="form-input" type="checkbox" class="correct-response" name="correct-response"> Est une bonne réponse</p>
                        </label>
                        <label class="form-title">Réponse B :
                            <input class="form-input" type="text" name="responseB" placeholder="Entrer la réponse" required>
                            <p><input class="form-input" type="checkbox" class="correct-response" name="correct-response"> Est une bonne réponse</p>
                        </label>
                        <label class="form-title">Réponse C :
                            <input class="form-input" type="text" name="responseC" placeholder="Entrer la réponse" required>
                            <p><input class="form-input" type="checkbox" class="correct-response" name="correct-response"> Est une bonne réponse</p>
                        </label>
                        <label class="form-title">Réponse D :
                            <input class="form-input" type="text" name="responseD" placeholder="Entrer la réponse" required>
                            <p><input class="form-input" type="checkbox" class="correct-response" name="correct-response"> Est une bonne réponse</p>
                        </label>
                    </div>
                    <button id="addQuestion" type="submit" class="btn-primary">Ajouter la question</button>
                </div>
            </section>
            <!-- list-qestion -->
            <section class="list-question">
                <h2>Cybersécurité</h2>
                <div class="card">
                    <div class="card-question">
                        <h2>Intitulé de la question</h2>
                        <div class="card-icon">
                            <i class="ri-file-edit-line" id="edit-question"></i>
                            <i class="ri-delete-bin-7-line" id="delete-question"></i>
                        </div>
                    </div>
                    <div class="card-question">
                        <h2>Intitulé de la question</h2>
                        <div class="card-icon">
                            <i class="ri-file-edit-line" id="edit-question"></i>
                            <i class="ri-delete-bin-7-line" id="delete-question"></i>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-primary" id="validate-quiz">Valider le quiz</button>
            </section>
        </form>
    </main>
    <!-- footer -->
    <?php templatePart('footer.php') ?>
</body>
</html>