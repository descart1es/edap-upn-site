

<?php 
 session_start();
include_once "../includes/db.php";
include_once "../includes/function.php";

is_connected();








?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="../css/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title> Messages dashboard</title>
   
    
    
<body>
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between">
            <h1>Liste Messages envoyés par les visiteurs du site web</h1>
            
        </div>
          
        <?php 
         include_once "../includes/db.php";
         $query= "SELECT * FROM `message` ORDER BY id ASC";
         $sqlreq= $db->prepare($query);
         $sqlreq->execute();
         $messages= $sqlreq->fetchAll();

        
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
                    <th scope="col">message</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
               
                  foreach( $messages as $message){
                ?>
               
                    <tr>
                        <td><?php echo $message['id'];  ?></td>
                        <td><?php echo $message['pseudo']; ?></td>
                        <td><?php echo $message['email']; ?></td>
                        <td><?php echo $message['message']; ?></td>
                        <td style=" display: flex; flex-direction: row; padding: 5px; margin: 5px;">
                            
                            <form action="delmess.php" method="POST">
                                <input type="hidden" name="id" value="<?= $message['id']; ?>">
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