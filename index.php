<?php
    session_start(); //Pour accéder aux variables de session
    
    include('db/db_connect.php');
    include('crud/panier_crud.php');
    include('crud/article_crud.php');
    
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
    <title>Acceuil - Taiga</title>
    <link rel="icon" type="image/png" href="images/main/favicon-logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>

    <header>
            <a href="index.php" class="Logo"><img id="logoo" src="images/main/logo_taiga.png"></a>

            <div class="searchbox">
                <input id="search" type="text" onkeyup="search()" placeholder="Ordinateurs, Smartphones, Enceintes...">
            </div>

            <!-- onkeydown="if (event.keyCode == 13) search()" -->

            <div class="group">
                <ul class="navigation">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="#cat-cat">Categories</a></li>
                    <li><a href="lib/faq.php">A propos</a></li> <!-- Ne pas rediriger panier mais ouvrir une ptite fenetre -->
                    <li><a href="lib/form_contact.php">Contact</a></li> 
                    <li><a href="lib/account-connexion.php" id="connexion"><img height="30px" width="30px" id="account-img" src="images/main/la-personne.png"></a></li>
                    <li><a href="lib/cart.php"><img height="30px" width="30px" id="cart-img" src="images/main/carte.png"></a></li>
                </ul>
            </div>
        </header>


    <div class="slider">
        <div class="slides">
            <div class="banner-img">
                <img src="images/main/banner-thirty.png" alt="banner">
                <img src="images/main/banner-ipad.png" alt="banner">
                <img src="images/main/banner-enceinte.png" alt="banner">
                <img src="images/main/banner-tv.png" alt="banner">
            </div>
        </div>

    </div>

    <div id="loader" style="display:none;"></div>
    <div id="catalogue-all-index" style="display:none;"></div>
    <main>


        <div class="categories-index" id="cat-cat">
            
            <div class="box-categorie">
                
                <section class="paper-border-shadow-shadow-large">

                    <ul class="card-list">
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=2" ><img class="img-cato" src="images/articles/laptop-img.png" alt="image ordinateur"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=2">Ordinateurs</a>            
                            </h2>
                        </li>
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=5"><img class="img-cato" src="images/articles/smartphone-img.png" alt="smartphone-image"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=5">Smartphones</a>            
                            </h2>
                        </li>
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=4"><img class="img-cato" src="images/articles/tv-img.png" alt="image tv"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=4">Televisions</a>            
                            </h2>
                        </li>
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=7"><img class="img-cato" src="images/articles/periph.png" alt="image ecran"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=7">Ecrans</a>            
                            </h2>
                        </li>
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=1"><img class="img-cato" src="images/articles/enceinte-img.png" alt="image enceinte"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=1">Enceintes</a>            
                            </h2>
                        </li>
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover">          
                            <a href="lib/catalogue_entier_json.php?num_cat=6"><img class="img-cato" src="images/articles/clavier-img.png" alt="image clavier"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=6">Peripheriques</a>            
                            </h2>
                        </li>  
                        
                        <li class="paper-border-shadow-shadow-large-shadow-hover" id="tout-seul-le-pauvre">          
                            <a href="lib/catalogue_entier_json.php?num_cat=3"><img class="img-cato" src="images/articles/tablette-img.png" alt="image tablette"></a>
                            <h2>
                                <a href="lib/catalogue_entier_json.php?num_cat=3">Tablettes</a>            
                            </h2>
                        </li>

                        
                    </ul>
                </section>
        </div>
        
        <br>
        <br>
            
    </main>


    <!-- Fetch avec js -->

    <script>

        // CONNEXION
        var connexion= document.getElementById("connexion");
        var session = <?php echo json_encode($_SESSION)?>;
        console.log(session);
        if(session!=[]){
            cle=Object.keys(session);
            if(cle[0]=="admin"){
                connexion.setAttribute("href","lib/admin.php");
            }
            else if(cle[0]=="user"){
                connexion.setAttribute("href","lib/user.php");
            }
        
        }

        // FONCTION DE RECHERCHE DE PRODUIT
        fetch("lib/article_json.php").then(json_to_data).then(produit_card);
        let chargement_actif = true;
    
        function json_to_data(rep) { //Transforme les donnees JSON en donnees JS
            return rep.json();
        }
    
        div_base = document.querySelector("#catalogue-all-index");
        
        function produit_card(data){ //Utilise les donnees pour construire l'interface
            chargement_actif = false;
            document.getElementById("loader").style.display = "none";
                

            for(let i = 0; i < data.length; i++){ 
                
                let images = new Image(); // Creation d'une image pour chaque produit
                let div = document.createElement("div"); // Creation d'une div pour chaque produit
                div.className = "div-produit"; // Ajout d'une classe a la div
                let titre = document.createElement("h3"); // Creation d'un titre pour chaque produit
                let prix = document.createElement("h3"); // Creation d'un prix pour chaque produit
                let description = document.createElement("p"); // Creation d'une description pour chaque produit
                description.className = "description"; // Ajout d'une classe a la description

                div.style.display = "inline-block"; // Style de la div
                div.style.border = "1px solid #9d9c9c"; // Style de la div
                div.style.height = "450px"; // Style de la div
                div.style.width = "19.89%"; // Style de la div ou 300px si ca bug

                // Style image
                images.src = 'data:image/png;base64,'+data[i]["image"]; // Ajout de l'image particulier car base64
                images.width = 300; // Taille de l'image
                images.height = 200; // Taille de l'image
                images.alt = "Image du produit"; // Texte alternatif de l'image
                images.style.objectFit = "contain"; // Ajustement de l'image


                titre.innerHTML = data[i]["titre"]; // Ajout du nom du produit
                prix.innerHTML = data[i]["prix"]+"€"; // Ajout du prix du produit
                description.innerHTML = data[i]["description"]; // Ajout de la description du produit
                let lien = document.createElement("a"); // Creation d'un lien pour chaque produit
                lien.href = "lib/article.php?id="+data[i]["id"]; // Lien vers la page du produit
                lien.style.textDecoration = "none"; // Style du lien
                lien.style.color = "inherit"; // Style du lien


                // Titre avec lien,prix,description
                // titre.innerHTML = data[i]["titre"]; // Ajout du nom du produit
                // prix.innerHTML = data[i]["prix"]+"€"; // Ajout du prix du produit
                // description.innerHTML = data[i]["description"]; // Ajout de la description du produit
                // let lien = document.createElement("a"); // Creation d'un lien pour chaque produit
                // lien.href = "lib/article.php?id="+data[i]["id"]; // Lien vers la page du produit

                //Formulaire pour ajouter au panier 
                let formulaire_panier = document.createElement("form"); // Creation d'un formulaire pour chaque produit
                formulaire_panier.method = "post"; // Methode du formulaire
                formulaire_panier.action = "index.php"; // Action du formulaire
                let quantite_panier = document.createElement("input"); // Creation d'un input pour chaque produit
                quantite_panier.type = "number"; // Type de l'input
                quantite_panier.name = "quantite"; // Nom de l'input
                quantite_panier.value = 1; // Valeur de l'input
                quantite_panier.min = 1; // Valeur minimale de l'input
                quantite_panier.className = "quantite"; // Ajout d'une classe a l'input
                quantite_panier.style.display = "none";

                

                // Numero d'article pour le panier (invisible)
                let numero = document.createElement("input");
                numero.type = "number";
                numero.name = "numero_article";
                numero.value = data[i]["id"];
                numero.style.display = "none";
                numero.className = "article_id";
                
                let panier = document.createElement("input"); // Creation d'un bouton pour chaque produit
                panier.type = "submit"; // Type du bouton
                panier.value = "Ajouter au panier"; // Texte du bouton
                panier.className = "panier"; // Ajout d'une classe au bouton
                panier.name = "bouton_panier"; // Nom du bouton
                
                
                // Les ajouts
                div.appendChild(images); // Ajout de l'image dans la div

                lien.appendChild(titre); // Ajout du titre dans le lien
                div.appendChild(lien); // Ajout du lien dans la div
                
                div.appendChild(prix); // Ajout du prix dans la div
                div.appendChild(description); // Ajout de la description dans la div
                // Redirection vers la page du produit (onclick)

                formulaire_panier.appendChild(quantite_panier); // Ajout de l'input dans le formulaire
                formulaire_panier.appendChild(numero); // Ajout du numero dans la div
                formulaire_panier.appendChild(panier); // Ajout du bouton dans le formulaire
                
                
                div.appendChild(formulaire_panier); // Ajout du formulaire dans la div


            div_base.appendChild(div); // Ajout de la div dans la div de base
            
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
            

        }

    ?>



<footer class="div-footer">
	<?php include "lib/footer.php"; ?>
</footer>
</body>
</html>