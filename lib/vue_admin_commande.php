<?php
function html_table_commande($commandes){
	$html="<div id=div_tab_commande>";
    $html.="<h2>Commande en cours</h2>";
    $html.="<table id=table_commande>\n"; 
	$html.="\t<tr id=th_commande>\n"; 
	$html.="\t<th scope='col'>Id</th>\n"; 
	$html.="\t<th scope='col'>Id Utilisateur</th>\n"; 
	$html.="\t<th scope='col'>Numéro Commande</th>\n"; 
	$html.="\t<th scope='col'>Prix total</th>\n"; 
	$html.="\t<th scope='col'>Action</th>\n"; 
    $html.="\t</tr>\n"; 
	
	//creation des lignes 
	foreach($commandes as $commande){
		$html.=html_tr_commande($commande); 	
	}

	$html.="</table>\n"; 
	$html.="</div>";
    return $html; 
}

/**
 * Ligne du tableau: Commande | id | nom | prenom | email | adresse | privilege
 */
function html_tr_commande($commande){
	
	
	$id=$commande["id"];
	$id_usr=$commande["id_user"] ; 
	$num_commande=$commande["num_commande"] ;
	$prix_total=$commande["total_prix"] ;
	
	
    $html.="\t<tr class=tr_commande>\n"; 
    $html.="\t\t<td>$id</td>\n" ;
	$html.="\t\t<td>$id_usr</td>\n" ;
	$html.="\t\t<td>$num_commande</td>\n" ;
    $html.="\t\t<td>$prix_total €</td>\n" ;
	

	$a_delete=html_a_delete_commande($id_usr,$num_commande) ;
	$html.="\t\t<td>$a_delete\n" ;
	
	
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_commande($id_usr,$num_commande){
	$href="admin.php?action=delete&table=Paiement&id_usr=$id_usr&num_commande=$num_commande" ; 
	$html="<a href='$href' ><img src='../images/admin/annuler_commande.png' height='30px' width='30px'></a>" ;
       	return $html; 	
}

?>