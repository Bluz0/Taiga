<?php
/**
 * Formulaire de creation d'un article
 */
function html_form_create(){
	$html="<div id=div_ajout_article>";
    
    $html.="<h1 id=titre_ajout_article>Ajout d'article</h1>";
    $html.="<form action='admin_ajout_article.php' method='POST' enctype='multipart/form-data' id=form_ajout_article>\n" ; 
    
    $html.="<div id=titre_form>";
   
    $html.="<div id=titre_label_form><label for='titre'>Titre</label></div>\n" ;
	
    $html.="\t<input type='text' name='titre' >\n" ; 
    $html.="</div>";
    
    $html.="<div id=description_form>";
    $html.="<div id=description_label_form><label for='description'>Description</label>\n" ;
	$html.="\t<textarea rows='10' cols='50' name='description' wrap='soft' id=textarea_form></textarea>\n" ; 
    $html.="</div>";
    
    $html.="<div id=prix_form>";
    $html.="<div id=prix_label_form><label for='prix'>Prix</label></div>\n";
	$html.="\t<input type='number' step='any' name='prix'>\n" ; 
    $html.="</div>";
    
    $html.="<div id=nom_cat_form>";
    $html.="<div id=categorie_label_form><label for='nom_cat'>Catégorie</label></div>\n" ;
	$html.="\t<select name='nom_cat'> 
    <option value=''>--Choisissez une catégorie--</option>
    <option value='enceinte' >Enceinte</option>
	<option value='ordinateur'>Ordinateur</option>
	<option value='tablette'>Tablette</option>
	<option value='television'>Télévision</option>
	<option value='telephone>Téléphone</option>
	<option value='clavier_souris'>Clavier/Souris</option>
	<option value='ecran'>Ecran</option>
    </select>"; 
    $html.="</div>";					
    
    $html.="<div id=image_form>";
    $html.="<label for='image'>Sélectionner une image à uploader (PNG, JPG)</label>";
    $html.="<input
      type='file'
      id='image'
      name='image'
      accept='.jpg, .jpeg, .png'
      multiple
	 />";
    $html.="</div>";
    
   
    $html.="\t<input type='hidden' name='action' value='create'>\n" ; 
    
    $html.="<div id=envoie_form>";
    $html.="\t<input type='submit'>\n" ; 
    $html.="</div>";
    
    
    $html.="</form>\n";
    //$html.="<div id='preview'><p>Aucun fichier sélectionné pour le moment</p></div>";
    //$html.="<script src='../scripts/fct_admin.js'></script>";
	$html.="</div>";
	return $html ; 
}





 
?>