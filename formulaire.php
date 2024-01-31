<?php
session_start();
require_once('includes/db.php');

  if(isset($_POST['save'])){
    $nom = $_POST['nom'];
    $postnom = $_POST['postnom'];
    $prenom = $_POST['prenom'];
    $adress = $_POST['adress'];
    $email = $_POST['email'];
    $nomPere =$_POST['nomPere'];
    $nomMere = $_POST['nomMere'];
    $gender =$_POST['gender'];
    $dateNaiss = $_POST['dateNaiss'];
    $lieuNaiss = $_POST['lieuNaiss'];
    $telephone = $_POST['telephone'];
    $phone = $_POST['phone'];
    $classe =$_POST['classe'];
    $section = $_POST['section'];

  

    /* Exécution de la requête */
    $request = $db->prepare("INSERT INTO inscription (nom, postnom, prenom, adress, email,nomPere,nomMere,gender,dateNaiss, lieuNaiss,telephone, phone,classe,section) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $request->execute([
        $_POST['nom'],
        $_POST['postnom'],
        $_POST['prenom'],
        $_POST['adress'],
        $_POST['email'],
        $_POST['nomPere'],
        $_POST['nomMere'],
        $_POST['gender'],
        $_POST['dateNaiss'],
        $_POST['lieuNaiss'],
        $_POST['telephone'],
        $_POST['phone'],
        $_POST['classe'],
        $_POST['section']
    ]);
    header('Location: fiche.php');
    $_SESSION['flash']['sucess']='donnéées enregistrées avec succes';
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
                            <input type="text" class="form-control" name="nom" id="name" placeholder="nom de l'élève">
                        </div>
                        <div class="mb-3">  
                            <label for="">Postnom:</label>        
                            <input type="text" class="form-control" name="postnom"  placeholder="postnom de l'élève" required/>
                    </div>
                        <div class="mb-3">  
                            <label for="">Prenom:</label>                          
                            <input type="text" class="form-control" name="prenom"  placeholder="prenom de l'élève" required/>
                        </div>
                        <div class="mb-3"> 
                            <label for="">Email:</label>                           
                            <input type="email" class="form-control" name="email"  placeholder="votre email" required/>
                        </div>
                        <div class="mb-3">    
                            <label for="">Adresse</label>                        
                            <input type="text" class="form-control" name="adress"  placeholder="votre adresse" required/>
                        </div>
                        <div class="mb-3"> 
                            <label for="">Nom du père</label>                           
                            <input type="text" class="form-control" name="nomPere"  placeholder="inserer le nom du père" required/>
                        </div>
                        <div class="mb-3">
                            <label for="">Nom de la mère</label>                            
                            <input type="text" class="form-control" name="nomMere"  placeholder="inserer le nom de la mère" required/>
                        </div>
                        <label for="email" class="col-form-label ">sexe</label>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="gender" id="homme" value="M" required>
                            <label class="form-check-label" for="homme">
                                M
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="femme" value="F" required>
                            <label class="form-check-label" for="femme">
                                F
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="">votre lieu de naissance</label>
                           <input type="text" name="lieuNaiss" placeholder="Votre lieu de naissance"  class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Date de naissance</label>
                        <input type="date"  name="dateNaiss" placeholder="Votre date de naissance"  class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Télephone</label>
                        <input type="text" name="telephone" placeholder="Votre numéro de Télephone"  class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Numeros Responsable</label>
                        <input type="text" name="phone" placeholder="Télephone du responable à contacter"  class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <label for=""> Classe</label>
                            <select class="form-control" id="classe" name="classe">
                                
                                <option>choisissez la classe</option>
                                <option value="7ème">7ème</option>
                                <option value="8ème">8ème</option>
                                <option value="1ère">1ère</option>
                                <option value="">2ème</option>
                                <option value="3ème">3ème</option>    
                                <option value="4ème">4ème</option>
            
                                
                            </select>
                            </div>
                        <div class="mb-3">
                        <label for="">Section</label>
                            <select class="form-control" id="section" name="section" required>
                                
                                <option>choisir la section</option>
                                <option value="Primaire">Primaire</option>
                                <option value="Commercial">Commercial</option>
                                <option value=">Hotellerie">Hotellerie</option>
                                <option value="Scientifique">Scientifique</option>
                                <option value="Electricité">Electricité</option>
                                <option value="Litteraire">Litteraire</option>
                                <option value="Nutrition">Nutrition</option>
                                
                            </select>
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