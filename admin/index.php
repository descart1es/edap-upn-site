<?php  

session_start();
require_once('../includes/db.php');
require_once('../includes/function.php');


  is_connected();



?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="../css/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title> Users dashboard</title>

    
    
<body>
<header>
         <div class="container">
            <div class="row">
                
                <div class="col-md-3 col-xs-12">
                    <div class="logo"><img src="image/logo.jpg" alt=""></div>
                </div> 
                
                <nav class="col-md-9 col-xs-12" >
                   
                      <div class="nav-list">
                        <ul class="nav-list" id="open">
                            <li class="list" id="active"><a href="#Acceuil">Acceuil</a></li>
                            <li ><a href="inscription.php">Inscription</a></li>
                            <li ><a href="message.php">Message/a></li>
                            
                           
                            <?php if(isset($_SESSION['auth'])): ?>
                                <li class="list"><a href="#contact">News</a></li>
                                <a href="logout.php"><button class="btn-register" style="position: left;">Déconnexion</button></a>
                            <?php else: ?>
                            <a href="login.php"><button class="btn-register" style="position: left; background:  #067717; "> connexion</button></a>
                        </ul>
                            <a href="formulaire.php"><button  id="btn-register">s'inscrire</button></a>
                         <?php endif; ?>
                       <!--<a href="register.html"><button style="position: left;" id="btn-register">s'inscrire</button></a>-->
                    </div>
                    

                </nav>
               <!--- <div class="icons">
                            
                    <i class="fas fa-user" id="login-btn"></i>
                </div>
            -->

                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                  </div>
            </div>
         </div>
     </header>
     <!---end of header-->
  






    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Liste des utilisateurs du site web</h1>
            
        </div>
          
        <?php 
         include_once "../includes/db.php";
         
         $query= "SELECT * FROM users ORDER BY id ASC";
         $sqlreq= $db->prepare($query);
         $sqlreq->execute();
         $users= $sqlreq->fetchAll();



        
        ?>
        
        <?php   if(isset($_SESSION['flash'])): ?>
                    <?php   foreach($_SESSION['flash'] as $type => $message): ?>
                            <div class="alert alert-<?= $type ?>" >
                            
                               <?= $message ?>
                            </div>
                            <?php endforeach; ?>
    
                     <?php unset($_SESSION['flash']) ?>
                        <?php  endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Date de Confirmation</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                  foreach( $users as $user){
                ?>
               
                    <tr>
                        <td><?php echo $user['id'];  ?></td>
                        <td><?php echo $user['pseudo']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['mdp']; ?></td>
                        <td><?php echo $user['confirmed_at']; ?></td>
                        <td style=" display: flex; flex-direction: row; padding: 5px; margin: 5px;">
                            
                            <form action="delete.php" method="POST">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
              <?php  
              } 
              ?>
            </tbody>
        </table>


      

    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>