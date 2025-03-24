<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../sass/pages/login.scss">
</head>

<body>
    <div class="container">
        <div class="form-container" id="login-container">
            <h2>Connexion</h2>
            <form>
            <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            
            </form>
            <p>Pas encore de compte ? <a href="../templates/register.php">S'inscrire</a></p>
        </div>

</body>

</html>