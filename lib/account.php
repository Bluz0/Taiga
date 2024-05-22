

<?php
session_start();
if(!isset($_SESSION)){
	header("Location: account-connexion.php"); 
} 

if ($_SESSION["user"] == null){
	header("Location: account-connexion.php");
}
?>

<?php

include "../db/db_connect.php"; 
include "../crud/admin_usr.crud.php"; 
include "vue_account.php"; 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">

</head>
  
<header>
        <a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

        
        <div class="group">
            <ul class="navigation">
			
				<li><a href="../index.php">Accueil</a></li>
                <li><a href="../index.php#cat-cat">Categories</a></li>
                <li><a href="faq.php">A propos</a></li>
				<li><a href="form_contact.php">Contact</a></li> 
				<li><a href="account.php" id=connexion><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                <li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
				<li><a href="../index.php?action=disconnect"><img src='../images/admin/deconnexion.png' height="20px" width="20px"></a></li>
                
            </ul>
        </div>
    </header>


<body>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);  //Permet d'indiquer seulement certains types d'erreur 
ini_set ( 'display_errors','1') ;
/**
 * Controlleur : Traite les actions provenant des requetes POST et GET
 */




 if(isset($_GET["action"]) && isset($_SESSION["email"])){

	$action=$_GET["action"];
	$email=$_SESSION["email"];

	if($action=="update"){
		
		/* Formulaire de maj d'un user */
		$user=select_user_email($conn, $email) ;
		$html=html_form_maj($user) ;
		echo($html) ;				
		
	}  
    elseif($action=="delete"){

		/* Supression d'un user */	
		delete_user($conn, $id) ;
	}
}


if(isset($_POST["action"]) && isset($_POST["id"])){
	$action=$_POST["action"];
	$id=$_POST["id"];
	$nom=$_POST["nom_usr"] ; 
	$prenom=$_POST["prenom_usr"] ;
	$email=$_POST["email"] ;
	$adresse=$_POST["adresse"];
	$Mdp=$_POST["Mdp"];
	
	
			

	
	
	if($action=="update"){
		/* traitement du formulaire d'ajout */
		$Mdp_hash=password_hash($Mdp,PASSWORD_DEFAULT);
		update_user_account($conn,$id,$nom, $prenom, $email,$adresse,$Mdp_hash);
		
	} 
}

?>
<?php
$email=$_SESSION["email"];

$user=select_user_email($conn,$email);

$html=html_table_user($user);
echo($html);

?>




</body>


</html>

