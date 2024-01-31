<?php

session_start();
   require_once('includes/db.php');
   require_once('includes/function.php');
   //require_once('logout.php');

   //is_connected();
  reconnect_auto();

 

if(!empty($_POST)){
    $errors=[];
  
    if(empty($_POST['pseudo'])){
       
        echo $errors['message'] = "<script>alert (\'Veillez remplir correctement votre nom')</script>";
        //var_dump($errors['pseudo']);
        //
        //
        //var_dump($errors['email'], $errors['telephone'], $errors['message']);
    }
    if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        
        echo $errors['message'] = "<script>alert (\'Votre email n\'est pas  valide')</script>";
       // var_dump($errors['email']);      
    //]);
       
    }
    if(empty($_POST['message'])){
        echo $errors['message'] = "<script>alert (\'ecriver votre message')</script>";
        //var_dump($errors['message']);
        
    }

    if(empty($errors)){
        $query= ('INSERT INTO `message`(pseudo,email,message) values(?,?,?)');
        $req= $db->prepare($query);
        $req->execute([$_POST['pseudo'],$_POST['email'],$_POST['message']]);
         
       
        $to = $_POST['email'];
        $from = 'admin@wampserver.invalid';
        $subject = 'Vous avez un nouveau message';
        $message ="<html><body>";
        $message .= "<h1> Bonjour Monsieur<h1>";
        $message .= $_POST['message'];
        $message="</body></html>";
        $headers= "Content-type; text/html; charset='UTF-8'\r\n";
        

      if(mail($to,$from,$message,$headers)){
        $_SESSION['flash']['success'] = "Votre message a été envoyé";
      }else{
        echo  "<script>alert (' votre message n\'a pas été envoyé')</script>";
      }
    }
    
 
}


?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Edap-Upn" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Ceci est mon premier projet front-end pour la pre-inscription en ligne" />
    <meta property="og:url" content="https://descart1es.github.io/edap-upn-site/" />
    <meta property="og:image" content="image/logo.png"/>
   

    <link href="image/edapLogo.jpeg" rel="icon">
    
    
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

   

    
    
    

   
    <title>edap_upn</title>
</head>
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
                            <li class="list"><a href="#Apropos">A propos</a></li>
                            <li class="list"><a href="#option">Sections</a></li>
                            <li class="list"><a href="#gallery">Gallery</a></li>
                            <li class="list"><a href="#contact">contact</a></li>
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





   

     <section class="section-home text-center" id="Acceuil">
        <div class="overlay">
            <div class="container">
             <div class="home-content">
                <h1 class="home-title">Ecole d'Application de l'Upn</h1>
                <p class="home-desc">
                   Assurer une bonne formation pour vos enfants. 
                </p>
                <a href="formulaire.php"><button class="btn button">S'inscrire</button></a>
                <a href="about.php"><button class="bttn button">Apropos</button></a>
             </div>
          </div> 
        </div>
     </section>
     

      <!--- Fin de la partie Acceuil/ landing page-->
    <section class="about" id="Apropos">
         <div class="container">
              <div class="section-header text-center ">
                <h2 class="section-title">Apropos de nous</h2>
                <div class="line"><span></span></div>
               
              </div><br>
              <div class="row">
                <div class="col-md-6">
                   <div class="about-info">
                     <!--<h3>Breve Historique de <span> l'édap</span> Upn</h3>-->
                     <div class="abut-info-desc">
                         <p>
                            L’Ecole d’Application de l’Université Pédagogique Nationale a été 
                            créée par les parents de la province du kongo central en 1961, sous l’appellation 
                            de l’Athénée du cycle d’orientation Pumbu. Puis devenue plus tard Athénée du 
                            Kongo central. Il n’était organisé que l’enseignement secondaire.
                                                    </p>
                            <p>
                                Par manque de bâtiments, l’école a fonctionné pendant quelques 
                                années dans la résidence d’un colon belge au croisement des avenues Bobozo et 
                                route de Matadi.

                            </p>
                       <a href="about.php"><button class="options-btn"> Lire plus</button></a>
                     </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img">
                        <img src="image/image edap.jpg" alt="">
                    </div>
                </div>
          </div>
         </div>

     
    </section>
   <!--- Fin de la partie A propos-->
    <section class="options" id="option">
        <div class="container">
              <div class="section-header text-center ">
                <h2 class="section-title">Nos Sections</h2>
                <div class="line"><span></span></div>
                <p>Edap Upn est une grande école qui organise les sections ci-dessous</p>
              </div>

            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                        <div class="iconb">
                        <i class="icon ion-ios-cart fa-lg"></i>
                    </div>
                        <h3 class="serv-title">Commercial</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                        <div class="iconb"><i class="icon ion-earth fa-lg"></i></div>
                        <h3 class="serv-title">Hotellerie</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                       <div class="iconb"><i class="ion-ios-nutrition fa-lg"></i></div> 
                        <h3 class="serv-title">Nutrition</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>


            </div>
        
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                    <div class="iconb"><i class="icon ion-university fa-lg"></i></div>
                        <h3 class="serv-title">Scientifique</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                        <div class="iconb"><i class="icon ion-ios-book fa-lg"></i></div>
                        <h3 class="serv-title">Litteraire</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="serv">
                        <div class="iconb"><i class="icon ion-ios-lightbulb"></i></div>
                        <h3 class="serv-title">Electricité Génerale</h3>
                        <p class="serv-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam enim voluptate  . </p>
                    </div>
                </div>


            </div>
            <a href="sect.php"><button class="options-btn"> Lire plus</button></a>
        </div>
        
    </section>
    
     
  <!--- Fin de la partie sections/Options-->







   <div class="section-gallery" id="gallery">
   <div class="container">
    <div class="section-header text-center ">
        <h2 class="section-title">Nos photos</h2>
        <div class="line"><span></span></div>
        <p>Apreciez l'environnement de l'école edap	Upn et cliquez pour voir les images en couleure</p>
      </div>
      
        
        <div class="gallery">
            <a href="image/edap1.jpeg" data-lightbox="mygallery"><img src="image/edap1.jpeg" alt="cliquez pour bien voir l'image"></a>
            <a href="image/edap2.jpg" data-lightbox="mygallery"><img src="image/edap2.jpg" alt=""></a>
            <a href="image/edap3.jpg" data-lightbox="mygallery"><img src="image/edap3.jpg" alt=""></a><br><br>
            <a href="image/edap2.jpg" data-lightbox="mygallery"><img src="image/edap1.jpeg" alt=""></a>
            <a href="image/edapLogo.jpeg" data-lightbox="mygallery"><img src="image/edapLogo.jpeg" alt=""></a>
            <a href="image/edap.jpg" data-lightbox="mygallery"><img src="image/edap.jpg" alt=""></a><br><br>
            
       
    </div>

          
    
</div>
</div>



<!--- Fin de la partie gallery-->

<!--debut-- de la partie témoignages--->
<!-- --->
    <div class="container">
    <section class="review" id="review">
        
            <div class="section-header text-center ">
                <h2 class="section-title">Témoignages</h2>
                <div class="line"><span></span></div>
                <p>Voici les témoignages de ceux qui ont acquis une formation de qualité aussein de l'edap Upn</p>
            </div>
            
            
                <!-----FIRST TESTIMONY-->
                <div class="container">
        <div class="swiper-container review-slider">
            <div class="swiper-wrapper">

                            <div class="swiper-slide">
                            <div class="box">
                                <img src="image/man.jpg" alt="">
                                <h3>David M</h3>
                                <p>J'ai commencé depuis l'école primaire jusqu'aux humanités et je ne regrette rien... L'edap upn , c'est mon école!!</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                     
                        <div class="swiper-slide">
                            <div class="box">
                                <img src="image/man.jpg" alt="">
                                <h3>Benny b</h3>
                                <p>Une des meilleures écoles de la place</p><br><br>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        

                        <div class="swiper-slide">
                            <div class="box">
                                <img src="image/woman.jpg" alt="">
                                <h3>Mariam N</h3>
                                <p>Si aujourd'huit, mes soeurs, mes frères et moi avons des bonnes bases c'est grâce à cette école</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        

            
                        
                    </div>
        </div>      
    </div>

    
 </section>
</div>
<!--fin de la partie témoignages--->
 
    <section id="contact" class="bg-white" >
        <div class="container">
            <div class="section-header text-center ">
                <h2 class="section-title">Contact</h2>
                <div class="line"><span></span></div>
                <p>En cas de préoccupation concernant l'edap, veuillez nous contacter qu'on vous reponde immediatement</p>
              </div>
              
            <div class="message row m-0-auto">
                  
                <div class="contact col-md-6">
                
                <?php  require_once('includes/errors.php'); ?>     
                     
                   
                    <form action="" method="post">
                        <div class="form-group mt-20">
                            <input type="text" class="form-control" name="pseudo" aria-describedby="emailHelp" placeholder="Votre nom" required>
                        </div>
                        <div class="form-group mt-20">
                            <input type="email" class="form-control" name="email" placeholder="email" required>
                        </div>
                        
                        <div class="form-group mt-20">
                            <!--<input name="" id="" cols="30" rows="10" class="text form-control" placeholder="" >-->
                            <textarea class="text form-control"  name="message" id="" cols="30" rows="10" placeholder="votre message"></textarea>
                        </div>
                        <button type="submit" class=" btn-block" name="envoyer">Envoyer</button>
                        
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>


    <?php  require_once('includes/footer.php'); ?>


</body>
</html>