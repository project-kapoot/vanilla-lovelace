<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapoot</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <!-- remixicon link css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <!-- script js -->
    <script src="/assets/js/script.js" defer></script>
</head>
<body>
    <!-- header -->
    <header>
        <!-- navbar -->
        <nav class="navbar" aria-label="Main menu">
            <a href="/">
                <picture>
                    <source srcset="/assets/img/logo-kapoot-desktop.png" media="(min-width: 525px)" alt="site logo">
                    <source srcset="/assets/img/logo-kapoot-mobile.png" alt="site logo">
                    <img class="logo" src="/assets/img/logo-kapoot-mobile.png" alt="site logo">
                </picture>
            </a>
            <ul class="navbar-group">
                <li class="nav-list">
                    <a class="nav-link" href="#">Accueil</a>
                    <a class="nav-link" href="#">Quiz</a>
                </li>
                <li class="nav-icon">
                    <i id="navbar-toggle" class="ri-user-fill"></i>
                    <!-- toggle menu -->
                    <div class="nav-toggler">
                        <ul class="toggler-group">
                            <li class="toggler-list">
                                <a class="toggler-link" href="/connexion">Mon profil</a>
                                <a class="toggler-link" href="/connexion">Se connecter</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </header> 
</body>
</html>