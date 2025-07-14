
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

function recuperer_utilisateur($bdd, $id) {
    $requete = "SELECT * FROM emprunter_membre WHERE id_membre = '%s'";
    $requete = sprintf($requete, $id);
    $resultat = mysqli_query($bdd, $requete);
    return $resultat;
}

function liste_categories($bdd) {
    $sql = "SELECT * FROM emprunter_categorie_objet;";
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}

function lister_objets_membre($bdd, $id_membre) {
    $sql = "SELECT * FROM vue_objets_membre;";
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;    
}

function liste_objets_categorie($bdd, $categorie){
    $sql = "SELECT * FROM vue_objet_categorie
            WHERE nom_categorie = '%s';";
    $sql = sprintf($sql, $categorie);
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}
?>