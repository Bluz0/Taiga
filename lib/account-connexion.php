 
<?php
include("../db/db_connect.php");

session_start();
include ("fct_conn.php");
if(isset($_POST["login"])){
    if(est_connecte($conn,$_POST["login"],$_POST["passwd"]) == "admin")
    {
		
		/* session admin */
		$_SESSION["admin"]=time() ; 
		$_SESSION["email"]=$_POST["login"];
        
        include ("../db/db_disconnect.php");
		/* redirection */
		
		header("Location: admin.php") ; 
		
	}
    else if (est_connecte($conn,$_POST["login"],$_POST["passwd"]) == "user") {
        /* session utilisateur */
		$_SESSION["user"]=time() ; 
		$_SESSION["email"]=$_POST["login"];
        
        include ("../db/db_disconnect.php");
		/* redirection */
		
		header("Location: user.php") ; 
    }
}	


if(isset($_POST["action"])){
    include "../crud/admin_usr.crud.php";
    $prenom=$_POST["prenom"];
    $nom=$_POST["nom"];
    $email=$_POST["email"];
    $Mdp=$_POST["mdp"];
    $adresse="";
    $priv="user";
    
    $Mdp_hash=password_hash($Mdp,PASSWORD_DEFAULT);
    
    
    insert_user($conn,$nom,$prenom,$email,$adresse,$Mdp_hash,$priv);
   
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taiga - Connexion</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style-log.css">
</head>
<body>
    
    <h1>Connexion</h1>
    <div class="login-card">

        <form method="POST" action="account-connexion.php">
            <label>Nom d'utilisateur :</label>
            <br><input class="log" type="email" name="login" required="required"><br><br>

            <label>Mot de passe :</label>
            <br><input class="log" type="password" name="passwd" required="required"><br><br>

            <input id="envoi" type="submit" value="Se connecter">
        </form>

    </div>

    <br>
    <div id="text-inscription">
        <p>Pas de compte ? <a href="account-inscription.php">Inscrivez vous maintenant !</a></p>
    </div>

    




</body>
</html>

