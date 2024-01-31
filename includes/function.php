<?php 

function generateToken($lenght){
    
    $alphanum = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

  return substr(str_shuffle(str_repeat($alphanum,$lenght)),0,$lenght);
   
}
function is_connected(){
  if(session_status() == PHP_SESSION_NONE){
      session_start();
  }
  if(!isset($_SESSION['auth'])){
       $_SESSION['flash']['danger']= 'Vous ne pouvez pas acceder à cette page ';
       header('Location: login.php');
       exit();
  }
 }
 function reconnect_auto(){
      if(session_status() == PHP_SESSION_NONE){
        session_start();
     }
     if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
         require_once('db.php');
         if(!isset($db)){
            global $db;
         }
         $rember_token= $_COOKIE['remember'];
         $parts= explode("::", $remember_token);
         $userId= $parts[0];
         $req=$db->prepare("SELECT * From users WHERE id=?");
         $req->execute([$userId]);
         $user= $req->fetch();


         if($user){
          $expected= $userId. "::" .$user->remember_token. sha1($user->id ."Username");
          if($expected == $_COOKIE['remember']){
           $_SESSION['auth'] = $user;
           $_SESSION['flash']['success'] = "Vous etes connecté avec succes!";
           setcookie('remember',$remember_token,time()+ 60 * 60 * 24 * 7);
           header('Location: index.php');
           exit();
          }else{
           setcookie("remember", "", -1);
          }

    
     }{
      setcookie("remember", "", -1);
     }

 }


}




?>