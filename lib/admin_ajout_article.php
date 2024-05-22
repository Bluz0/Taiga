<?php
session_start() ;

if(!$_SESSION["admin"]){
	header("Location: account-connexion.php"); 
} 
?>

<?php
include "../db/db_connect.php"; 
include "../crud/article_crud.php"; 
include "vue_admin_ajout_article.php"; 
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



<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);  //Permet d'indiquer seulement certains types d'erreur  
ini_set ( 'display_errors','1') ;

$html=html_form_create() ;
echo($html) ; 
	
	



if(isset($_POST["action"])){
	$action=$_POST["action"];
	$titre=$_POST["titre"] ; 
	$description=$_POST["description"] ;
	$prix=$_POST["prix"] ;
	$image=$_POST["image"];
	$nom_cat=$_POST["nom_cat"];

    
	if(is_uploaded_file($_FILES["image"]["tmp_name"])){
		echo($_FILES["image"]["tmp_name"]);
		$image=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		
	}

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
	
	
			

	if($action=="create"){
		/* traitement du formulaire de maj */
		
		create_article_admin($conn,$titre, $description, $prix, $image, $num_cat);
		
		
	
	
	}
}
?>
</body>
</html>