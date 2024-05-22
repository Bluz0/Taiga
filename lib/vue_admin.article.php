<?php

/**
 * Ligne du tableau: produit | id | titre | description | image | num_cat |
 */
function html_tr_produit($produit){
	
	$id=$produit["id"];
	$titre=$produit["titre"] ; 
	$description=$produit["description"] ;
	$prix=$produit["prix"];
	$image=base64_encode($produit["image"]); 
	$num_cat=$produit["num_cat"];
	$images=json_encode($image);
	
	if($num_cat==1){
		$nom_cat="Enceinte";

	}

	else if($num_cat==2){
		$nom_cat="Ordinateur";
	}

	else if($num_cat==3){
		$nom_cat="Tablette";
		
	}
	else if($num_cat==4){
		$nom_cat="Télévision";
	}
	
	else if($num_cat==5){
		$nom_cat="Téléphone";
	}
	
	else if($num_cat==6){
		$nom_cat="Clavier/Souris";
	}
	
	else if($num_cat==7){$nom_cat="Ecran";}
	
	
		
	
	
	
	
	$html.="\t\t<div id=produit_image>";
	
	$html.="\t\t<div id=produit>";
	
	
	$html.="\t\t<h1 class=titre_produit id=titre>$titre</h1>\n" ;

	$html.="\t\t<div class=description_produit>\n <h2 id=ttr_descr>Descripton du produit</h2> <br> <p id=txt_descr>$description</p> </div>";


	$html.="\t\t<div id=prix>$prix €</div>\n" ;
   
	$html.="\t\t<div id=categorie_produit>";
	$html.="\t<h2>Catégorie</h2>\n"; 
	$html.="\t\t<div id=nom_cat>$nom_cat</div>\n" ;
	$html.="</div>\n" ;
	
	$html.="\t\t<div id=action>";
	$html.="\t<h2>Action</h2>\n"; 
	
	$a_update=html_a_update_produit($id) ; 
	$html.="\t\t<div id=update>$a_update</div>\n" ;
	
	$a_delete=html_a_delete_produit($id) ; 
	$html.="\t\t<div id=delete>$a_delete</div>\n" ;
	
	$html.="\t\t</div>";
	
	
	
	
	

	$html.="</div>";

	$html.="\t\t<div id=image_admin_article></div>\n" ;
	
	$html.="</div>";
  
	
	
	
	
	$html.="<script> 
	var td= document.getElementById('image_admin_article');
	let images = new Image();
	var image_php= $images;
	// Style image
	images.src = 'data:image/png;base64,'+ image_php; // Ajout de l'image particulier car base64
	images.width = 300; // Taille de l'image
	images.height = 200; // Taille de l'image
	images.alt = 'Image du produit'; // Texte alternatif de l'image
	images.style.objectFit = 'contain'; // Ajustement de l'image
	td.appendChild(images);
	</script>";
	
	
	
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_produit($id){
	$href="admin_article.php?action=delete&table=Produit&id=$id" ; 
	$html="<a href='$href'>Supprimer l'article</a>" ;
       	return $html; 	
}

/**
 * Lien de maj
 */
function html_a_update_produit($id){
	$href="admin_article.php?action=update&table=Produit&id=$id" ; 
	$html="<a href='$href'>Modififer</a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un article
 */

 function select_cat($num_cat){
		
	
	if($num_cat==1){
		$html="<option value='enceinte' selected>Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";

	}

	else if($num_cat==2){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'selected>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";
	}

	else if($num_cat==3){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'selected>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";
	}
	
	else if($num_cat==4){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'selected>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";
	}
	
	else if($num_cat==5){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'selected>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";
	}
	
	else if($num_cat==6){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris' selected>Clavier/Souris</option>
		<option value='ecran'>Ecran</option>";
	}
	
	else if($num_cat==7){
		$html="<option value='enceinte' >Enceinte</option>
		<option value='ordinateur'>Ordinateur</option>
		<option value='tablette'>Tablette</option>
		<option value='television'>Télévision</option>
		<option value='telephone'>Téléphone</option>
		<option value='clavier_souris'>Clavier/Souris</option>
		<option value='ecran' selected>Ecran</option>";
	}
	return $html;

}





 function html_form_maj($produit){
	$id=$produit["id"];
	$titre=$produit["titre"] ; 
	$description=$produit["description"] ;
	$prix=$produit["prix"];
	$image=$produit["image"];
	$num_cat=$produit["num_cat"];

	
	
	
	$html.="<form action='admin_article.php?id=$id' method='POST' enctype='multipart/form-data' id=form_article> \n" ; 
	
	$html.="<div id=titre_form>";
	$html.="<label for='titre'>Titre</label>\n" ;
	$html.="\t<input type='text' name='titre' value='$titre'>\n" ; 
    $html.="</div>";
   
	$html.="<div id=description_form>";
	$html.="<label for='description'>Description</label>\n" ;
	$html.="\t<textarea rows='8' cols='45' name='description' wrap='soft'>$description</textarea>\n" ; 
    $html.="</div>";
    
	$html.="<div id=prix_form>";
	$html.="<label for='prix'>Prix</label>\n";
	$html.="\t<input type='number' step='any' name='prix' value=$prix>\n" ; 
	$html.="</div>";
	
	$html.="<div id=image_form>";
	$html.="<label for='image'>Sélectionner une image à uploader (PNG, JPG)</label>";
    $html.="<input
      type='file'
      id='image'
      name='image'
      accept='.jpg, .jpeg, .png'
      multiple
	 />\n";
	$html.="</div>";
	
    
	$html.="<div id=nom_cat_form>";
	$html.="<label for='nom_cat'>Catégorie</label>\n" ;
	$html.="\t<select name='nom_cat'> <option value=''>--Choisissez une catégorie--</option>".select_cat($num_cat)."</select>"; 
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
