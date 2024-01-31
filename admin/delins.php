<?php 
  session_start();
  include_once "../includes/db.php";


if($_POST['id']){
    
    $query = "DELETE FROM inscription WHERE id=" . $_POST['id'];
    $sqlreq = $db->prepare($query);
    $sqlreq->execute();

    $_SESSION['flash']['success']= " cet élève a été supprimer!";
    header('Location: inscription.php');
  }else{
    $_SESSION['flash']['danger']= " cet élève n'a pas été supprimer!";
    header('Location: inscription.php');
  }


?>