<?php 
session_start();
if(!isset($_SESSION['login'])){
    header('Location: access_denied.php');
}
$date=new DateTime(date("Y-m-d H:i:s"));

$event='## '.$date->format("Y-m-d H:i:s").' | '.$_SESSION['login'].' | Signed out.';
file_put_contents("Log.Log", $event."\n", FILE_APPEND);

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('login', '');

header('Location: index.php');

exit();

?>