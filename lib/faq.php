<?php
    session_start(); //Pour accéder aux variables de session
    
    include('../db/db_connect.php');

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
    <title>A Propos - Taiga</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

        <header>
            <a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

            <div class="group">
                <ul class="navigation">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../index.php#cat-cat">Categories</a></li>
                    <li><a href="">A propos</a></li> <!-- Ne pas rediriger panier mais ouvrir une ptite fenetre -->
                    <li><a href="form_contact.php">Contact</a></li> 
                    <li><a href="account-connexion.php" id="connexion"><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                    <li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
                </ul>
            </div>
        </header>

        <section class="section-faq">
            <h2 class="titre-faq">FAQ TAIGA</h2>

            <div class="faq">
                <div class="questionnaire">
                    <h3>Qui sommes-nous ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25" fill="none">
                        <path d="M3 3L21 21L39 3" stroke="black" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="reponse">
                    <br>
                    <p>Nous sommes une entreprise de vente en ligne de produits électroniques. Notre site d'E-Commerce centré sur l'High-Tech vous propose une large gamme de produits allant des smartphones aux ordinateurs en passant par des tv, tablettes et bien plus encore...</p>
            
                </div>
            </div>

            <div class="faq">
                <div class="questionnaire">
                    <h3>Qui sont les fondateurs ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25" fill="none">
                        <path d="M3 3L21 21L39 3" stroke="black" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="reponse">
                    <p>Notre équipe est constituée de quatre personnes.<br>
                        <ul>
                            <br>
                            <li>Celui qui a contribué aux fonctions de recherches avec l'affichage des produits, d'ajouts aux paniers et traitement des paiements : <strong><a id="Bluzo" href="https://github.com/Bluz0" style="text-decoration:none; color:inherit">Mouats Amine</a></strong></li><br>
                            <li>Celle qui a permis aux fonctions de filtres d'articles et à la mise en place des pages d'articles individuelles de voir le jour : <strong>Struffi Camille</strong></li><br>
                            <li>Celui qui a apporté son savoir pour mettre en place des fonctions de connexions, d'inscriptions et surtout celui qui a établi les fonctions administrateurs : <strong>Julien-Dodsworth Lucas</strong></li><br>
                            <li>Celui qui a implementer la base de données et la mise en page du site : <strong>Moindjie Houssam</strong></li>
                        </ul>
                    </p>
            
                </div>
            </div>

            <div class="faq">
                <div class="questionnaire">
                    <h3>J'ai envie d'acheter 4 Iphone parce que je suis riche, comment faire ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25" fill="none">
                        <path d="M3 3L21 21L39 3" stroke="black" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="reponse">
                    <br>
                    <p>Connectez-vous où inscrivez-vous si cela n'est pas déjà fait. Sélectionner l'article de votre choix et ajouter l'au panier, puis cliquer sur le sac en haut à droite de votre écran. Vous atterrirez sur votre panier, vous pourrez ensuite choisir la quantité voulue avec l'affichage du prix en temps réel.</p>
                </div>
            </div>

            <div class="faq">
                <div class="questionnaire">
                    <h3>Y a t-il des Easter-Egg ?</h3>
                    <svg width="15" height="10" viewBox="0 0 42 25" fill="none">
                        <path d="M3 3L21 21L39 3" stroke="black" stroke-width="7" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="reponse">
                    <br>
                    <p>Oui plusieurs ! A vous de les trouver : Lem, la tv la plus cher du monde, la souris diamenté et peut-etre d'autres que l'on a oublié...</p>
                </div>
            </div>
        </section>

        <script src="../scripts/faq.js"></script>

<footer class="div-footer">
	<?php include "footer.php"; ?>
</footer>
    
</body>
</html>