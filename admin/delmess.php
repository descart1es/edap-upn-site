<?php 
  session_start();
  include_once "../includes/db.php";

if($_POST['id']){
    
    $query = "DELETE FROM `message` WHERE id=" . $_POST['id'];
    $sqlreq = $db->prepare($query);
    $sqlreq->execute();

    $_SESSION['flash']['success']= " ce message a pas été supprimer!";
    header('Location: message.php');
  }else{
    $_SESSION['flash']['danger']= " cet utilisateur n\a pas été supprimer!";
    header('Location: message.php');
  }



?>