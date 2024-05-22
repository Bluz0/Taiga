
<?php

function select_paiement($conn){
    $sql="SELECT * FROM `Commande`";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function select_paiement_user($conn, $id_usr){
    $sql="SELECT * FROM `Commande` WHERE `id_usr`='$id_usr'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function insert_paiement($conn, $id_user, $num_commande, $montant){
    $sql="INSERT INTO `Commande`(`id_user`, `num_commande`, `total_prix`) VALUES ('$id_user', '$num_commande', '$montant')";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function update_paiement($conn, $id_user, $num_commande, $montant){
    $sql="UPDATE `Commande` SET `total_prix`='$montant' WHERE `id_user`='$id_user' AND `num_commande`='$num_commande'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function delete_paiement($conn, $id_user, $num_commande){
    $sql="DELETE FROM `Commande` WHERE `id_user`='$id_user' AND `num_commande`='$num_commande'";
    $result=mysqli_query($conn, $sql);
    return $result;
}

function rs_to_tab_pay($rs){
    $tab=[] ; 
    while($row=mysqli_fetch_assoc($rs)){
        $tab[]=$row ;
        
    }
    return $tab;
}

function liste_paiement($conn){
    $sql="SELECT * FROM `Commande`"; 
    $result=mysqli_query($conn, $sql);

    $list = rs_to_tab_pay($result);

    return $list;
}

function liste_paiement_user($conn, $id_usr){
    $sql="SELECT * FROM `Commande` WHERE `id_usr`='$id_usr'"; 
    $result=mysqli_query($conn, $sql);

    $list = rs_to_tab_pay($result);

    return $list;
}




?>