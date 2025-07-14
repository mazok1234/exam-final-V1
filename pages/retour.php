<?php
session_start();
require('../inc/function.php');
require('../inc/connection.php');
$bdd = dbconnect();

// Récupération de l'emprunt
$id_emprunt = isset($_GET['id_emprunt']) ? $_GET['id_emprunt'] : null;
if (!$id_emprunt) {
    echo "<div class='alert alert-danger'>Aucun emprunt sélectionné.</div>";
    exit();
}

// Récupération des infos de l'emprunt
$sql = "SELECT e.*, o.nom_objet FROM emprunter_emprunt e JOIN emprunter_objet o ON e.id_objet = o.id_objet WHERE e.id_emprunt = '$id_emprunt'";
$res = mysqli_query($bdd, $sql);
$emprunt = mysqli_fetch_assoc($res);
if (!$emprunt) {
    echo "<div class='alert alert-danger'>Emprunt introuvable.</div>";
    exit();
}

// Traitement du retour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etat = $_POST['etat'] ?? '';
    // Marquer l'objet comme retourné (suppression ou update de l'emprunt)
    mysqli_query($bdd, "DELETE FROM emprunter_emprunt WHERE id_emprunt = '$id_emprunt'");
    // Compter abimé ou non abimé
    if ($etat === 'abime') {
        mysqli_query($bdd, "INSERT INTO emprunter_retour (id_objet, abime) VALUES ('{$emprunt['id_objet']}', 1)");
    } else {
        mysqli_query($bdd, "INSERT INTO emprunter_retour (id_objet, abime) VALUES ('{$emprunt['id_objet']}', 0)");
    }
    header('Location: home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Retour d'emprunt</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg bg-white border border-secondary" style="max-width: 400px; width:100%;">
        <h3 class="mb-3 text-center">Retour de l'objet</h3>
        <p class="text-center"><strong><?php echo htmlspecialchars($emprunt['nom_objet']); ?></strong></p>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">L'objet est-il abîmé ?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="etat" id="abime" value="abime" required>
                    <label class="form-check-label" for="abime">Abîmé</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="etat" id="nonabime" value="nonabime" required>
                    <label class="form-check-label" for="nonabime">Non abîmé</label>
                </div>
            </div>
            <button type="submit" class="btn btn-danger w-100">Valider le retour</button>
        </form>
    </div>
</body>
</html>
