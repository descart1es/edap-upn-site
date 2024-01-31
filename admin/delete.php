<?php
    session_start();
    include_once "../includes/db.php";
   
  if($_POST['id']){
    
    $query = "DELETE FROM users WHERE id=" . $_POST['id'];
    $sqlreq = $db->prepare($query);
    $sqlreq->execute();      
    $_SESSION['flash']['success']= " cet utilisateur a été supprimer!";
    header('Location: index.php');
     exit();

  } else{
    $_SESSION['flash']['danger']= " cet utilisateur n'a pas été supprimer!";
    header('Location: index.php');
    exit();
  }








?>