<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">

    <script type="module" src="/assets/js/script.js"></script>
</head>

<body>
    <?php templatePart('navbar.php'); ?>

    <main>
        <section class="account">
            <div class="container">
                <div class="form-container" id="register-container">
                    <h2 class="form-container-title">Inscription</h2>
                    <form>
                        <div class="input-group">
                            <label for="reg-email">Email</label>
                            <input type="email" id="reg-email" required>
                        </div>
                        <div class="input-group">
                            <label for="reg-password">Mot de passe</label>
                            <input type="password" id="reg-password" required>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Confirmez le mot de passe</label>
                            <input type="password" id="confirm-password" required>
                        </div>
                        <p id="error-message" class="error-message"></p>
                        <button class="btn btn-primary" type="submit">S'inscrire</button>
                    </form>
                    <p class="form-container-paragraph">Déjà inscrit ? <a href="/connexion">Connectez-vous !</a></p>
                </div>
            </div>
        </section>
    </main>
    
    <?php templatePart('footer.php'); ?>
</body>

</html>