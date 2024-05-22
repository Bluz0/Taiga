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
