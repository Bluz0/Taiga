<?php
include "../db/db_connect.php"; 
include "../crud/requete.crud.php"; 
?>  

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
    <link rel="icon" type="image/png" href="../images/main/favicon-logo.png">
    <link rel="stylesheet" href="../css/style.css">
	
	
</head>

<header>
        <a href="../index.php" class="Logo"><img id="logoo" src="../images/main/logo_taiga.png"></a>

        <div class="group">
            <ul class="navigation">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../index.php#cat-cat">Categories</a></li>
                <li><a href="faq.php">A propos</a></li> 
                <li><a href="#">Contact</a></li> 
                <li><a href="account-connexion.php"><img height="30px" width="30px" id="account-img" src="../images/main/la-personne.png"></a></li>
                <li><a href="cart.php"><img height="30px" width="30px" id="cart-img" src="../images/main/carte.png"></a></li>
            </ul>
        </div>
    </header>

<body>
<div id=div_form_contact>
<form action="form_contact.php" method="POST" id=form_contact>
<div id=email_contact>
<div id=label_email><label for="email">Votre Email</label></div>
<div><input type="text" name="email" required="required" ></div>
</div>


<div id=objet_contact>
<div id=label_objet><label for="objet">L'objet de votre demande</label></div>
<div><input type="text" name="objet" maxlength="50" required="required"></div>
</div>

<div id=message_contact>
<div id=label_msg><label for="message">Votre Message</label></div>
<div><textarea rows='10' cols='45' maxlength="500" name='message' wrap='soft' ></textarea></div>
</div>

<div id=action_conctact>
<input type="submit" name="submit" value="Envoyer"  id=envoie_contact>
<input type="reset" name="reset" value="Effacer"  id=reset_contact>
</div>
</form>
<div id="msg_conf"></div>
</div>


<footer class='div_footer'><?php include "footer.php" ?></footer>

</body>

<?php


if(isset($_POST["email"])){
    
    $email=$_POST["email"];
    $objet=$_POST["objet"];
    $message=$_POST["message"];

 
    $html="<script>
    var elt=document.getElementById('msg_conf');
    var p= text = document.createTextNode('Votre message a été transmis. Une réponse à votre demande sera envoyée à votre adresse email.');

    elt.appendChild(p);
    </script>";
    echo($html);
    

    insert_requete($conn,$email,$objet,$message);
}
?>








</html>

