<?php 
require('../inc/function.php');
require('../inc/connection.php');
session_start();

$bdd = dbconnect();

$mail = $_POST['email'];
$mdp = $_POST['mdp'];

$donnee = verifier_utilisateur($bdd, $mail, $mdp);

if ($donnee) {
    connecter_utilisateur($donnee);
    header("Location:../pages/home.php");
} else {
    header("Location:../pages/index.php?num=1");
}
?>
