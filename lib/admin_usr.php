<?php
session_start() ;

if(!$_SESSION["admin"]){
	header("Location: account-connexion.php"); 
} 
?>

<?php
include "../db/db_connect.php"; 
include "../crud/admin_usr.crud.php"; 
include "vue_admin.usr.php"; 
include "header_admin.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">
	
	
	<title>Administration</title>

</head>
<body>

<body>

<?php
error_reporting(E_ALL);  //Permet d'indiquer seulement certains types d'erreur  
ini_set ( 'display_errors','1') ;
/**
 * Controlleur : Traite les actions provenant des requetes POST et GET
 */




 if(isset($_GET["action"]) && isset($_GET["id"])){

	$action=$_GET["action"];
	$id=$_GET["id"];

	if($action=="update"){
		
		/* Formulaire de maj d'un user */
		$user=select_user($conn, $id) ;
		$html=html_form_maj($user) ;
		echo($html) ;				
		
	} elseif($action=="create"){
		
		/* Formulaire creation d'un user */
		$html=html_form_create() ;
		echo($html) ; 
	
	} elseif($action=="delete"){

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
	$privilege=$_POST["privilege"] ;
	
			

	
	
	if($action=="update"){
		/* traitement du formulaire d'ajout */
		
		update_user($conn, $id, $nom, $prenom, $email,$adresse,$Mdp,$privilege);
		
		
	
	} elseif($action=="create"){
		/* traitement du formulaire de maj */
		$Mdp_hash=password_hash($Mdp,PASSWORD_DEFAULT);
		insert_user($conn,$nom, $prenom, $email,$adresse,$Mdp_hash,$privilege);
		
		
	
	
	}
}

?>


	
<!-- tableau de gestion des  user -->
<?php

$users=list_user($conn);
$html="<div id=users>\n";

$html.=html_table_user($users);
$html.="<a href='admin_usr.php?table=Utilisateur&action=create&id=_' id=btn_ajout_usr>Ajouter</a>";
$html.="</div>";
echo($html);
if(isset($_GET["action"])){
	$action=$_GET["action"];
	if($action=="update" || $action=="create"){
		echo("<script>document.getElementById('table_usr').className = 'prd_article_none';
	     	document.getElementById('btn_ajout_usr').className = 'prd_article_none';
		 
		 	</script>");
		}
	}
?>


<!-- lien d'ajout d'un user -->


</body>
</html>
