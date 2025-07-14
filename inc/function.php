

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
    $sql = "SELECT * FROM vue_objets_membre WHERE nom_categorie = '%s';";
    $sql = sprintf($sql, $categorie);
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}

function recuperer_dernier_id_objet($bdd){
    $sql = "SELECT COUNT(id_objet) AS nbr FROM emprunter_objet;";
    $resultat = mysqli_query($bdd, $sql);
    $donnee = mysqli_fetch_assoc($resultat);
    return $donnee['nbr'];
}

function ajouter_objet($bdd, $nom, $id_membre, $id_categorie, $nomImage, $idObjet){
    $sql = "INSERT INTO emprunter_objet (nom_objet, id_membre, id_categorie) 
             VALUES ('%s', '%s', '%s');";
    $sql = sprintf($sql1, $nom, $id_membre, $id_categorie);
    $resultat = mysqli_query($bdd, $sql1);

    return $resultat;

}

function ajouter_image_objet($bdd, $id_objet, $nomImage){
    $sql = "INSERT INTO emprunter_images_objet (id_objet, nom_image) 
             VALUES ('%s', '%s');";
    $sql = sprintf($sql2, $idObjet, $nomImage);
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}


function ajouter_emprunt($bdd, $id_objet, $id_membre, $date_retour) {
    $sql = "INSERT INTO emprunter_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES ('%s', '%s', CURDATE(), '%s')";
    $sql = sprintf($sql, $id_objet, $id_membre, $date_retour);
    return mysqli_query($bdd, $sql);
}

function jour_disponible($bdd, $id_objet){
    $sql = "SELECT TIMESTAMPDIFF(DAY, date_emprunt, date_retour) AS j FROM vue_objet_membre
            WHERE id_objet = '%s';";
    $sql = sprintf($sql, $id_objet);
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}
function get_liste_emprunts($bdd, $id_objet) {
    $sql = "SELECT * FROM emprunter_emprunt WHERE id_objet = '%s';";
    $sql = sprintf($sql, $id_objet);
    $resultat = mysqli_query($bdd, $sql);
    return $resultat;
}
function get_nombre_abimes($bdd, $id_membre) {
    $sql = "SELECT COUNT(*) AS total FROM emprunter_emprunt WHERE id_membre = '" . $id_membre . "' AND abime = 1";
    $res = mysqli_query($bdd, $sql);
    return $res;
}

function get_nombre_non_abimes($bdd, $id_membre) {
    $sql = "SELECT COUNT(*) AS total FROM emprunter_emprunt WHERE id_membre = '" . $id_membre . "' AND abime = 0";
    $res = mysqli_query($bdd, $sql);
    return $res;
}

?>