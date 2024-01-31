<?php 
session_start();
require_once('includes/db.php');

if(isset($_GET['id']) && isset($_GET['token'])){
    $userId= $_GET['id'];
    $token= $_GET['token'];

$query= "SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND confirmed_at IS NOT NULL";
$req=$db->prepare($query);
$req->execute([$userId, $token]);
$user = $req->fetch();

if($user){
    if(!empty($_POST)){
        
            if(!empty($_POST['mdp']) && $_POST['mdp'] == $_POST['mdp_confirm']){
                $mdp = password_hash($_POST['mdp'],PASSWORD_BCRYPT);
             $query= " UPDATE  users SET mdp = ?, reset_token = NULL, reset_at = NULL WHERE id = ? ";
            
            //$db->prepare($query)->execute;
             $db->prepare($query)->execute([$mdp,$userId]);
             
           
             //echo "<script> alert('Votre compte a bien été réinitialisé') </script>";
            $_SESSION['flash']['success'] = "Votre compte a bien été réinitialisé";
            //$_SESSION['auth'] = $user;
            header("Location: index.php");
            exit();
           
        }else{
            $_SESSION['flash']['danger'] = "Les deux mot de pass ne se correspondent pas!";
            
        }
        
    }
    //
    //execution de la requette;

 }else{
    $_SESSION['flash']['danger'] = "Ce jeton n'existe pas";
    header("Location: login.php");
    exit();
 }


}else{
    header("Location: login.php");
    exit();
}







?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
    
    <title> Reset</title>
</head>
<body>
    <!--  ICI NOTRE LOGIN-FORM-->
    <div class="container"><br><br><br>
   
    <div class="message row m-0-auto mt-20">
                
        <div class="contact col-md-6">
        <?php   if(isset($_SESSION['flash'])): ?>
                <?php   foreach($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?= $type ?>" >
                           <?= $message ?>
                        </div>
                        <?php endforeach; ?>

                 <?php unset($_SESSION['flash']) ?>
                    <?php  endif; ?>

            <h1 class="m-0-auto">Réinitialisez votre mot de pass</h1>
       
            <form method="post">
                <div class="form-group mt-20">
                    <input type="password" class="form-control" name="mdp" placeholder="Nouveau mot de pass">
                </div>
                <div class="form-group mt-20">
                    <input type="password" class="form-control" name="mdp_confirm" placeholder="Confirmez le Nouveau mot de pass">
                </div>
                
                
                
                <button type="submit" class="btn-block">Réinitialisez le mot de pass</button>
                
                
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>