<?php
function html_table_user($users){
	$html="<table id=table_usr>\n"; 
	$html.="\t<tr>\n"; 
	$html.="\t<th scope='col'>Id</th>\n"; 
	$html.="\t<th scope='col'>Nom</th>\n"; 
	$html.="\t<th scope='col'>Prénom</th>\n"; 
	$html.="\t<th scope='col'>Email</th>\n"; 
	$html.="\t<th scope='col'>Adresse</th>\n"; 
	$html.="\t<th scope='col'>Privilège</th>\n"; 
	$html.="\t<th scope='col'>Action</th>\n"; 
	$html.="\t</tr>\n"; 
	
	//creation des lignes 
	foreach($users as $user){
		$html.=html_tr_user($user); 	
	}

	$html.="</table>\n"; 
	return $html; 
}

/**
 * Ligne du tableau: user | id | nom | prenom | email | adresse | privilege
 */
function html_tr_user($user){
	$html="\t<tr class=tr_usr>\n"; 
	
	$id=$user["id"];
	$nom=$user["nom_usr"] ; 
	$prenom=$user["prenom_usr"] ;
	$email=$user["email"] ;
	$adresse=$user["adresse"];
	$Mdp=$user["Mdp"];
	$privilege=$user["privilege"] ;
	
    
    $html.="\t\t<td>$id</td>\n" ;
	$html.="\t\t<td>$nom</td>\n" ;
	$html.="\t\t<td>$prenom</td>\n" ;
    $html.="\t\t<td>$email</td>\n" ;
	$html.="\t\t<td>$adresse</td>\n" ;
	
	$html.="\t\t<td>$privilege</td>\n" ;

	$a_update=html_a_update_user($id) ; 
	$a_delete=html_a_delete_user($id) ;
	$html.="\t\t<td>$a_update\n" ;
	
	$html.="\t\t$a_delete</td>\n" ;
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_user($id){
	$href="admin_usr.php?action=delete&table=Utilisateur&id=$id" ; 
	$html="<a href='$href' ><img src='../images/admin/Remove_User.png' height='20px' width='20px'></a>" ;
       	return $html; 	
}

/**
 * Lien de maj
 */
function html_a_update_user($id){
	$href="admin_usr.php?action=update&table=Utilisateur&id=$id" ; 
	$html="<a href='$href' ><img src='../images/admin/profile-modification.png' height='20px' width='20px'></a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un utilisateur
 */

function select_priv($privilege){
		
	
	if($privilege=="admin"){
		$html="<option value='admin' selected>Administrateur</option>
		
		<option value='user'>Utilisateur</option>";

	}

	else if($privilege=="user"){
		$html="<option value='admin'>Admininstrateur</option>
		
		<option value='user' selected>Utilisateur</option>";

	
	}
	return $html;
}

 function html_form_maj($user){
	$id=$user["id"];
	$nom=$user["nom_usr"]; 
	$prenom=$user["prenom_usr"];
	$email=$user["email"] ;
	$adresse=$user["adresse"];
	$Mdp=$user["Mdp"];
	$privilege=$user["privilege"];
	
    
	
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
	

	$html.="<div id=privilege_form>";
	$html.="<label for='privilege'>Privilege</label>\n" ;
	$html.="\t<select name='privilege'> <option value=''>--Choisissez un privilège--</option>".select_priv($privilege)."</select>"; 
	

    $html.="</div>";
    
    
	$html.="\t<input type='hidden' name='Mdp' value='$Mdp'>\n" ; 
    $html.="\t<input type='hidden' name='id' value='$id'>\n" ; 
	$html.="\t<input type='hidden' name='action' value='update'>\n" ; 
	
	$html.="<div id=envoie_form>";
	$html.="\t<input type='submit'>\n" ; 
	$html.="</div>";
	
	$html.="</form>\n";

	return $html ; 
}

/**
 * Formulaire de creation d'un utilisateur
 */
function html_form_create(){
	$html="<form action='admin_usr.php' method='POST' id=form_create_usr>\n" ; 
    
	$html.="<div id=nom_form>";
	$html.="<label for='nom'>Nom</label>\n" ;
	$html.="\t<input type='text' name='nom_usr'>\n" ; 
    $html.="</div>";
	
	
	$html.="<div id=prenom_form>";
	$html.="<label for='noir'>Prénom</label>\n" ;
	$html.="\t<input type='text' name='prenom_usr'>\n" ; 
	$html.="</div>";
	
	$html.="<div id=email_form>";
	$html.="<label for='nom'>Email</label>\n" ;
	$html.="\t<input type='email' name='email' requiered='requiered'>\n" ; 
    $html.="</div>";
	
	$html.="<div id=adresse_form>";
	$html.="<label for='nom'>Adresse</label>\n" ;
	$html.="\t<input type='text' name='adresse'>\n" ;
	$html.="</div>";
	
	$html.="<div id=mdp_form>";
	$html.="<label for='nom'>Mdp</label>\n" ;
	$html.="\t<input type='password' name='Mdp' requiered='requiered'>\n" ;
	$html.="</div>";
	
	$html.="<div id=privilege_form>";
	$html.="<label for='nom'>Privilege</label>\n" ;
	$html.="\t<select name='privilege'> 
	<option value=''>--Choisissez un privilège--</option>
	<option value=admin>Administrateur</option>
	<option value=user>Utilisateur</option>
	
	</select>"; 
	$html.="</div>";
	
	$html.="\t<input type='hidden' name='action' value='create'>\n" ; 
    $html.="\t<input type='hidden' name='id'>\n" ; 
	
	
	$html.="<div id=envoie_form>";
	$html.="\t<input type='submit'>\n" ; 
	$html.="</div>";
    
    
    
    $html.="</form>\n";

	return $html ; 
}
?>
