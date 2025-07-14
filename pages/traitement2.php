<?php
require('../inc/function.php');
require('../inc/connection.php');
session_start();

$bdd = dbconnect();

$nom = $_POST['name'];
$email = $_POST['mail'];
$mdp = $_POST['pwd'];

inserer_utilisateur($bdd, $nom, $email, $mdp);

$donnee = recuperer_utilisateur($bdd, $email, $mdp);

$_SESSION['nom_membre'] = $donnee['nom'];
$_SESSION['id_membre'] = $donnee['id_membre'];

header("Location:../pages/home.php");
?>
