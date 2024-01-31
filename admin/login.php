
<?php
    
    session_start();
    require_once('../includes/db.php');
    require_once('../includes/function.php');
    
    //reconnect_auto();
    
    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
        $mdp = password_hash($_POST['mdp'],PASSWORD_BCRYPT);
        
        $query = "SELECT * FROM `admin` WHERE (pseudo = :pseudo OR email = :pseudo) AND confirmed_at is NOT NULL";
        $req = $db->prepare($query);
        $req->execute(['pseudo' => $_POST['pseudo']]);
        $admin = $req->fetch();
        
    
        if($admin && Password_verify($_POST['mdp'], $admin->mdp)){
           // echo ("<script language='javascript'> alert('Vous etes connecté!')</script>");
            $_SESSION['auth'] = $admin;
            $_SESSION['flash']['success'] = "Vous etes connecté avec succes!";
            
           
          
        }else{
            $_SESSION['flash']['danger'] = "Identifiant ou mot de pass incorrecte!";
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
        
        <title>login page</title>
    </head>
    <body>
        <!--  ICI NOTRE LOGIN-FORM-->
        <div class="container"><br><br><br>
       
        <div class="message row m-0-auto mt-20">
                    
            <div class="contact col-md-6">
              <?php require_once "../includes/errors.php"; ?>
    
                <h2 class="m-0-auto"> Se connecter </h2>
                <p>Connectez-vous à notre site pour voir les Informations internes de l'edap</p>
                <form method="post">
                    <div class="form-group mt-20">
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="pseudo" placeholder="votre nom ou email" autocomplete="off">
                    </div>
                    <div class="form-group mt-20">
                        <input type="tel" class="form-control" name="mdp" placeholder="mot de pass" autocomplete="off">
                    </div>
                    
                    
                   
                    <p>mot de pass oublié?<a href="remember.php">Cliquer ici</a></p> 
                  
    
                        
                    <p>Vous n'avez pas de compte?<a href="register.php">créer un compte</a></p> 
                    <button type="submit" class="btn-block" name="connected">connexion</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </body>
    </html>