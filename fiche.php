<?php
  
     require_once('includes/db.php');
    
     /*
     $request= ("SELECT * FROM ` inscription` where id = :id"  );
     $req= $db->prepare($request);
     $req->execute([$_POST['id']]);
     $insciption-> $request->fetchAll();
    
    */


    if(!empty($_POST) && !empty($_POST['id'])){

        session_start();
        
        $query = "SELECT * FROM inscription ";
        $req= $db->prepare($query);
        $req->execute();
        $insciption-> $request->fetch();
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/allery.css">
    <link rel="stylesheet" href="css/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    
    <title>Formumaire</title>

    <style>
  .wrapper {
    max-width: 500px;
    margin: 40px auto;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, .1);
}
.titre h1{
    background-color: rgb(8, 56, 119);
    color: #fff;
    border-radius: 2px;
}
@media(max-width: 570px){
    .wrapper {
    max-width: 420px;
    margin: 40px auto;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, .1);
}
}



</style>
</head>
<body>

    <div >
    
        <div class="container wrapper" >
        <?php   if(isset($_SESSION['flash'])): ?>
                <?php   foreach($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?= $type ?>" >
                           <?= $message ?>
                        </div>
                        <?php endforeach; ?>

                 <?php unset($_SESSION['flash']) ?>
                    <?php  endif; ?>
            <div >
                <div class="titre">
                    
                <h1 >Demander votre inscription en remplissant ce formulaire</h1>
                    
                    
                </div>
                
                <div>
                    <form action="" method="POST">
                        <div class="mb-3">
                             <label for="">Nom:</label>
                             <p><?php echo $insciption['nom']; ?></p>
                        </div>
                        <div class="mb-3">  
                            <label for="">Postnom:</label>        
                            <p><?= $_POST['postnom'];?></p>
                    </div>
                        <div class="mb-3">  
                            <label for="">Prenom:</label>                          
                            <p><?= $_POST['prenom'];?></p>
                        </div>
                        <div class="mb-3"> 
                            <label for="">Email:</label>                           
                            <p><?= $_POST['email'];?></p>
                        </div>
                        <div class="mb-3">    
                            <label for="">Adresse</label>                        
                            <p><?= $_POST['adress'];?></p>
                        </div>
                        <div class="mb-3"> 
                            <label for="">Nom du père</label>                           
                            <p><?= $_POST['nomPere'];?></p>
                        </div>
                        <div class="mb-3">
                            <label for="">Nom de la mère</label>                            
                            <p><?= $_POST['nomMere'];?></p>
                        </div>
                        <label for="email" class="col-form-label ">sexe</label>
                        <div class="form-check ">
                        <label class="form-check-label" for="homme">
                                Sexe
                            </label>
                        <p><?= $_POST['gender'];?></p>
                            
                        </div>
                       
                        <div class="mb-3">
                            <label for="">votre lieu de naissance</label>
                            <p><?= $_POST['lieuNaiss']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label for="">Date de naissance</label>
                            <p><?= $_POST['dateNaiss'];?></p>
                        </div>
                        <div class="mb-3">
                            <label for="">Télephone</label>
                            <p><?= $_POST['telephone'];?></p>
                        <div class="mb-3">
                            <label for="">Numeros Responsable</label>
                            <p><?= $_POST['phone'];?></p>
                        </div>
                        <div class="mb-3">
                        <label for=""> Classe</label>
                        <p><?= $_POST['class']; ?></p>
                            </div>
                        <div class="mb-3">
                        <label for="">Section</label>
                        <p><?= $_POST['section'];?></p>
                            </div>

                        <div class="mb-3 ">
                            <input type="submit" class="btn-block" value="s'inscrire" name="save">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>

</html>