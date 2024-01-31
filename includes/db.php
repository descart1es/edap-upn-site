<?php  
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'edap_site';
try{

    $db =new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $user,$pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
    return $db;

}catch(PDOException $error) {
    $_SESSION['flash']['danger'] = "echec de la connexion";
    $error->getMessage();
}




?>