<?php
//ici l'idée est que si il oublie son mdp, je vais lui demander son email, et je verifie si il a un compte, si oui,
//je genere un jeton et j'insere ce jeton dans la bdd et la date de réinitialisation, àpres cela je lui envoi
//un message dans sa boite mail acccompagné d'un lien et il va cliquer pour faire l'affaire
session_start();

require_once('../includes/db.php');
require_once('../includes/function.php');
//on verifie si ce n'est pas vide et on lance la requette 

  if(!empty($_POST) && !empty($_POST['email'])){
    
    $query = "SELECT * FROM `admin` WHERE email=? AND confirmed_at IS NOT NULL";
    $req= $db->prepare($query);
    $req->execute([$_POST['email']]);

    //on recupere cela dans la variable admin
    $admin = $req->fetch();
   //ici on continue is_object
    if($admin){
    //On crée un jeton de réinitialisation du mdp qui sera envoyé dans la boite mail de l'utilisateur et qui sera stocké dans la bdd y compris  la date de la reunitialisation
    $reset_token = generateToken(100);
    //ce qui est ci dessus est une fonction que nous avions créer pour generer les jetons que l'on stock dans la nouvelle variable de réinitialisation($reset_token)
    $query= "UPDATE  `admin` SET reset_token = ?, reset_at = NOW() WHERE id=? ";
    $req= $db->prepare($query);
    //execuction de la requette avec les parametres comme le jeton et l'identifiant de l'utilisateur
   
   $req->execute([$reset_token,$admin->id]);
    
    
    //ici on envoi le message dans la boite pour la réinitialisation
 $mail= $_POST['email'];
        //$header = 'content-type: text/pain; charset=UTF-8\r\n';
        $subject= "réinitialisation du  mot de pass"; 
        $message = "Afin de réinitialiser votre votre mot de pass, merci de  cliquer sur ce lien\n\n 
          http://localhost/edap_upn/admin/reset.php?id=$admin->id&token=$reset_token";


         mail($mail,$subject,$message);
           
         $_SESSION['flash']['success'] = "Les instruction du rappel de mot de pass vous ont été envoyée, dans votre boite mail";
         header('Location: login.php');
         exit();
         
         
    }else{
        //si ce n'est pas le cas on l'envoit un message d'erreur
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet email";
        header('Location: remember.php');
        exit();
    }
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/boostwatch.css">
    
    <title>remember</title>
</head>
<body>
    <div class="container">
       <div class="col-md-8 col-md-offset-2">
       <?php  require_once('../includes/errors.php'); ?>  
            <h1 style="color: rgb(8, 56, 119);">Rappel du mot de pass</h1>
                <form action="" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <input type="submit" class="options-btn" value="soumetre">
                    </fieldset>

                </form>
        </div>         
    </div>

</body>
</html>