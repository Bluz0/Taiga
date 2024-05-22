<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style-header.css">
</head>
<body>
    
    <header>
        <a href="index.php" class="Logo"><img id="logoo" src="images/main/logo_taiga.png"></a>

        <div class="searchbox">
            <input id="fake-search" type="text" onkeydown="if (event.keyCode == 13) produit_autre_page()" placeholder="Ordinateurs, Smartphones, Enceintes...">
        </div>

        <div class="group">
            <ul class="navigation">
                <li><a href="#">Accueil</a></li>
                <li><a href="lib/">Categories</a></li>
                <li><a href="#">A propos</a></li> <!-- Ne pas rediriger panier mais ouvrir une ptite fenetre -->
                <li><a href="#">Contact</a></li> 
                <li><a href="lib/account-connexion.php" id="connexion"><img height="30px" width="30px" id="account-img" src="images/main/la-personne.png"></a></li>
                <li><a href="#"><img height="30px" width="30px" id="cart-img" src="images/main/carte.png"></a></li>
            </ul>
        </div>
    </header>

<script>
    var connexion= document.getElementById("connexion");
    var session = <?php echo json_encode($_SESSION)?>;
    if(session!=[]){
        cle=Object.keys(session);
        if(cle[0]=="admin"){
            connexion.setAttribute("href","lib/admin.php");
        }
        else if(cle[0]=="user"){
            connexion.setAttribute("href","lib/user_tmp.php");
        }
    
    }



</script>






</body>
</html>