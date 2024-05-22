<?php
    session_start(); //Pour accéder aux variables de session
    
    include('../db/db_connect.php');
    include('../crud/panier_crud.php');
    
    if(isset($_GET["action"])){
        $action=$_GET["action"];
        if($action =="disconnect"){session_destroy();}; //Supprime la session en cours après une deconnexion
    };
    

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article - Taiga</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
		<a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

            <div class="searchbox">
                <input id="search" type="text" onkeyup="search()" placeholder="Ordinateurs, Smartphones, Enceintes...">
            </div>

            <!-- onkeydown="if (event.keyCode == 13) search()" -->

            <div class="group">
                <ul class="navigation">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../index.php#cat-cat">Categories</a></li>
                    <li><a href="faq.php">A propos</a></li>
                    <li><a href="#">Contact</a></li> 
                    <li><a href="account-connexion.php" id="connexion"><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                    <li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
                </ul>
            </div>
    </header>

	<div id="chemin" class="lien_chemin">
            <ul>
                <li>
                    <a href="../index.php">Accueil</a>
                </li>
                <li>
                    <a id="cat_article_actuel">Categorie</a>
                </li>
                <li>
                    <a href="#" id="article_actuel"></a>
                </li>
			</ul>
		</div>
		
	<div id="loader" style="display:none;"></div>
    <div id="catalogue-all-index" style="display:none;"></div>

	

    <main class="page_article_pour_panier">
		
        <div class="page_produit">
			<div class="pres_produit">
				<div class="imgs_produit">
					<input id="Imgprdt1" type="radio" name="img" hidden checked />
					<div id="img1" class="box_img_produit">
						<!--img class="img_produit" src="../images/main/test1.png"-->
					</div>
					<input id="Imgprdt2" type="radio" name="img" hidden />
					<div id="img2" class="box_img_produit">
						
					</div>
					<input id="Imgprdt3" type="radio" name="img" hidden />
					<div id="img3" class="box_img_produit">
						
					</div>
					<input id="Imgprdt4" type="radio" name="img" hidden />
					<div id="img4" class="box_img_produit">
						
					</div>
					<input id="Imgprdt5" type="radio" name="img" hidden />
					<div id="img5" class="box_img_produit">
						
					</div>
					<input id="Imgprdt6" type="radio" name="img" hidden />
					<div id="img6" class="box_img_produit">
						
					</div>
					<!-- section de la barre d'image les labels servant a afficher l'image en grand sans js (html/css) -->
					<div class="barre_imgs_produit">
						<label id="lbl_img1" for="Imgprdt1">
							<div id="img1_" class="img_barre_imgs_produit">
								<!--img class="img_produit" src="../images/main/test1.png"-->
							</div>
						</label>
						<label id="lbl_img2" for="Imgprdt2">
							<div id="img2_" class="img_barre_imgs_produit">

							</div>
						</label>
						<label id="lbl_img3" for="Imgprdt3">
							<div id="img3_" class="img_barre_imgs_produit">

							</div>
						</label>
						<label id="lbl_img4" for="Imgprdt4">
							<div id="img4_" class="img_barre_imgs_produit">

							</div>
						</label>
						<label id="lbl_img5" for="Imgprdt5">
							<div id="img5_" class="img_barre_imgs_produit">

							</div>
						</label>
						<label id="lbl_img6" for="Imgprdt6">
							<div id="img6_" class="img_barre_imgs_produit">

							</div>
						</label>
					</div>
				</div>
				<div class="txt_produit" id="txt_produit">
						<h1 id="h1_article_actuel" class="titre_produit"></h1>
					<div id="prix_produit"> 
                      <span id="prx_base" class="prix_produit_base"></span>
                      <span id="prx_sold" class="prix_produit_sold"></span-->
					</div>
					<div class="ajout_panier">
						<form method="post" action="" class="form-achat">

							<input type="number" name="qty" id="quantite_voulue" value="1" min="1" max="99" style="display:none;">
							<input class="btn_ajout_panier" name="bouton_article" type="submit" value="Ajouter au panier">
							
							<!-- <a class="btn_wishlist" href="#"><img class="coeur_wishlist" src="../images/main/coeur_n.png"></a>  -->
						</form> 
					</div>
					<div class="description_produit">
						<h2 id="ttr_descr">Descripton du produit</h2>
						<br>
						<p id="txt_descr">
						</p-->
					</div>
				</div>
			</div>
		</div>
	</main>
	
	
	<script>

		// CONNEXION
        var connexion= document.getElementById("connexion");
        var session = <?php echo json_encode($_SESSION)?>;
        console.log(session);
        if(session!=[]){
            cle=Object.keys(session);
            if(cle[0]=="admin"){
                connexion.setAttribute("href","admin.php");
            }
            else if(cle[0]=="user"){
                connexion.setAttribute("href","user.php");
            }
        
        }

	</script>

	<script type="text/javascript" src="../scripts/script_article.js">
	</script>

	<?php


	if(isset($_POST)){
		$quantite = 1; // Quantite de l'article
		$id_usr = $_SESSION["user"]; // Id de l'utilisateur
		$article = $_POST["numero_article"]; // Id de l'article
		$action = $_POST["bouton_panier"]; // Action du bouton

		if($action == "Ajouter au panier"){ // Si l'utilisateur clique sur ajt au panier
			insert_panier($conn, $id_usr, $article, $quantite); // Ajout de l'article dans le panier
		}

		
		
		$qty_article = 1; // Quantite de l'article
		$action_article = $_POST["bouton_article"]; // Action du bouton de l'article
		$article_art = $_POST["ro_article"]; // Id de l'article

		if($action_article == "Ajouter au panier"){ // Si l'utilisateur clique sur ajt au panier
			insert_panier($conn, $id_usr, $article_art, $qty_article); // Ajout de l'article dans le panier
		}
		

	}

	?>

<footer class="div-footer">
	<?php include "footer.php"; ?>
</footer>
</body>
</html>
