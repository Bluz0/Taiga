<?php
function html_table_requete($requetes){
	$html="<div id=div_tab_requete>";
    $html.="<h2>Demande d'assistance</h2>";
    $html.="<table id=table_requete>\n"; 
	$html.="\t<tr id=th_requete>\n"; 
	$html.="\t<th scope='col'>Id</th>\n"; 
	$html.="\t<th scope='col'>Email</th>\n"; 
	$html.="\t<th scope='col'>Objet</th>\n"; 
	$html.="\t<th scope='col'>Message</th>\n"; 
	$html.="\t<th scope='col'>Action</th>\n"; 
    $html.="\t</tr>\n"; 
	
	//creation des lignes 
	foreach($requetes as $requete){
		$html.=html_tr_requete($requete); 	
	}

	$html.="</table>\n"; 
	$html.="</div>";
    return $html; 
}

/**
 * Ligne du tableau: Requete | id | nom | prenom | email | adresse | privilege
 */
function html_tr_requete($requete){
	
	
	$id=$requete["id"];
	$email=$requete["email"] ; 
	$objet=$requete["objet"] ;
	$message=$requete["message"] ;
	
	
    $html.="\t<tr class=tr_requete>\n"; 
    $html.="\t\t<td>$id</td>\n" ;
	$html.="\t\t<td>$email</td>\n" ;
	$html.="\t\t<td>$objet</td>\n" ;
    $html.="\t\t<td>$message</td>\n" ;
	

	$a_delete=html_a_delete_requete($id) ;
	$html.="\t\t<td>$a_delete\n" ;
	
	
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_requete($id){
	$href="admin.php?action=delete&table=Requete&id=$id" ; 
	$html="<a href='$href' ><img src='../images/admin/supprimer-le-mail.png' height='30px' width='30px'></a>" ;
       	return $html; 	
}

?>