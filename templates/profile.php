<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapoot - Mon profil</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <main class="profile-page">
        <h1 class="visually-hidden">Mon profil</h1>
        <div class="cards container-1400">
            <section class="card">
                <div class="user-visuals">
                    <img class="user-banner" src="/assets/img/placeholder.png" alt="">
                    <div class="user-card">
                        <img class="user-avatar" src="/assets/img/placeholder.png" alt="">
                        <span class="user-pseudo">Pseudonyme</span>
                    </div>
                </div>
                <div class="user-visuals-buttons">
                    <button class="btn-primary">Modifier l'avatar</button>
                    <button class="btn-primary">Modifier la bannière</button>
                </div>
                <div class="space-margin-16">
                    <h2>Informations personnelles :</h2>
                    <ul>
                        <li><span class="fw-bold">Pseudonyme : </span>Mon pseudonyme</li>
                        <li><span class="fw-bold">Nom : </span>Mon nom</li>
                        <li><span class="fw-bold">Prénom : </span>Mon prénom</li>
                        <li><span class="fw-bold">Email : </span>Mon email</li>
                    </ul>
                    <button class="btn-primary">Modifier</button>
                </div>
            </section>
            <section class="card">
                <h2 class="text-center">Statistiques :</h2>
                <table class="table-stats">
                    <thead>
                        <tr>
                            <th>Quiz créés</th>
                            <th>Parties jouées</th>
                            <th>Quiz présentés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
                <h3>Historique des quiz :</h3>
                <form class="form" action="quiz-history-form" method="get">
                    <div class="form__fields">
                        <div class="form__field">
                            <label class="form__label" for="quiz-name">Nom du quiz :</label>
                            <input class="form__widget" size="15" placeholder="PHP - Les variables" type="text" name="quiz[name]" id="quiz-name">
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="quiz-error-ratio">Pourcentage d'erreurs :</label>
                            <input class="form__widget" placeholder="30" min="0" max="100" type="number" name="quiz[error-ratio]" id="quiz-error-ratio">
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="quiz-played-at">Réalisé le :</label>
                            <input class="form__widget" type="date" name="quiz[played-at]" id="quiz-played-at">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">Confirmer</button>
                </form>
                <p class="text-center"><span>X</span> résultats sur <span>X</span></p>
                
                <?php
                    $headers = [
                        'Quiz',
                        'Erreurs (en %)',
                        'Classement',
                        'Réalisé le',
                    ];
                ?>

                <table class="table-quiz">
                    <thead>
                        <tr>
                            <?php foreach($headers as $header) : ?>
                                <th><?= $header ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-header="<?= $headers[0] ?>">Nom du quiz</td>
                            <td data-header="<?= $headers[1] ?>">X%</td>
                            <td data-header="<?= $headers[2] ?>">X/X</td>
                            <td data-header="<?= $headers[3] ?>">XX/XX/XXXX</td>
                        </tr>
                        <tr>
                            <td data-header="<?= $headers[0] ?>">Nom du quiz</td>
                            <td data-header="<?= $headers[1] ?>">X%</td>
                            <td data-header="<?= $headers[2] ?>">X/X</td>
                            <td data-header="<?= $headers[3] ?>">XX/XX/XXXX</td>
                        </tr>
                        <tr>
                            <td data-header="<?= $headers[0] ?>">Nom du quiz</td>
                            <td data-header="<?= $headers[1] ?>">X%</td>
                            <td data-header="<?= $headers[2] ?>">X/X</td>
                            <td data-header="<?= $headers[3] ?>">XX/XX/XXXX</td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn-primary d-block mx-auto">Voir plus</button>
            </section>
        </div>
    </main>
</body>
</html>