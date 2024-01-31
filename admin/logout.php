<?php
// Ici on demarre la session d'abord la session
session_start();
setcookie("remember", "", -1);
//alors après avoir demarré la session, on detruit maintenant la session avec la fonction unset, puisque si je detruit avec session destroy tout les variable des session seront détruite

unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes deconnecté avec succes";
header('Location: index.php');
?>