<?php


function html_table_user($user){
	$html="<div id=account_usr>";
	$html.="<h1 id=titre_admin>Vos informations</h1>";
	$html.="<table id=tab_account_usr>\n"; 

	//creation des lignes 
	
	$html.=html_tr_user($user); 	
	
	$html.="</table>\n"; 
	$html.="</div>";
	return $html; 
}

/**
 * Ligne du tableau: user | id | nom | prenom | email | adresse | Mdp |
 */
function html_tr_user($user){
	
	$id=$user["id"];
	$nom=$user["nom_usr"] ; 
	$prenom=$user["prenom_usr"] ;
	$email=$user["email"] ;
	$adresse=$user["adresse"];
	$Mdp=$user["Mdp"];
	
	$html="\t<tr class=tr_account_usr>\n";
    $html.="\t<th scope='row'>Nom</th>\n"; 
	$html.="\t\t<td>$nom</td>\n" ;
	$html.="\t</tr>\n" ; 
	
	$html.="\t<tr class=tr_account_usr>\n"; 
	$html.="\t<th scope='row'>Prénom</th>\n"; 
	$html.="\t\t<td>$prenom</td>\n" ;
    $html.="\t</tr>\n" ; 
	
	$html.="\t<tr class=tr_account_usr>\n"; 
	$html.="\t<th scope='row'>Email</th>\n"; 
	$html.="\t\t<td>$email</td>\n" ;
	$html.="\t</tr>\n" ; 
	
	$html.="\t<tr class=tr_account_usr>\n";
	$html.="\t<th scope='row'>Adresse</th>\n"; 
	$html.="\t\t<td>$adresse</td>\n" ;
	$html.="\t</tr>\n" ; 
    
	
	$html.="\t<tr id=tr_action_usr>\n"; 
	$html.="\t<th scope='row'>Action</th>\n"; 
	$a_update=html_a_update_user($id) ; 
	$html.="\t\t<td class=update>$a_update</td>\n" ;
	
	$a_delete=html_a_delete_user($id) ; 
	$html.="\t\t<td class=delete>$a_delete</td>\n" ;
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_user($id){
	$href="account.php?action=delete&table=Utilisateur&id=$id" ; 
	$html="<a href='$href'>Supprimer votre compte</a>" ;
       	return $html; 	
}

/**
 * Lien de maj
 */
function html_a_update_user($id){
	$href="account.php?action=update&table=Utilisateur&id=$id" ; 
	$html="<a href='$href'>Modifier</a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un etudiant
 */
function html_form_maj($user){
	$id=$user["id"];
	$nom=$user["nom_usr"]; 
	$prenom=$user["prenom_usr"];
	$email=$user["email"] ;
	$adresse=$user["adresse"];
	$Mdp=$user["Mdp"];
	
	
    
	
	
	$html="<form action='admin_usr.php' method='POST'id=form_maj_usr>\n" ; 
	
	$html.="<div id=nom_form>";
	$html.="<label for='nom'>Nom</label>\n" ;
	$html.="\t<input type='text' name='nom_usr' value='$nom'>\n" ; 
    $html.="</div>";
	
	
	$html.="<div id=prenom_form>";
	$html.="<label for='prenom'>Prénom</label>\n" ;
	$html.="\t<input type='text' name='prenom_usr' value='$prenom'>\n" ; 
	$html.="</div>";
	
	$html.="<div id=email_form>";
	$html.="<label for='email'>Email</label>\n" ;
	$html.="\t<input type='text' name='email' value='$email'>\n" ; 
    $html.="</div>";
	
	$html.="<div id=adresse_form>";
	$html.="<label for='adresse'>Adresse</label>\n" ;
	$html.="\t<input type='text' name='adresse' value='$adresse'>\n" ;
	$html.="</div>";
	
	$html.="<div id=mdp_form>";
	$html.="<label for='mdp'>Mot de passe</label>\n" ;
	$html.="\t<input type='password' name='Mdp'>\n" ; 
	$html.="</div>";
	
	$html.="\t<input type='hidden' name='id' value='$id'>\n" ; 
	$html.="\t<input type='hidden' name='action' value='update'>\n" ; 
	
	$html.="<div id=envoie_form>";
	$html.="\t<input type='submit'>\n" ; 
	$html.="</div>";
	
	$html.="</form>\n";


	return $html ; 
}

?>
