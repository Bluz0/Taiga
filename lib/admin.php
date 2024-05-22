<?php
session_start() ;

if(!$_SESSION["admin"]){
	header("Location: account-connexion.php") ; 
} 
include "header_admin.php";
include "../db/db_connect.php"; 
include "../crud/requete.crud.php";
include "../crud/paiement_crud.php";
include "vue_admin_requete.php"; 
include "vue_admin_commande.php";
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Administration</title>
	</head>

<body>
	
	
	<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);  //Permet d'indiquer seulement certains types d'erreur 
	ini_set ( 'display_errors','1') ;
	/**
 	* Controlleur : Traite les actions provenant des requetes POST et GET
 	*/


 	if(isset($_GET["action"]) && isset($_GET["id"])){

		$action=$_GET["action"];
		$id=$_GET["id"];
		$table=$_GET["table"];
		
		
		if($table=="Requete"){
    		if($action=="delete"){

				/* Supression d'un produit */	
				delete_requete($conn, $id) ;
			}
		}	

		elseif($table=="Paiement"){
			$num_commande=$GET_["num_commande"];
			$id_usr=$_GET["id_usr"];
			if($action=="delete"){
				
				delete_paiement($conn,$id_usr,$num_commande) ;
			
			
			}
		}
	
	}






?>
<?php
$id=$_GET["id"];

$requete=list_requete($conn);
$commande=liste_paiement($conn);

$html="<div id=page_admin>";
$html.="<div id=admin_tdb><h1>Tableau de bord</h1></div>";
$html.="<div id=admin_rq_cmd>";
$html.=html_table_requete($requete); 
$html.=html_table_commande($commande);
$html.="</div>";
$html.="</div>";
echo($html);

?>
</body>
</html>

