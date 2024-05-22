
<?php

    include("../db/db_connect.php");
    include("../crud/panier_crud.php");

    session_start();
    
    $panier = liste_panier_user($conn, $_SESSION["user"]);

    // Convertit en json
    $panier_json = json_encode($panier);

    header('Content-Type: application/json; charset=UTF-8'); 
    echo $panier_json;

?>