
<?php

function select_produit($conn){
	$sql="SELECT * FROM `Produit`";
	$result=mysqli_query($conn, $sql);
	$transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
	$ret = json_encode($transformation);
	return $ret;
}

function select_enceinte($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=1";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_ordi($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=2";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_tablette($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=3";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_tv($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=4";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_phone($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=5";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_peripherique($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=6";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function select_ecran($conn){
    $sql="SELECT * FROM `Produit` WHERE `num_cat`=7";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result, MYSQLI_ASSOC);
    $ret = json_encode($transformation);
    return $ret;
}

function liste_produit($conn){
	$sql="SELECT * FROM `Produit`"; 
	$result=mysqli_query($conn, $sql);

	$list = rs_to_tab_art($result);

	return $list;
}

// print_r(liste_produit($conn));

function liste_produit_id($conn, $id){
	$sql="SELECT * FROM `Produit` WHERE `id`=$id"; 
	$result=mysqli_query($conn, $sql);

	$list = rs_to_tab_art($result);

	return $list;
}

function select_1_produit($conn,$id){
	$sql="SELECT * FROM `Produit` WHERE `id`=$id";

	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
	
}

function select_1_produit_json($conn,$id){
    $sql="SELECT * FROM `Produit` WHERE `id`=$id";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result);
    $ret = json_encode($transformation);
    return $ret ;
    
}


function rs_to_tab_art($rs){
	$tab=[] ; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row ;
		
	}
	return $tab;
}

function create_article($conn,$titre, $description, $prix, $image, $num_cat){

	$sql = "INSERT INTO `Produit`(`titre`, `description`, `prix`, `image`, `num_cat`) VALUES ('$titre', '$description', '$prix', '$image', '$num_cat')";
	$result = mysqli_query($conn, $sql);

	$transformation = mysqli_fetch_assoc($result);
	$ret = json_encode($transformation);

	return $ret;

}

function create_article_admin($conn,$titre, $description, $prix, $image, $num_cat){

	$sql = "INSERT INTO `Produit`(`titre`, `description`, `prix`, `image`,`image2`,`image3`,`image4`,`image5`,`image6`,`num_cat`) VALUES ('$titre', '$description', '$prix', '$image','','','','','','$num_cat')";
	$result = mysqli_query($conn, $sql);
   

	return $result;

}


function update_article($conn, $id, $titre, $description, $prix, $image, $num_cat){
    $sql="UPDATE `Produit` set `titre`='$titre', `description`='$description', `prix`='$prix', `image`='$image',`num_cat`='$num_cat' WHERE `id`=$id";
	$result=mysqli_query($conn, $sql);
	$transformation = mysqli_fetch_assoc($result);
	$ret = json_encode($transformation);
    return $ret; 
}

function update_prix($conn, $id, $prix){
    $sql="UPDATE `Produit` set `prix`='$prix' WHERE `id`=$id";
    $result=mysqli_query($conn, $sql);
    $transformation = mysqli_fetch_assoc($result);
    $ret = json_encode($transformation);
    return $ret; 
}

function update_article_admin($conn, $id, $titre, $description, $prix, $image, $num_cat){
    $sql="UPDATE `Produit` set `titre`='$titre', `description`='$description', `prix`='$prix', `image`='$image',`num_cat`='$num_cat' WHERE `id`=$id";
	$result=mysqli_query($conn, $sql);
	
    return $result ; 
}






function delete_article($conn, $id){
    $sql="DELETE FROM `Produit` WHERE `id`=$id" ;
	$result=mysqli_query($conn, $sql);

	$transformation = mysqli_fetch_assoc($result);
	$ret = json_encode($transformation);
	return $ret;
}


?>