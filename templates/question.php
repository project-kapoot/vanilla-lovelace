<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Les bases en PHP - Quiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">

    <script src="/assets/js/script.js" type="module"></script>
    <script src="/assets/js/question.js" type="module"></script>
</head>

<body class="quiz">

    <!-- HEADER (dans le bloc blanc global) -->
    <?php templatePart('navbar.php'); ?>
    <!-- CONTENU PRINCIPAL -->
    <main class="question-container">
        <!-- Pastilles (Durée, titre quiz, joueurs restant) -->
        <div class="stats">
            <div class="stat">
                <p>Durée</p>
                <span>12</span>
            </div>
            <h1 class="quiz-title">Les bases en PHP</h1>
            <div class="stat">
                <p>Joueurs</p>
                <span>4</span>
                <p>restants</p>
            </div>
        </div>
        <!-- Image + console -->
        <div class="question-content ">
            <div class="image-question">
                <img
                    src="assets/img/PHP-Global-Variable-1.jpg"
                    alt="Illustration d'un écran avec du code PHP">
            </div>
            <div class="ranking ranking-player">
                <table>
                    <thead>
                        <tr>
                            <th colspan="3">Classement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="assets/img/crown.svg" /></td>
                            <td>Axel_Foley</td>
                            <td>1493 pts</td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/crown.svg" /></td>
                            <td>El_Lobo_93</td>
                            <td>1279 pts</td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/crown.svg" /></td>
                            <td>Axel_Foley</td>
                            <td>1183 pts</td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/circle.svg" /></td>
                            <td>Priscillia_love</td>
                            <td>970 pts</td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/circle.svg" /></td>
                            <td>Roudoulou</td>
                            <td>750 pts</td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/circle.svg" /></td>
                            <td>Tif_Tif</td>
                            <td>750 pts</td>
                        </tr>
                        <tr class="empty-row">
                            <td colspan="3"></td>
                        </tr>
                        <tr class="empty-row">
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="question-quiz">
            <!-- Pastille "Question 1" -->
            <div class="question-number">Question 1</div>
            <!-- Libellé de la question -->
            <p class="question-subtitle">Comment déclarer une variable en PHP ?</p>
        </div>
        <!-- Réponses -->
        <div class="answers">
            <button class="answer-color <?php if($role !== 'presenter') : ?>answer-color-1 <?php endif ?>" data-dialog-id="dialog-answer"><span class="answer-num">Réponse A : </span><span class="answer-result"><code>$maVariable = 'Patate';</code></span></button>
            <button class="answer-color <?php if($role !== 'presenter') : ?>answer-color-2 <?php endif ?>" data-dialog-id="dialog-answer"><span class="answer-num">Réponse B :</span><span class="answer-result"><code>let $maVariable = 'Patate';</code></span> </button>
            <button class="answer-color <?php if($role !== 'presenter') : ?>answer-color-3 <?php endif ?>" data-dialog-id="dialog-answer"><span class="answer-num">Réponse C :</span><span class="answer-result"><code>var = 'Patate';</code></span> </button>
            <button class="answer-color <?php if($role !== 'presenter') : ?>answer-color-4 <?php endif ?>" data-dialog-id="dialog-answer"><span class="answer-num">Réponse D :</span><span class="answer-result"><code>variable = 'Patate';</code></span> </button>
        </div>
        <?php if($role === 'presenter') : ?>
            <div class="action">
                <button class="next">Question suivante</button>
            </div>
        <?php endif ?>

        <dialog is="answer-dialog" id="dialog-answer" class="dialog-answer">
            <div class="dialog">
                <button class="dialog-close">&times;</button>
                <h2>Explication</h2>
                <p>En PHP, déclarer une variable est très simple. Il suffit de la nommer en commençant par le symbole <span class="color-red">$</span> et de lui affecter une valeur avec l'opérateur <span class="color-red">=</span>. Par exemple :</p>
                <pre class="explanation-example">
                    <code>&lt;?php</code>

                    <code><span class="color-red">$nom</span> = "Guillaume";</code>

                    <code><span class="color-red">$age</span> = 30;</code>

                    <code><span class="color-green">echo</span> "<span class="color-green">Bonjour, je m'appelle</span> $nom <span class="color-green">et j'ai</span> $age <span class="color-green">ans.</span>";</code>

                    <code>?&gt;</code>
                </pre>
            </div>
        </dialog>
    </main>
    <!-- FOOTER -->
    <?php templatePart('footer.php'); ?>
</body>

</html>