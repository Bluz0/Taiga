


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taiga - Connexion/Inscription</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style-log.css">
</head>
<body>
    
    <h1>Inscription</h1>
    <div class="login-card">

        <form method="POST" action="account-connexion.php">
            
            <label>Prénom</label>
            <br><input class="log" type="text" name="prenom"><br><br>

            <label>Nom :</label>
            <br><input class="log" type="text" name="nom"><br><br>
        
            <label>Email :</label>
            <br><input class="log" type="email" name="email" required="required"><br><br>

            <label>Mot de passe :</label>
            <br><input class="log" type="password" name="mdp" required="required"><br><br>
            
            <input type='hidden' name='action'>
            
            <input id="envoi" type="submit" value="S'incrire">
        </form>

    </div>

    <br>
    <div id="text-connexion">
        <p>Déjà un compte ?<a href="account-connexion.php">Connectez-vous </a> !</p>
    </div>

    




</body>


</html>

