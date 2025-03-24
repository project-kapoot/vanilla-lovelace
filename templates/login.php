<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <section class="account">
        <div class="container">
            <div class="form-container" id="login-container">
                <h2 class="form-container-title">Connexion</h2>
                <form>
                <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" required>
                </div>
                <button class="btn btn-primary" type="submit">Se connecter</button>
                </form>
                <p class="form-container-paragraph">Pas encore de compte ? <a href="/inscription">S'inscrire</a></p>
            </div>
        </div>
    </section>
    
</body>
</html>