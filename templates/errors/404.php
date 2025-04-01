<?php templatePart('navbar.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - Erreur 404</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .error-404 {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #333;
            padding: 2rem;
        }

        .error-404 h1 {
            font-size: 6rem;
            margin-bottom: 1rem;
            color: #c0392b;
        }

        .error-404 p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .error-404 a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #c0392b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .error-404 a:hover {
            background-color: #a93226;
        }
    </style>
</head>

<body>

    <main class="error-404">
        <h1>404</h1>
        <p>La page que vous cherchez est introuvable.</p>
        <a href="/">Retour à l'accueil</a>
    </main>

    <?php templatePart('footer.php'); ?>
</body>
</html>
