	var url = new URL(window.location.href);
	var search_params = new URLSearchParams(url.search);

	/*permet de recupérer l'id produit en parm url et renvoie sur l'index si pas d'id*/
	if (search_params.has('id')) {
		var id = search_params.get('id');
		console.log(window.location.href + '\n' + id)
	}

	else{ 
		document.location.replace("https://l1.dptinfo-usmb.fr/~grp18/index.php",);
	}

	le_form = document.querySelector("form");

	let num_id_article = document.createElement("input");
	num_id_article.type = "number";
	num_id_article.name = "ro_article";
	num_id_article.value = id;
	num_id_article.style.display = "none";

	le_form.appendChild(num_id_article);




	// let le_form = document.querySelector("form");
	// let num_id_article = document.createElement("input");
	// num_id_article.type = "number";
	// num_id_article.name = "ro_article";
	// num_id_article.value = id;
	// le_form.appendChild(num_id_article);
		
	fetch("article_id_json.php?id="+id).then(json_to_data).then(adapt_page_article);
		
	function json_to_data(rep) { //Transforme les donnees JSON en donnees JS
		return rep.json();
	}
		
		function adapt_page_article(data){
			
			
		for (let i = 1; i < 7; i++){//gestion des imgs
				
			div_barre = document.querySelector("#img"+i.toString()+"_");
			div_img = document.querySelector("#img"+i.toString());
			let img = new Image();
			img.className = "img_produit";
				
			if(i===1){ 
				img.src = 'data:image/png;base64,'+data["image"];
			} 
			else { 
				img.src = 'data:image/png;base64,'+data["image"+i.toString()];
			}
			
			if(img.src === 'data:image/png;base64,'){
				label = document.querySelector("#lbl_img"+i.toString());
				label.style.display = "none";
			}
				
				
				
			div_barre.appendChild(img);
			ig = img.cloneNode(true);
			div_img.appendChild(ig);
		}
		
		let titre = data["titre"];
		let prix = data["prix"];
		let prix_sold = Math.round((prix/100*70)*100)/100;
		let categorie = data["num_cat"];
		if (categorie == 1){
			nom_cat_article = "Enceintes";
		}else if (categorie == 2){
			nom_cat_article = "Ordinateurs";
		}else if (categorie == 3){
			nom_cat_article = "Tablettes";
		}else if (categorie == 4){
			nom_cat_article = "Télévisions";
		}else if (categorie == 5){
			nom_cat_article = "Téléphones";
		}else if (categorie == 6){
			nom_cat_article = "Clavier-Souris";
		}else if (categorie == 7){
			nom_cat_article = "Ecrans";
		}
		document.getElementById("cat_article_actuel").innerHTML = nom_cat_article;
		document.getElementById("cat_article_actuel").href = ("catalogue_entier_json.php?num_cat="+categorie);
		document.getElementById("prx_base").innerHTML = prix+" €";
		document.getElementById("prx_sold").innerHTML = prix_sold+" €";
		document.getElementById("article_actuel").innerHTML = titre;
		document.getElementById("h1_article_actuel").innerHTML = titre;
		document.getElementById("txt_descr").innerHTML = data["description"];
	}
	

	fetch("article_json.php").then(json_to_data).then(produit_carte);
	let chargement_actif = true;
			
	function json_to_data(rep) { //Transforme les donnees JSON en donnees JS
		return rep.json();
	}

	let page_article = document.getElementById("catalogue-all-index");

	function produit_carte(data){

		chargement_actif = false;
			
		document.getElementById("loader").style.display = "none";


		for (let i = 0; i < data.length; i++) { // Pour chaque produit

			let images_art = new Image(); // Creation d'une image pour chaque produit
			let div_art = document.createElement("div"); // Creation d'une div pour chaque produit
			div_art.className = "div-produit"; // Ajout d'une classe a la div
			let titre_art = document.createElement("h3"); // Creation d'un titre pour chaque produit
			let prix_art = document.createElement("h3"); // Creation d'un prix pour chaque produit
			let description_art = document.createElement("p"); // Creation d'une description pour chaque produit
			description_art.className = "description"; // Ajout d'une classe a la description

			div_art.style.display = "inline-block"; // Style de la div
			div_art.style.border = "1px solid #9d9c9c"; // Style de la div
			div_art.style.height = "450px"; // Style de la div
			div_art.style.width = "19.89%"; // Style de la div

			images_art.src = 'data:image/png;base64,'+data[i]["image"]; // Ajout de l'image particulier car base64
			images_art.width = 300; // Taille de l'image
			images_art.height = 200; // Taille de l'image
			images_art.alt = "Image du produit"; // Texte alternatif de l'image
			images_art.style.objectFit = "contain"; // Ajustement de l'image

			titre_art.innerHTML = data[i]["titre"]; // Ajout du nom du produit
			//console.log(data[i]["titre"]);
			prix_art.innerHTML = data[i]["prix"]+"€"; // Ajout du prix du produit
			description_art.innerHTML = data[i]["description"]; // Ajout de la description du produit
			let lien_art = document.createElement("a"); // Creation d'un lien pour chaque produit
			lien_art.href = "article.php?id="+data[i]["id"]; // Lien vers la page du produit
			lien_art.style.textDecoration = "none"; // Style du lien
			lien_art.style.color = "inherit";

			//Formulaire pour ajouter au panier 
			let formulaire_panier_art = document.createElement("form"); // Creation d'un formulaire pour chaque produit
			formulaire_panier_art.method = "post"; // Methode du formulaire
			formulaire_panier_art.action = "article.php"; // Action du formulaire
			let quantite_panier_art = document.createElement("input"); // Creation d'un input pour chaque produit
			quantite_panier_art.type = "number"; // Type de l'input
			quantite_panier_art.name = "quantite"; // Nom de l'input
			quantite_panier_art.value = 1; // Valeur de l'input
			quantite_panier_art.min = 1; // Valeur minimale de l'input
			quantite_panier_art.className = "quantite"; // Ajout d'une classe a l'input
			quantite_panier_art.style.display = "none";

			// Numero d'article pour le panier (invisible)
			let numero_art = document.createElement("input");
			numero_art.type = "number";
			numero_art.name = "numero_article";
			numero_art.value = data[i]["id"];
			numero_art.style.display = "none";
			numero_art.className = "article_id_2";
						
			let panier_art = document.createElement("input"); // Creation d'un bouton pour chaque produit
			panier_art.type = "submit"; // Type du bouton
			panier_art.value = "Ajouter au panier"; // Texte du bouton
			panier_art.className = "panier"; // Ajout d'une classe au bouton
			panier_art.name = "bouton_panier"; // Nom du bouton

			// Les ajouts
			div_art.appendChild(images_art); // Ajout de l'image dans la div

			lien_art.appendChild(titre_art); // Ajout du titre dans le lien
			div_art.appendChild(lien_art); // Ajout du lien dans la div

			div_art.appendChild(prix_art); // Ajout du prix dans la div
			div_art.appendChild(description_art); // Ajout de la description dans la div
			// Redirection vers la page du produit (onclick)

			formulaire_panier_art.appendChild(quantite_panier_art); // Ajout de l'input dans le formulaire
			formulaire_panier_art.appendChild(numero_art); // Ajout du numero dans la div
			formulaire_panier_art.appendChild(panier_art); // Ajout du bouton dans le formulaire


			div_art.appendChild(formulaire_panier_art); // Ajout du formulaire dans la div
		page_article.appendChild(div_art); // Ajout de la div dans la div de base
		}

			
	}

	function search(){ // Fonction pour la recherche

		if(chargement_actif == true){ // Si le chargement est actif
			document.getElementById("loader").style.display = ""; 
		}
			
		else{
			document.getElementById("loader").style.display = "none";
		}

		let input = document.getElementById("search"); // Input de recherche
		let filter = input.value.toUpperCase(); // Valeur de l'input en majuscule
		let div = document.getElementById("catalogue-all-index"); // Div de base
		let produit = div.getElementsByClassName("div-produit"); // Div de chaque produit
		let contenu_principal = document.querySelector("main"); // A la une, catégories ...etc

		if (input.value == "") { // Si la recherche est vide
			div.style.display = "none";
			contenu_principal.style.display = "";
		}

		else{
			div.style.display = "inline-block";
			contenu_principal.style.display = "none";
		}

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
			