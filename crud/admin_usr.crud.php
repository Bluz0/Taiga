<?php
/*---------------------------------------
CRUD: Gestion de l'entité Utilisateur
---------------------------------------*/


/*
	CR: créé un nouvel enregistrement  
	suppose un id auto-incrementé
*/
$debeug=False ; 
function insert_user($conn,$nom, $prenom, $email,$adresse,$Mdp,$privilege){
    
    
    $sql="INSERT INTO `Utilisateur`(`nom_usr`, `prenom_usr`, `email`, `adresse`, `Mdp`, `privilege`) VALUES ('$nom', '$prenom', '$email','$adresse','$Mdp','$privilege')";
	global $debeug ;
	if($debeug) echo $sql ; 
	$res=mysqli_query($conn, $sql) ; 
	return $res ; 
}



/*
	U: met à jour les valeurs de l'enregistrement 
*/

function update_user($conn, $id, $nom, $prenom, $email,$adresse,$Mdp,$privilege){
	$sql="UPDATE `Utilisateur` SET `nom_usr`= '$nom', `prenom_usr`= '$prenom',`email`= '$email',`adresse`= '$adresse',`Mdp`= '$Mdp',`privilege`= '$privilege' WHERE `id`=$id" ;
	global $debeug;
	
	if($debeug) echo $sql ; 
	$ret=mysqli_query($conn, $sql) ;
        return $ret ; 
}

function update_user_account($conn, $id, $nom, $prenom, $email,$adresse,$Mdp){
	$sql="UPDATE `Utilisateur` SET `nom_usr`= '$nom', `prenom_usr`= '$prenom',`email`= '$email',`adresse`= '$adresse',`Mdp`= '$Mdp' WHERE `id`=$id" ;
	global $debeug;
	
	if($debeug) echo $sql ; 
	$ret=mysqli_query($conn, $sql) ;
        return $ret ; 
}




/*
	D: supprime l'enregistrement 
*/
function delete_user($conn, $id){
	$sql="DELETE FROM `Utilisateur` WHERE `id`=$id" ;
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 
}

function delete_user_email($conn, $email){
	$sql="DELETE FROM `Utilisateur` WHERE `email`='$email'" ;
	$ret=mysqli_query($conn, $sql) ;
	return $ret ; 
}




/*
	S: selectionne un user
*/
function select_user($conn, $id){
	$sql="SELECT * FROM `Utilisateur` WHERE `id`=$id" ;
	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
}

function select_user_email($conn, $email){
	$sql="SELECT * FROM `Utilisateur` WHERE `email`='$email'" ;
	if($ret=mysqli_query($conn, $sql)){
		$ret=mysqli_fetch_assoc($ret);
	}
	return $ret ;
}




function list_user($conn){
	$sql="SELECT * FROM `Utilisateur`"; 
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
