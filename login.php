
<?php
    
    session_start();
    require_once('includes/db.php');
    require_once('includes/function.php');
    
    reconnect_auto();
    
    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
        $mdp = password_hash($_POST['mdp'],PASSWORD_BCRYPT);
        
        $query = "SELECT * FROM users WHERE (pseudo = :pseudo OR email = :pseudo) AND confirmed_at is NOT NULL";
        $req = $db->prepare($query);
        $req->execute(['pseudo' => $_POST['pseudo']]);
        $user = $req->fetch();
        
    
        if($user && Password_verify($_POST['mdp'], $user->mdp)){
           // echo ("<script language='javascript'> alert('Vous etes connecté!')</script>");
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = "Vous etes connecté avec succes!";
            
           
            if(isset($_POST['remember'])){
                $remember_token= generateToken(100);
                $query = "UPDATE users SET remember_token=? WHERE id = ?";
                $req= $db->prepare($query);
                $req->execute([$remember_token, $user->id]);

                setcookie("remember",$user->id . "::" .$remember_token. sha1($user->id ."Username"),time()+ 60 * 60 * 24 * 7);
            }
            
            header('Location: index.php');
            exit();
          
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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/login.css">
        
        <title>login page</title>
    </head>
    <body>
        <!--  ICI NOTRE LOGIN-FORM-->
        <div class="container"><br><br><br>
       
        <div class="message row m-0-auto mt-20">
                    
            <div class="contact col-md-6">
              <?php require_once "includes/errors.php"; ?>
    
                <h2 class="m-0-auto"> Se connecter </h2>
                <p>Connectez-vous à notre site pour voir les Informations internes de l'edap</p>
                <form method="post">
                    <div class="form-group mt-20">
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="pseudo" placeholder="votre nom ou email" autocomplete="off">
                    </div>
                    <div class="form-group mt-20">
                        <input type="tel" class="form-control" name="mdp" placeholder="mot de pass" autocomplete="off">
                    </div>
                    
                    <label for="remember">se souvenir de moi</label>
                    <input type="checkbox" name="remember" id="remember" >
                   
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