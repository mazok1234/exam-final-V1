<?php
    function verifier_utilisateur($bdd, $email, $motdepasse) {
    $requete = "SELECT * FROM emprunter_membre WHERE email = '%s' AND mdp = '%s'";
    $requete = sprintf($requete, $email, $motdepasse);    
    $resultat = mysqli_query($bdd, $requete);
    return mysqli_fetch_assoc($resultat);
}

function connecter_utilisateur($donnee) {
    $_SESSION['nom_membre'] = $donnee['nom'];
    $_SESSION['prenom_membre'] = $donnee['prenom'];
    $_SESSION['id_membre'] = $donnee['id_membre'];
}
function inserer_utilisateur($bdd, $nom, $prenom, $dtn, $genre, $email, $ville, $mdp, $image) {
    $sql = "INSERT INTO emprunter_membre (nom,prenom,date_naissance,genre,email,ville,mdp,image_profil) VALUES ('%s', '%s', '%s', '%s','%s','%s','%s','%s')";
    $sql = sprintf($sql, $nom, $prenom, $dtn, $genre, $email, $ville, $mdp, $image);
    return mysqli_query($bdd, $sql);
}

function recuperer_utilisateur($bdd, $email, $mdp) {
    $requete = "SELECT * FROM emprunter_membre WHERE email = '%s' AND mdp = '%s'";
    $requete = sprintf($requete, $email, $mdp);
    $resultat = mysqli_query($bdd, $requete);
    return mysqli_fetch_assoc($resultat);
}
?>