

<?php
session_start();
if(!$_SESSION["admin"]){
	header("Location: account-connexion.php"); 
} 
?>

<?php

include "../db/db_connect.php"; 
include "../crud/article_crud.php"; 
include "vue_admin.article.php"; 
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
	
</head>
<body>

<body>
<div id='chemin' class='lien_chemin'>
<ul>
	<li><a href='../index.php'>Accueil</a></li><li><a id='cat_article_actuel'>Categorie</a></li>
	<li><a href='#' id='article_actuel'></a></li>
</ul>
</div>

<?php


error_reporting(E_ERROR | E_WARNING | E_PARSE);  //Permet d'indiquer seulement certains types d'erreur 
ini_set ( 'display_errors','1') ;
/**
 * Controlleur : Traite les actions provenant des requetes POST et GET
 */


 if(isset($_GET["action"]) && isset($_GET["id"])){
	
	$action=$_GET["action"];
	$id=$_GET["id"];

	if($action=="update"){
		
		/* Formulaire de maj d'un produit */
		
		$produit=select_1_produit($conn,$id);
		
		$html=html_form_maj($produit) ;
		echo($html) ;				
		
	}  
    elseif($action=="delete"){

		/* Supression d'un produit */	
		delete_article($conn, $id) ;
	}
}


if(isset($_POST["action"]) && isset($_POST["id"])){
	$action=$_POST["action"];
	$id=$_POST["id"];
	$titre=str_replace("'","\'",$_POST["titre"]); 
	$description=str_replace("'","\'",$_POST["description"]);
	$prix=$_POST["prix"];
	
	
	if(is_uploaded_file($_FILES["image"]["tmp_name"])){
		$image=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		
	}
	else if(!is_uploaded_file($_FILES["image"]["tmp_name"])){
		$produit=select_1_produit($conn,$id);
		$image=addslashes($produit["image"]);
		
	}
	
	$nom_cat=$_POST["nom_cat"];
	
	if($nom_cat=="enceinte"){
		$num_cat=1;
		

	}

	else if($nom_cat=="ordinateur"){
		$num_cat=2;
	}

	else if($nom_cat=="tablette"){
		$num_cat=3;
	}
	else if($nom_cat=="television"){
		$num_cat=4;
	}
	
	else if($nom_cat=="telephone"){
		$num_cat=5;
	}
	
	else if($nom_cat=="clavier_souris"){
		$num_cat=6;
	}
	
	else if($nom_cat=="ecran"){
		$num_cat=7;
	}
	
	
	
	if($action=="update"){
		/* traitement du formulaire d'ajout */
		
		update_article_admin($conn, $id, $titre, $description, $prix, $image, $num_cat);
		
	} 
}





/*function tab_image(){
	$nb_image=count($_FILES["image_uploads"]["name"]);
	
	$i=0;
	
	
	$tab=[];
	
	
	
	if($nb_image>6){
		echo("<p>Vous avez séléctioné trop d'images seules les 6 premières seront conservées</p>");
	}
	
	
	
	
	while($i<=$nb_image && $i<6){
		$tab[]=$_FILES["image_uploads"]["tmp_name"][$i];
		$i++;
	
	}
	
	
	
	return($tab);
	}*/
	
?>


<?php
$id=$_GET["id"];

$produit=select_1_produit($conn,$id);
$html=html_tr_produit($produit); 
echo($html);
if(isset($_GET["action"])){
	echo("<script>document.getElementById('produit_image').style.display='none';</script>");}

?>
</body>
</html>

