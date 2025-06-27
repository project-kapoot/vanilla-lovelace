<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapoot - Tableau des scores</title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">

    <script src="/assets/js/script.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js" integrity="sha384-PGQNwlIJdtnrtJP1MhGd7ezfcWnCVIKqKo45vPmdwuTJiDdO+7P6g1E3lRysQIqq" crossorigin="anonymous"></script>

</head>

<body>
    <?php templatePart('navbar.php'); ?>

    <main class="score-page">
        <div class="container-900 text-center">
            <h1>🏆 Tableau des scores</h1>
            <div class="winner-announcement">
                <h2><strong>Alice</strong> est en tête !</h2>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Podium" class="podium-img">

            <!-- TOP 3 -->
            <div class="top-3">
                <!-- 1er -->
                <div class="score-card top-card">
                    <div class="avatar-container">
                        <div class="crown crown-1"></div>
                        <img src="https://i.pravatar.cc/80?img=1" alt="Avatar" class="avatar">
                    </div>
                    <p class="pseudo">Alice</p>
                    <p class="score">1 500 pts</p>
                </div>

                <!-- 2e -->
                <div class="score-card top-card">
                    <div class="avatar-container">
                        <div class="crown crown-2"></div>
                        <img src="https://i.pravatar.cc/80?img=2" alt="Avatar" class="avatar">
                    </div>
                    <p class="pseudo">Bob</p>
                    <p class="score">1 200 pts</p>
                </div>

                <!-- 3e -->
                <div class="score-card top-card">
                    <div class="avatar-container">
                        <div class="crown crown-3"></div>
                        <img src="https://i.pravatar.cc/80?img=3" alt="Avatar" class="avatar">
                    </div>
                    <p class="pseudo">Charlie</p>
                    <p class="score">1 100 pts</p>
                </div>
            </div>

            <!-- AUTRES JOUEURS -->
            <div class="other-players">
                <div class="score-card">
                    <div class="avatar-container">
                        <div class="rank">4</div>
                        <img src="https://i.pravatar.cc/80?img=4" alt="Avatar" class="avatar">
                    </div>
                    <p class="pseudo">David</p>
                    <p class="score">900 pts</p>
                </div>

                <div class="score-card">
                    <div class="avatar-container">
                        <div class="rank">5</div>
                        <img src="https://i.pravatar.cc/80?img=5" alt="Avatar" class="avatar">
                    </div>
                    <p class="pseudo">Eve</p>
                    <p class="score">700 pts</p>
                </div>
            </div>

            <!-- Bouton dessous -->
            <div class="score-footer">
                <a href="#" class="btn-primary">Passer à la question suivante →</a>
            </div>

        </div>
    </main>

    <?php templatePart('footer.php'); ?>
</body>

</html>