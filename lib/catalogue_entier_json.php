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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue entier</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

        <div class="searchbox">
            <input type="text" id="search" onkeyup="search()" placeholder="Ordinateurs, Smartphones, Enceintes...">
        </div>

        <div class="group">
            <ul class="navigation">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../index.php#cat-cat">Categories</a></li>
                <li><a href="faq.php">A propos</a></li>
                <li><a href="#">Contact</a></li> 
                <li><a href="account.php"><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                <li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
            </ul>
        </div>
    </header>
	<div id="chemin" class="lien_chemin">
            <ul>
                <li>
                    <a href="../index.php">Accueil</a>
                </li>
			</ul>
		</div>
    <!-- onkeydown="if (event.keyCode == 13) search()" -->

    <div id="loader"></div>
	<div id="bloc_filtres" style="font-size: 1.3em;">
		<h2 style="margin-bottom:0.5em;">Filtres</h2>
		<h3>Prix</h3>
		<div class="price-input" style="margin-bottom: 0.5em;">
			<div id="field">
				<span style="margin-right: 0.8em;">Min</span>
				<input type="number" class="input-min" id="prix_mini" value="0" onchange ="filtres_complet();">
			</div>
			<div class="field">
				<span style="margin-right: 0.5em;">Max</span>
				<input type="number" class="input-max" id="prix_maxi" value="1000000" onchange ="filtres_complet();">
			</div>
		</div>
		<div id="barre_filtre_prix"><!--balise barre filtre prix-->
			<div class="slide">
				<div class="progress"></div>
			</div>
			<div class="range-input">
				<input type="range" class="range-min" min="0" max="3000" value="0" step="1" onchange ="filtres_complet();">
				<input type="range" class="range-max" min="0" max="3000" value="3000" step="1" onchange ="filtres_complet();">
			</div>
		</div>
		<h3 style="margin: 0.5em 0 0 0;">Catégories</h3>
		<div class="widget-content">
			<ul class="list-tags" style="padding-bottom: 0.5em;">         
				<li class="li_filtre_cat">
					<input type="checkbox" value="Enceintes" id="filtre_produit_cat_1" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_1" class="filtres_checkbox">Enceintes
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Ordinateurs" id="filtre_produit_cat_2" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_2" class="filtres_checkbox">Ordinateurs
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Tablettes" id="filtre_produit_cat_3" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_3" class="filtres_checkbox">Tablettes
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Télévisions" id="filtre_produit_cat_4" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_4" class="filtres_checkbox">Télévisions
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Téléphones" id="filtre_produit_cat_5" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_5" class="filtres_checkbox">Téléphones
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Clavier-Souris" id="filtre_produit_cat_6" onchange ="filtres_complet();">
					<label for="filtre_produit_cat_6" class="filtres_checkbox">Clavier-Souris
					</label>          
				</li>
				<li class="li_filtre_cat">
					<input type="checkbox" value="Ecrans" id="filtre_produit_cat_7" onchange="filtres_complet();">
					<label for="filtre_produit_cat_7" class="filtres_checkbox">Ecrans
					</label>          
				</li>
			</ul>
		</div>
	</div>
    <div id="catalogue-all"></div>
        <script>
		
		
		function fetch_affiche_db() {
			// Charger les données depuis article_json.php et retourner une promesse
			return fetch("article_json.php").then(json_to_data);
		}

		function chargement_page(myCallback) {
			// Utiliser Promise.all pour attendre que toutes les opérations asynchrones soient terminées
			Promise.all([fetch_affiche_db()]).then(function(data) {
				// Une fois toutes les opérations terminées, exécuter les autres fonctions
				let articleData = data[0]; // Les données de l'article récupérées
				onglet_article(articleData);
				produit_card(articleData);

				// Exécuter le callback une fois que toutes les autres fonctions sont terminées
				myCallback();
			});
		}

		// Appeler chargement_page en passant tri_id_cat comme callback
		//chargement_page(tri_num_cat);
		chargement_page(tri_num_cat);
		initial_check();
		
		function initial_check(){
			var url = new URL(window.location.href);
			var search_params = new URLSearchParams(url.search);
			if (search_params.has('num_cat')) {
			  var num_cat = search_params.get('num_cat');
			  console.log(window.location.href + '\n' + num_cat);
			  document.getElementById("filtre_produit_cat_"+num_cat).checked = true;
			}
		}
		
		
		//permet de recupérer la cat en param url et renvoie sur l'index si pas d'id
		function tri_num_cat(){
			var url = new URL(window.location.href);
			var search_params = new URLSearchParams(url.search);
			if (search_params.has('num_cat')) {
			  var num_cat = search_params.get('num_cat');
			  console.log(window.location.href + '\n' + num_cat);
			  div_base = document.querySelector("#catalogue-all");
			  div_base.style.display = "inline-block";
				let produit = div_base.getElementsByClassName("div-produit"); // Div de chaque produit
				for (let i = 0; i < produit.length; i++)  { // Chaque carte de produit 
					let categorie = produit[i].getElementsByTagName("h3")[2].textContent; // cat du produit
					if (!(categorie == num_cat)) { // Si une cat = true et que l'article a cette cat
						produit[i].style.display = "none"; // Afficher le produit	
					} 
				}
            }
			console.log("tri par cat");
        }
			
		
		
		
		
		
	//script pour  la barre du filtre de prix
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slide .progress");
let priceGap = 1;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});
//fin du script pour  la barre du filtre de prix
    
        function json_to_data(rep) { //Transforme les donnees JSON en donnees JS
            return rep.json();
        }
    
        div_base = document.querySelector("#catalogue-all");
        
     
        
        
        function produit_card(data){ //Utilise les donnees pour construire l'interface
            
            document.getElementById("loader").style.display = "none";

            for(let i = 0; i < data.length; i++){ 
                
                let images = new Image(); // Creation d'une image pour chaque produit
                let div = document.createElement("div"); // Creation d'une div pour chaque produit
                div.className = "div-produit"; // Ajout d'une classe a la div
                let titre = document.createElement("h3"); // Creation d'un titre pour chaque produit
                let prix = document.createElement("h3"); // Creation d'un prix pour chaque produit
				let cat = document.createElement("h3"); // Creation d'un categorie pour chaque produit
                let description = document.createElement("p"); // Creation d'une description pour chaque produit
                description.className = "description"; // Ajout d'une classe a la description
			


                //let lien = document.createElement("a"); // Creation d'un lien pour chaque produit
                //lien.href = "article.php?id="+data[i]["id"]; // Lien vers la page du produit

                div.style.display = "inline-block"; // Style de la div
                div.style.border = "1px solid #9d9c9c"; // Style de la div
                div.style.height = "450px"; // Style de la div
                div.style.width = "300px"; // Style de la div
				cat.style.display = "none";//cache la catégorie
				
                // Style image
                images.src = 'data:image/png;base64,'+data[i]["image"]; // Ajout de l'image particulier car base64
                images.width = 300; // Taille de l'image
                images.height = 200; // Taille de l'image
                images.alt = "Image du produit"; // Texte alternatif de l'image
                images.style.objectFit = "contain"; // Ajustement de l'image

                titre.innerHTML = data[i]["titre"]; // Ajout du nom du produit
                // Ajout un lien au titre pour pointer vers la page du produit avec ?data[i]["id"]

                prix.innerHTML = data[i]["prix"]+"€"; // Ajout du prix du produit
                description.innerHTML = data[i]["description"]; // Ajout de la description du produit
                cat.innerHTML = data[i]["num_cat"];//ajoute la catégorie a la balise cat
                //lien.style="outline: none; text-decoration: none; color: inherit;";
                
                
                // Les ajouts
                div.appendChild(images); // Ajout de l'image dans la div
                

                //lien.appendChild(titre); // Ajout du titre dans le lien
                //div.appendChild(lien); // Ajout du lien dans la div
                lien=+String(data[i]['id']);
                div.setAttribute("onclick","location.href='article.php?id="+lien+"'"); //Accède à la page de l'article
                div.appendChild(titre); // Ajout du titre dans la div
                div.style.cursor = "pointer"; //Change le pointeur de la souris
               
                //div.appendChild(titre); // Ajout du titre dans la div
                div.appendChild(prix); // Ajout du prix dans la div
                div.appendChild(description); // Ajout de la description dans la div
				div.appendChild(cat);//ajout de la cat au div
				div_base.appendChild(div); // Ajout de la div dans la div de base
            
            }



        }

        function myFunction() { // Fonction pour le loader
            myVar = setTimeout(produit_card, 3); 
            
                
           
        }

        function search(){ // Fonction pour la recherche
            let input = document.getElementById("search"); // Input de recherche
            let filter = input.value.toUpperCase(); // Valeur de l'input en majuscule
            let div = document.getElementById("catalogue-all"); // Div de base
            let produit = div.getElementsByClassName("div-produit"); // Div de chaque produit
            

            for (let i = 0; i < produit.length; i++) { // Chaque carte de produit 
                let titre = produit[i].getElementsByTagName("h3")[0]; // Titre du produit
                let txtValueTitre = titre.textContent || titre.innerText; // Valeur du titre du produit

                let description = produit[i].getElementsByTagName("p")[0]; // Description du produit
                let txtValueDescription = description.textContent || description.innerText; // Valeur de la description du produit
                
                
                if (txtValueTitre.toUpperCase().indexOf(filter) > -1 || txtValueDescription.toUpperCase().indexOf(filter) > -1) { // Si le titre ou la description correspond a la recherche
                    produit[i].style.display = ""; // Afficher le produit
                    
                } 
                else {
                    produit[i].style.display = "none"; // Cacher le produit

                }
            }
        }

        function filtres_cat(){ // Fonction pour la recherche
            var cat1 = document.getElementById("filtre_produit_cat_1").checked; // verifie l'état de la cat (true/false)
			var cat2 = document.getElementById("filtre_produit_cat_2").checked;
			var cat3 = document.getElementById("filtre_produit_cat_3").checked;
			var cat4 = document.getElementById("filtre_produit_cat_4").checked;
			var cat5 = document.getElementById("filtre_produit_cat_5").checked;
			var cat6 = document.getElementById("filtre_produit_cat_6").checked;
			var cat7 = document.getElementById("filtre_produit_cat_7").checked;
            let div = document.getElementById("catalogue-all"); // Div de base
            let produit = div.getElementsByClassName("div-produit"); // Div de chaque produit
            
			if (cat1 || cat2 || cat3 || cat4 || cat5 || cat6 || cat7) /*ne trie que si un filtre est coché*/{
				for (let i = 0; i < produit.length; i++) { // Chaque carte de produit 
					let categorie = produit[i].getElementsByTagName("h3")[2].textContent; // cat du produit
					if (!((cat1 && (categorie == 1)) || (cat2 && (categorie == 2)) || (cat3 && (categorie == 3)) || (cat4 && (categorie == 4)) || (cat5 && (categorie == 5)) || (cat6 && (categorie == 6)) || (cat7 && (categorie == 7)))) { // Si une cat = true et que l'article a cette cat
						produit[i].style.display = "none"; // Afficher le produit	
					} 
				}
            }
			console.log("tri par cat");
        }

		
		function filtre_prix(){//filtre par prix, a exe APRES filtres_cat (tres important sinon filtres_cat l'annule)
			var prx_min = document.getElementById("prix_mini").value;
			var prx_max = document.getElementById("prix_maxi").value;
			let div = document.getElementById("catalogue-all"); // Div de base
            let produit = div.getElementsByClassName("div-produit"); // Div de chaque produit
			for (let i = 0; i < produit.length; i++) {
				var prix_prdt = produit[i].getElementsByTagName("h3")[1].textContent;
				prix_prdt = parseInt(prix_prdt.substring(0, prix_prdt.length - 1));
				console.log(prix_prdt);
				if ((prx_min>prix_prdt) || (prx_max<prix_prdt)){//si le prix n'est pas dans la fourchette
					produit[i].style.display = "none"; // Cacher le produit
				}
			}
		}
		
			
		function filtres_complet(){//execute le tri avec un délai de 50ms pour le prix pour qu'il soit appliqué apres
			let div = document.getElementById("catalogue-all"); // Div de base
            let produit = div.getElementsByClassName("div-produit"); // Div de chaque produit
            for (let i = 0; i < produit.length; i++) { // Chaque carte de produit 
					produit[i].style.display = ""; // Afficher le produit	
				}
			setTimeout(() => { filtres_cat();filtre_prix();}, 500);
		}
		
        function onglet_article(data){

            console.log("Fonction est fetch");

            if (window.location.search != ""){ // Si il y a un id dans l'url
                
                let url = new URL(window.location.href); // Recuperation de l'url
                let id = url.searchParams.get("id"); // Recuperation de l'id
                let article = data.find(x => x.id == id); // Recuperation de l'article
                
                console.log("url :",url); // if url.href ...etc
                console.log("La page d'article individuel");
                console.log("Info de l'article :",article);

                div_base.style.display = "none"; // Cacher la div de base
            }
        }
		
    </script>


</body>
</html>

