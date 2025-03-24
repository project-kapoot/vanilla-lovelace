<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>

    <div class="container">
        <div class="form-container" id="register-container">
            <h2>Inscription</h2>
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

                <button type="submit">S'inscrire</button>
            </form>
            <p>Déjà inscrit ? <a href="/connexion">Connectez-vous !</a></p>
        </div>
    </div>

</body>

</html>