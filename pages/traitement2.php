<?php
require('../inc/function.php');
require('../inc/connection.php');
session_start();
$bdd = dbconnect();

$nom = $_POST['name'];
$prenom = $_POST['prenom'];
$dtn = $_POST['dtn'];
$genre = $_POST['genre'];
$email = $_POST['email'];
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];



$id_membre = $_SESSION['id_membre'];

$uploadDir = realpath(__DIR__ . '/../assets/images/') . DIRECTORY_SEPARATOR;
$maxsize = 10 * 1024 * 1024;
$allowedMimeType = ['image/png', 'image/jpg', 'image/jpeg'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])){
    $file = $_FILES['img'];

    if ($file['error'] !== UPLOAD_ERR_OK){
        die ('Erreur . ' . $file['error']);
    }

    if ($file['size'] > $maxsize){
        die ('Le fichier est trop volumineux');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeType)){
        die ('Type de fichier non accepté : ' . $mime);
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION); 
    $newName = 'pdp' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)){
        inserer_utilisateur($bdd, $nom, $prenom, $dtn, $genre, $email, $ville, $mdp, $newName);
        $donnee = recuperer_utilisateur($bdd, $email, $mdp);
        $_SESSION['nom_membre'] = $donnee['nom'];
        $_SESSION['prenom_membre'] = $donnee['prenom'];
        $_SESSION['id_membre'] = $donnee['id_membre'];
        header('Location: ../pages/home.php');
    }
    else{
        header('Location: ../pages/inscription.php?num=1');
    }

}
else{
    header('Location: ../pages/inscription.php?num=1');
}






























// Suppression du code doublon inutile
?>
