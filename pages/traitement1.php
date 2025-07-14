<?php 
require('../inc/function.php');
require('../inc/connection.php');
session_start();

$bdd = dbconnect();

$mail_user = $_POST['mail'];
$mdp_user = $_POST['pwd'];

$donnee = verifier_utilisateur($bdd, $mail_user, $mdp_user);

if ($donnee) {
    connecter_utilisateur($donnee);
    header("Location:../pages/traitement3.php");
} else {
    header("Location:../pages/index.php?num=1");
}
?>
