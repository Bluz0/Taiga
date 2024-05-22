<?php
/*---------------------------------------
CRUD: Gestion de l'entité Requete
---------------------------------------*/


/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
$debeug=False ; 
function insert_requete($conn,$email, $objet, $message){
    
    
    $sql="INSERT INTO `Requete`(`email`, `objet`, `message`) VALUES ('$email', '$objet', '$message')";
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}



/*
	U: met à jour les valeurs de l'enregistrement 
*/

function update_requete($conn,$email, $objet, $message){
	$sql="UPDATE `Requete` SET `email`= '$email', `objet`= '$objet',`message`= '$message' WHERE `id`=$id" ;
	global $debeug;
	
	if($debeug) echo $sql ; 
	$ret=mysqli_query($conn, $sql) ;
        return $ret ; 
}





/*
	D: supprime l'enregistrement 
*/
function delete_requete($conn, $id){
	$sql="DELETE FROM `Requete` WHERE `id`=$id" ;
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 
}





/*
	S: selectionne une requete
*/
function select_requete($conn, $id){
	$sql="SELECT * FROM `Requete` WHERE `id`=$id" ;
	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
}




function list_requete($conn){
	$sql="SELECT * FROM `Requete`"; 
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return rs_to_tab($res) ;
}

/**
 * Fonction auxiliaire pour transformer un rs en tableau
 */
function rs_to_tab($rs){
	$tab=[] ; 
	while($row=mysqli_fetch_assoc($rs)){
		$tab[]=$row ;	
	}
	return $tab;
}


?>