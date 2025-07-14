<?php

    session_start();
    require('../inc/function.php'); 
    require('../inc/connection.php');

    $bdd = dbconnect();

    $id_objet = $_POST['id_objet'];
    $dateFinEmprunt = $_POST['duree'];
    $id_membre = $_SESSION['id_membre'];

    ajouter_emprunt($bdd, $id_objet, $id_membre, $dateFinEmprunt);

    header('Location: ../pages/home.php');


?>