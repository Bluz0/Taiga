
<?php

function select_panier($conn){
    $sql="SELECT * FROM `Panier_article`";
    $result=mysqli_query($conn, $sql);
    return $result;
}


function select_panier_user($conn, $id_usr){
    $sql="SELECT * FROM `Panier_article` WHERE `id_usr`='$id_usr'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function insert_panier($conn, $id_usr, $article, $qte){
    $sql="INSERT INTO `Panier_article`(`id_usr`, `article`, `qte`) VALUES ('$id_usr', '$article', '$qte')";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function update_panier($conn, $id_usr, $article, $qte){
    $sql="UPDATE `Panier_article` SET `qte`='$qte' WHERE `id_usr`='$id_usr' AND `article`='$article'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function delete_panier($conn, $id_usr, $article){
    $sql="DELETE FROM `Panier_article` WHERE `id_usr`='$id_usr' AND `article`='$article'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function rs_to_tab($rs){
	$tab=[] ; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row ;
		
	}
	return $tab;
}

function liste_panier($conn){
	$sql="SELECT * FROM `Panier_article`"; 
	$result=mysqli_query($conn, $sql);

	$list = rs_to_tab($result);

	return $list;
}

function liste_panier_user($conn, $id_usr){
	$sql="SELECT * FROM `Panier_article` WHERE `id_usr`='$id_usr'"; 
	$result=mysqli_query($conn, $sql);

	$list = rs_to_tab($result);

	return $list;
}

// FAIRE EN JSON POUR AFFICHER DANS CART.PHP

function select_panier_user_json($conn, $id_usr){
    $sql="SELECT * FROM `Panier_article` WHERE `id_usr`='$id_usr'";
    $result=mysqli_query($conn, $sql);
    $tab = rs_to_tab($result);
    
    return json_encode($tab);
}

function liste_panier_user_json($conn, $id_usr){
    $sql="SELECT * FROM `Panier_article` WHERE `id_usr`='$id_usr'"; 
    $result=mysqli_query($conn, $sql);

    $list = rs_to_tab($result);

    return json_encode($list);
}


?>