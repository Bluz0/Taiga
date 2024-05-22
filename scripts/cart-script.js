fetch("cart_json.php").then(json_to_data).then(affiche_panier);

            function json_to_data(rep){
                return rep.json();
            }

            var data_article_id = []; // Tableau pour les articles, leurs id et leurs quantités
            var data_produit = []; // Tableau pour les produits
            var total = 0; // Total des articles achetés 
            var info_client = document.querySelector(".compte-client-panier"); // Div pour les informations du client


            function affiche_panier(data){ // Fonction avec data -> qte,article...

                for (let i = 0; i < data.length; i++) { // Pour chaque article dans le panier
                    data_article_id.push(data[i]); // On ajoute l'article dans le tableau
                    total += parseInt(data[i]["qte"]); // On ajoute la quantité de l'article au total
                    
                }

                let payement = document.querySelector(".form-paiement"); // Formulaire pour le payement
                let div_payement = document.querySelector("#paiement-panier"); // Div pour le payement
                let numero_commande = document.createElement("input"); // Creation d'un numero de commande
                numero_commande.value = Math.floor(Math.random() * 1000000000); // Valeur du numero de commande a 10 chiffres
                numero_commande.name = "numero_commande"; // Nom du numero de commande
                numero_commande.style.display = "none"; // On cache le numero de commande

                if(total == 0){
                    div_payement.style.display = "none"; // On cache le formulaire de payement
                }

                payement.appendChild(numero_commande);


                info_client.innerHTML = "<h1 class=panier-titre style=text-align:center;>Bienvenue client n°<?php echo $_SESSION["user"]?></h1><h1 class=panier-titre style=text-align:center;>Mon panier("+total+")</h1>";
                
                for (let i = 0; i < data.length; i++) { // Pour chaque article dans le panier
                    fetch("panier_id_json.php?id="+data[i]["article"]).then(json_to_data).then(affiche_article); // Pour chaque article, on sollicite la fonction affiche_article pour afficher ces articles
                }

                function affiche_article(data){ // Fonction avec data -> id,titre,prix,description,image...
                    data_produit.push(data); // On ajoute l'article dans le tableau

                    let produit = document.getElementById("produit-acheté");
                    
                    let div_prix = document.getElementById("div-total-prix"); // Div pour le prix total
                    let prix_total = document.createElement("h3"); // Creation d'un prix total pour chaque produit
                    let tt = 0; // Faux Prix total

                    let tout = Array(); // Tableau pour les produits puisqu'il ne s'affiche pas en meme temps
                    for (let i = 0; i < data_produit.length; i++) {
                        tout.push(data_produit[i]);
                    }

                    for (let i = 0; i < tout.length; i++) {
                        if(tout[i] == undefined){ // Si le produit n'existe pas
                            console.log("existepas"); // On affiche un message d'erreur
                        }
                        else{
                            tt += parseFloat(tout[i][0]["prix"]*0.70); // On ajoute le prix du produit au total
                        }
                    }
                    info_client.innerHTML = "<h1 class=panier-titre style=text-align:center;>Bienvenue client n°<?php echo $_SESSION["user"]?></h1><h1 class=panier-titre style=text-align:center;>Mon panier("+total+")</h1><h1 class=panier-titre style=text-align:center>Prix Total :"+tt.toFixed(2)+"€</h1>"; // Les infos du client

                    the_total = tt; // Prix total

                    

                    for (let i = 0; i < data.length; i++){

                        let images = new Image(); // Creation d'une image pour chaque produit
                        let div = document.createElement("div"); // Creation d'une div pour chaque produit
                        div.className = "dans-le-panier"; // Ajout d'une classe a la div
                        div.style.backgroundColor = "#fff"; // Style de la div
                        let titre = document.createElement("h3"); // Creation d'un titre pour chaque produit
                        let prix = document.createElement("h3"); // Creation d'un prix pour chaque produit
                        let description = document.createElement("p"); // Creation d'une description pour chaque produit
                        description.className = "description-panier"; // Ajout d'une classe a la description

                        div.style.display = "inline-block"; // Style de la div
                        div.style.border = "1px solid #9d9c9c"; // Style de la div
                        div.style.height = "270px"; // Style de la div
                        div.style.width = "100%"; // Style de la div

                        // Style image
                        images.src = 'data:image/png;base64,'+data[i]["image"]; // Ajout de l'image particulier car base64
                        images.width = 300; // Taille de l'image
                        images.height = 200; // Taille de l'image
                        images.alt = "Image du produit"; // Texte alternatif de l'image
                        images.style.objectFit = "contain"; // Ajustement de l'image
                        images.style.paddingTop = "10px"; // Marge de l'image
                        images.style.float = "left"; // Decale a gauche


                        titre.innerHTML = data[i]["titre"]; // Ajout du nom du produit
                        prix.innerHTML = ((data[i]["prix"]*0.70).toFixed(2))+"€"; // Ajout du prix du produit
                        description.innerHTML = data[i]["description"]; // Ajout de la description du produit
                        let lien = document.createElement("a"); // Creation d'un lien pour chaque produit
                        lien.href = "article.php?id="+data[i]["id"]; // Lien vers la page du produit
                        titre.style.paddingTop = "15px"; // Marge du titre

                        let quantite_texte = document.createElement("p"); // Creation d'un paragraphe pour la quantité
                        quantite_texte.innerHTML = "Quantité : "; // Texte du paragraphe
                        quantite_texte.style.marginTop = "10px"; // Marge du paragraphe
                        let quantite = document.createElement("input"); // Création d'un input pour la quantité
                        quantite.type = "number"; // Type de l'input
                        quantite.className = "quantite-panier"; // Ajout d'une classe a l'input
                        quantite.min = 1; // Valeur minimale de l'input

                        let formulaire_panier_page = document.createElement("form"); // Creation d'un formulaire pour chaque produit pour supprimer
                        formulaire_panier_page.method = "POST";
                        formulaire_panier_page.action = "";

                        let id_article = document.createElement("input");
                        id_article.type = "number";
                        id_article.name = "id_article_panier";
                        id_article.className = "id-article-ca-bug-help"; // Ajout d'une classe a l'input
                        id_article.style.display = "none"; // On cache l'input
                        
                        let payement = document.querySelector(".form-paiement"); // Formulaire pour le payement
                    
                        for (let i = 0; i < data.length; i++) {
                            for (let j = 0; j < data_produit.length; j++) {
                                quantite.value = data_article_id[j]["qte"]; // Valeur de l'input quantite
                                id_article.value = data_article_id[j]["article"]; // Valeur de l'input pour l'id de l'article
                                
                            }
                        }

                        let valeur_precedente = parseInt(quantite.value); // Valeur precedente
                        
                        
                        quantite.addEventListener('input', function (event) {
                            

                            let nouvelle_valeur = parseInt(event.target.value);
                            total -= valeur_precedente; // Si on soustrait, on retire l'ancienne valeur
                            console.log("Ancienne value",valeur_precedente);
                            total += nouvelle_valeur; // Sinon on ajoute la nouvelle valeur
                            console.log("Nouvelle value",nouvelle_valeur);

                            if(nouvelle_valeur > valeur_precedente){ // Si la nouvelle valeur est plus grande que l'ancienne
                                the_total += parseFloat(data[0]["prix"]*0.70); // On ajoute le prix du produit
                            }
                            else{
                                the_total -= parseFloat(data[0]["prix"]*0.70); // Sinon on retire le prix du produit
                            }

                            valeur_precedente = nouvelle_valeur; // On met a jour la valeur precedente

                            info_client.innerHTML = "<h1 class=panier-titre style=text-align:center;>Bienvenue client n°<?php echo $_SESSION["user"]?></h1><h1 class=panier-titre style=text-align:center;>Mon panier("+total+")</h1><h1 class=panier-titre style=text-align:center>Prix Total :"+the_total.toFixed(2)+"€</h1>";
                        });

                        let bouton = document.createElement("input"); // Creation d'un bouton pour chaque produit
                        bouton.value = "Supprimer"; // Texte du bouton
                        bouton.name = "supprimer_btn"; // Nom du bouton
                        bouton.type = "submit"; // Type du bouton
                        bouton.className = "supprimer-panier"; // Ajout d'une classe au bouton

                        let prix_a_payer = document.createElement("input"); // Creation d'un input pour le prix a payer
                        prix_a_payer.value = the_total.toFixed(2); // Type de l'input
                        prix_a_payer.name = "prix_a_payer"; // Nom de l'input
                        prix_a_payer.style.display = "none"; // On cache l'input
                        payement.appendChild(prix_a_payer); // Ajout de l'input dans le formulaire de payement


                        div.appendChild(images); // Ajout de l'image dans la div

                        lien.appendChild(titre); // Ajout du titre dans le lien
                        div.appendChild(lien); // Ajout du lien dans la div
                        
                        div.appendChild(prix); // Ajout du prix dans la div
                        div.appendChild(description); // Ajout de la description dans la div
                        div.appendChild(quantite_texte); // Ajout du paragraphe dans la div
                        div.appendChild(quantite); // Ajout de l'input dans la div

                        formulaire_panier_page.appendChild(id_article);
                        formulaire_panier_page.appendChild(bouton);
                        div.appendChild(formulaire_panier_page);

                        div_prix.appendChild(prix_total); // Ajout du prix total dans la div

                        

                        //div.appendChild(bouton); // Ajout du bouton dans la div
                    produit.appendChild(div);
                    }

                } 
            }
