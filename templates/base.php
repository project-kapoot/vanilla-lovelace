<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapoot</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="/assets/css/main.css" />

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js" integrity="sha384-PGQNwlIJdtnrtJP1MhGd7ezfcWnCVIKqKo45vPmdwuTJiDdO+7P6g1E3lRysQIqq" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js" type="module"></script>
    <script src="/assets/js/presentateur.js" type="module"></script>
</head>
<body>
    <?php templatePart('navbar.php') ?>

    <main>
        <?php if(isset($template) && file_exists($template)) : ?>
            <?php require_once $template ?>
        <?php endif ?>
    </main>

    <?php templatePart('footer.php') ?>
</body>
</html>