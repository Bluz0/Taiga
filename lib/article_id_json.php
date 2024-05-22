<?php

/*
    include("../db/db_connect.php");
    include("../crud/article_crud.php");

    $articles = liste_produit($conn); // select_1_produit est une fonction de article_crud.php

    foreach ($articles as $key => $article) { // Pour chaque article
        $articles[$key]['image'] = base64_encode($article['image']);
		$articles[$key]['image2'] = base64_encode($article['image2']);
		$articles[$key]['image3'] = base64_encode($article['image3']);
		$articles[$key]['image4'] = base64_encode($article['image4']);
		$articles[$key]['image5'] = base64_encode($article['image5']);
		$articles[$key]['image6'] = base64_encode($article['image6']);// On encode l'image en base64 car nos images sont de type blob
    }

    // Convertit en json
    $articles_json = json_encode($articles);

    header('Content-Type: application/json; charset=UTF-8'); 
    echo $articles_json;
*/

?>

<?php

    include("../db/db_connect.php");
    include("../crud/article_crud.php");
    $ID = $_GET["id"];
    $article = select_1_produit($conn,$ID); // select_1_produit est une fonction de article_crud.php

	if(!empty($article['image'])){
    $article['image'] = base64_encode($article['image']);// On encode l'image en base64 car nos images sont de type blob
	}
	if(!empty($article['image2'])){
    $article['image2'] = base64_encode($article['image2']);
	}
	if(!empty($article['image3'])){
	$article['image3'] = base64_encode($article['image3']);
	}
	if(!empty($article['image4'])){
	$article['image4'] = base64_encode($article['image4']);
	}
	if(!empty($article['image5'])){
	$article['image5'] = base64_encode($article['image5']);
	}
	if(!empty($article['image6'])){
	$article['image6'] = base64_encode($article['image6']);
	}
	//JUSQUE LA
    // Convertit en json
    $article_json = json_encode($article);

    header('Content-Type: application/json; charset=UTF-8'); 
    echo $article_json;

?>
