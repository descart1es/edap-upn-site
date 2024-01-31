<?php 
session_start();
require_once('./includes/db.php');
require_once('./includes/function.php');



if(!empty($_POST)){
    $errors= [];

    //ici on gere les erreurs pour le champs pseudo
    if(empty($_POST['pseudo']) || !preg_match("#^[a-zA-z0-9_]+$#", $_POST['pseudo'])){
        $errors['pseudo']= 'Votre pseudo n\'est pas  valide';
        var_dump($errors['pseudo']);
    }else{
        // ici nous ne voulons pas à ce que deux pseudo du meme type soit soumis
       $query = "SELECT * FROM users WHERE pseudo = ?";
       $sql= $db->prepare($query);
       $sql->execute([$_POST['pseudo']]);

       if($sql->fetch()){
           $errors['pseudo'] = 'ce pseudo est déjà pris';
       }

    }
     //ici on gere les erreurs pour le champs email
     if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']= 'Votre email n\'est pas  valide';
        var_dump($errors['email']);
    }else{

           // ici nous ne voulons pas à ce que deux email du meme type soit soumis
       $query = "SELECT * FROM users WHERE email = ?";
       $sql= $db->prepare($query);
       $sql->execute([$_POST['email']]);

       if($sql->fetch()){
           $errors['email'] = 'ce email est déjà pris';
       }
    }

     //ici on gere les erreurs pour le champs password
     if(empty($_POST['mdp']) || $_POST['mdp'] !== $_POST['mdp_confirm']){
        $errors['mdp']= 'Vous devez rentrez un mot de pass valide et confirmé ';
        
    }

       if(empty($errors)){
        $query= ("INSERT INTO users (pseudo,email,mdp,confirmation_token) VALUES (?,?,?,?) ");
        $sql = $db->prepare($query);
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

       $token = generateToken(100); 
       
       $sql->execute([$_POST['pseudo'], $_POST['email'], $mdp, $token]);
       $userId = $db->lastInsertId();
    
       $mail= $_POST['email'];
       $subject= "Confirmation compte";
       $message = "Afin de confirmer votre compte, cliquez sur ce lien\n\n 
         http://localhost/edap_upn/confirm.php?id=$userId&token=$token";


         mail($mail,$subject,$message);

         $_SESSION['flash']['success'] = "Félicitation Votre Compte été Créez avec succès.veuillez verifier votre boite mail";
         
         header('Location: login.php');
         exit();
       }

      

    }
    




?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/allery.css">
    <link rel="stylesheet" href="font-awesome/fonts/bootstrap-icons.woff2">
    <title>Inscription</title>
</head>
<body>
    <div class="container"><br><br><br>
        <div class="message row m-0-auto mt-20">
                    
            <div class="contact col-md-6">
            <?php  require_once('includes/errors.php'); ?>  
                        
                    
                <h2 class="m-0-auto"> Créer un compte</h2>
                <form method="post" action="" >
                  
                

                    <div class="form-group mt-20">
                        <input type="text" class="form-control" name="pseudo"  id="name" aria-describedby="emailHelp" placeholder="votre pseudo" autocomplete="off">
                    </div>
                    <div class="form-group mt-20">
                        <input type="email" class="form-control" name="email" placeholder="votre email" autocomplete="off">
                    </div>
                    <div class="form-group mt-20">
                        <input type="password" class="form-control" name="mdp" placeholder="mot de pass" autocomplete="off">
                    </div>
                    <div class="form-group mt-20">
                        <input type="password" class="form-control" name="mdp_confirm" placeholder="Confirmer le mot de pass" autocomplete="off">
                    </div>
                   
                    
                    
                    
                    <input type="submit" class="btn-block" name="submit" value="valider">
                    
                    
                    
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>