<?php
session_start() ;

if(!$_SESSION["user"]){
	header("Location: ./account-connexion.php") ; 
}
?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
		<title>User n°<?php echo $_SESSION["user"]?></title>
		<link rel="stylesheet" href="../css/style.css">
	</head>

	<body>

	<header>
            <a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

            <div class="group">
                <ul class="navigation">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../index.php#cat-cat">Categories</a></li>
                    <li><a href="../lib/faq.php">A propos</a></li>
					<li><a href="form_contact.php">Contact</a></li> 
					<li><a href="account.php"><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                	<li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
					<li><a href="../index.php?action=disconnect"><img src='../images/admin/deconnexion.png' height="20px" width="20px"></a></li>
                
				
				</ul>
            </div>
        </header>
		
		<div id=usr>
		<div id=titre_usr><h1>Bienvenue</h1></div>
		
		<div id=compte_usr>
		<div id=titre_usr_compte><h2>Votre compte</h2></div>
		<div class=lien_usr><a href="account.php">Vos informations</a></div>
		</div>
		
		<div id=panier_usr>
		<div id=titre_usr_panier><h2>Votre panier</h2></div>
		<div class=lien_usr><a href="cart.php">Accéder à votre panier</a></div>
		</div>
		
		<div id=deconnexion_usr>
		<div id=titre_usr_deconnexion><h2>Deconnexion</h2></div>
		<div class=lien_usr><a href="../index.php?action=disconnect">Déconnectez-vous</a></div>
		</div>

		</div>

	
	
	
<footer class='div_footer'><?php include "footer.php" ?></footer>
	
	</body>


</html>

