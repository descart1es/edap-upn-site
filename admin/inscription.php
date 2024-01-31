



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
    <title> inscription dashboard</title>
   
    
    
<body>
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Liste des Inscrits au sein du systeme</h1>
            
        </div>
          
        <?php 
         include_once "../includes/db.php";
         $query= "SELECT * FROM `inscription` ORDER BY id ASC";
         $sqlreq= $db->prepare($query);
         $sqlreq->execute();
         $inscrits= $sqlreq->fetchAll();

        
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
                    <th scope="col">Nom</th>
                    <th scope="col">Postnom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nom de la mère</th>
                    <th scope="col">Nom du Père</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Date de Naissance</th>
                    <th scope="col">Lieu de Naissance</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Section</th>
                    
                    
                </tr>
            </thead>

            <tbody>
                <?php
                  foreach($inscrits as $inscrit)
                  {
                ?>
               
                    <tr>
                        <td><?php echo $inscrit['id'];  ?></td>
                        <td><?php echo $inscrit['nom']; ?></td>
                        <td><?php echo $inscrit['postnom']; ?></td>
                        <td><?php echo $inscrit['prenom']; ?></td>
                        <td><?php echo $inscrit['adress']; ?></td>
                        <td><?php echo $inscrit['email']; ?></td>
                        <td><?php echo $inscrit['nomPere']; ?></td>
                        <td><?php echo $inscrit['nomMere']; ?></td>
                        <td><?php echo $inscrit['gender']; ?></td>
                        <td><?php echo $inscrit['dateNaiss']; ?></td>
                        <td><?php echo $inscrit['lieuNaiss']; ?></td>
                        <td><?php echo $inscrit['telephone']; ?></td>
                        <td><?php echo $inscrit['phone']; ?></td>
                        <td><?php echo $inscrit['classe']; ?></td>
                        <td><?php echo $inscrit['section']; ?></td>
                        <td style=" display: flex; flex-direction: row; padding: 5px; margin: 5px;">
                            
                            <form action="delins.php" method="POST">
                                <input type="hidden" name="id" value="<?= $inscrit['id']; ?>">
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