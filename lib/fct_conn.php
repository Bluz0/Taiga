<?php



function est_connecte($conn,$login,$mdp){
    
    $sql_login="SELECT `email` FROM `Utilisateur` WHERE `email`='$login'";
    $sql_mdp="SELECT `Mdp` FROM `Utilisateur` WHERE `email`='$login'";
    $sql_privilege="SELECT `privilege` FROM `Utilisateur` WHERE `email`='$login'";
    
	$res_login=mysqli_query($conn, $sql_login); 
	$res_mdp=mysqli_fetch_assoc(mysqli_query($conn, $sql_mdp));
    $res_privilege=mysqli_fetch_assoc(mysqli_query($conn, $sql_privilege));
    
    $res_privilege=$res_privilege["privilege"];
    $res_mdp=$res_mdp["Mdp"];
   
    
    
    
    
    if (mysqli_num_rows($res_login) >0 && password_verify($mdp,$res_mdp)==True){
        if($res_privilege == "admin"){
            $res ="admin";

        }
        else if ($res_privilege == "user"){
            $res="user";
        }
        
        
        
    }
    
    else{$res=false;}
    
    
    return $res;




}


?>
