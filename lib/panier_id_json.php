<?php

    include("../db/db_connect.php");
    include("../crud/article_crud.php");

    
    
    // $paniers = "SELECT * FROM `Produit` WHERE `id` = ".$_GET["id"];
    // $result = mysqli_query($conn, $paniers);
    // $paniers = mysqli_fetch_assoc($result);

    $paniers = liste_produit_id($conn, $_GET["id"]);

    foreach ($paniers as $key => $panier) {
        $paniers[$key]['image'] = base64_encode($panier['image']); // On encode l'image en base64 car nos images sont de type blob
    }
    // Convertit en json
    $panier_json = json_encode($paniers);

    header('Content-Type: application/json; charset=UTF-8'); 
    echo $panier_json;

?>