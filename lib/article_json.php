<?php


    include("../db/db_connect.php");
    include("../crud/article_crud.php");

    $articles = liste_produit($conn); // select_1_produit est une fonction de article_crud.php

    foreach ($articles as $key => $article) { // Pour chaque article
        if(!empty($article['image'])){
			$articles[$key]['image'] = base64_encode($article['image']);
		}
		if(!empty($article['image2'])){
			$articles[$key]['image2'] = base64_encode($article['image2']);
		}
		if(!empty($article['image3'])){
			$articles[$key]['image3'] = base64_encode($article['image3']);
		}
		if(!empty($article['image4'])){
			$articles[$key]['image4'] = base64_encode($article['image4']);
		}
		if(!empty($article['image5'])){
			$articles[$key]['image5'] = base64_encode($article['image5']);
		}
		if(!empty($article['image6'])){
			$articles[$key]['image6'] = base64_encode($article['image6']);
		}
		// On encode l'image en base64 car nos images sont de type blob
    }

    // Convertit en json
    $articles_json = json_encode($articles);

    header('Content-Type: application/json; charset=UTF-8'); 
    echo $articles_json;


?>



<?php // Recupere liste articles en PHP N'ENLEVEZ SURTOUT PAS !!!!

    // $res=mysqli_query($conn, "SELECT * FROM `Produit`");
    // while($row=mysqli_fetch_assoc($res)){

    //     //echo "<img class=\"img-product\" src=\"data:image/jpeg;base64,".base64_encode($row["image"]). "\" style=\"height:300px; width:350px;\" />";
    //     $image = base64_encode($row["image"]); 
    //     $image = $row["image"];
        
    //     // Si les images sont trop degeu utilise object-fit
    // } 
?>



