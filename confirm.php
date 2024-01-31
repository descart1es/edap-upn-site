<?php 
session_start();
require_once('includes/db.php');

//Ici on recupère le jeton(token) et l'Id qui a été envoyer dans la boite mail de l'utlisateur
$userId= $_GET['id'];
$token= $_GET['token'];
//ici on essaie de verifier si l'utilisateur s'est réellement enregistré grace a son Id et qu'il existe dans la bdd, au cas contraire 
//On n'affichera un message pour lui dire qu'il n'existe pas et il sera redirigé dans la page register
$query= "SELECT * FROM users WHERE id = ?";
$req=$db->prepare($query);
$req->execute([$userId]);
$user = $req->fetch();

//var_dump($user); die();

//ici au cas où c bon je verifie si le token que l'utilisateur a réçu == à ce qui est dans la bdd
if($user && $token == $user->confirmation_token){
//ici je fais de sorte que si c bon, alors il enregistre la date de l'enreg. et c n plus la peine de gader le token, on doit vider cela puis faire la MAJ
$query= " UPDATE  users SET confirmation_token = NULL,confirmed_at = NOW() WHERE id = ? ";
$req = $db->prepare($query);
$req->execute([$userId]);
//execution de la requette;

//alors maintenant on affiche le message de succes
  $_SESSION['flash']['success'] = "Votre compte a bien été validé";
 //echo " <script text> alert ('Votre compte a bien été validé') </script>"
//ici c'est une variable qu'on crée pour affiché le nom de l
    $_SESSION['auth'] = $user;

 header("Location: index.php");
}else{
    $_SESSION['flash']['danger'] = "Ce compte n'existe pas";
    header("Location: register.php");
}





?>