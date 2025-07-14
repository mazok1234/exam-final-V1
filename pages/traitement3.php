<?php

    session_start();
    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $nom = $_POST['nom'];
    $idMembre = $_SESSION['id_membre'];
    $categorie = $_POST['categorie'];
    $idObjet = recuperer_dernier_id_objet($bdd) + 1;

    $uploadDir = realpath(__DIR__ . '/../assets/images/') . DIRECTORY_SEPARATOR;
    $maxsize = 10 * 1024 * 1024;
    $allowedMimeType = ['image/png', 'image/jpg', 'image/jpeg'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])){
        $file = $_FILES['img'];

        $nbr = count($file['name']);

        // $nomImages = [];

        for ($i=0;$i<$nbr;$i++){
            if ($file['error'][$i] !== UPLOAD_ERR_OK){
                die ('Erreur . ' . $file['error']);
            }
    
            if ($file['size'][$i] > $maxsize){
                die ('Le fichier est trop volumineux');
            }
    
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name'][$i]);
            finfo_close($finfo);
    
            if (!in_array($mime, $allowedMimeType)){
                die ('Type de fichier non accepté : ' . $mime);
            }
    
            $extension = pathinfo($file['name'][$i], PATHINFO_EXTENSION); 
            $newName = 'image' . uniqid() . '.' . $extension;

            // $nomImages[$i] = $newName;

            if (move_uploaded_file($file['tmp_name'][$i], $uploadDir . $newName)){
                ajouter_objet($bdd, $nom, $idMembre, $categorie, $nom, $idObjet);
                $i++;
                // header('Location: ../pages/home.php');
                if ($i == $nbr){
                    header('Location: ../pages/home.php');
                }
            }
            else{
                header('Location: ../pages/inscription.php?num=1');
            }
        }



    }
    else{
        header('Location: ../pages/inscription.php?num=1');
    }

?>