<?php

    require('../inc/function.php');
    require('../inc/connection.php');
    session_start();    
    $bdd = dbconnect();

    $id_membre = $_SESSION['id_membre'];

    $categorie = liste_categories($bdd);

    $donnee = mysqli_fetch_assoc(recuperer_utilisateur($bdd, $id_membre));



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light text-dark">
  <div class="container-fluid pt-4">
    <div class="row align-items-center justify-content-center">
      <div class="col-auto">
        <img src="../assets/images/<?php echo htmlspecialchars($donnee['image_profil']); ?>" alt="Photo de profil" class="rounded-circle border border-secondary" style="width: 80px; height: 80px; object-fit: cover;">
      </div>
      <div class="col-auto">
        <h2 class="mb-0"><?php echo htmlspecialchars($donnee['nom']); ?></h2>
        <h2 class="mb-0"><?php echo htmlspecialchars($donnee['prenom']); ?></h2>
      </div>
    </div>
    <hr>
    <h4 class="mt-4">Liste des objets</h4>
    <div class="row mt-3 align-items-center">
        <div class="col-auto d-flex align-items-center">
            <form action="../pages/home.php" method="post" class="d-flex align-items-center">
                <select name="nomCat" id="nomCat" class="form-select me-2">
                    <option value="tous">Tous</option>
                    <?php while ($donnee = mysqli_fetch_assoc($categorie)) { ?>
                        <option value="<?php echo $donnee['nom_categorie'];?>"><?php echo $donnee['nom_categorie'];?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Filtrer" class="btn btn-secondary me-2">
            </form>
        </div>
        <div class="">
            <a href="../pages/ajout.php" class="btn btn-primary ms-2">Ajouter un objet</a>
        </div>
    </div>
    <div class="row mt-3">
      <?php
      $resultat = null;
      if (!isset($_POST['nomCat']) || empty($_POST['nomCat'])) {
          $resultat = lister_objets_membre($bdd, $id_membre);
      } else {
          $categorie = $_POST['nomCat'];
          $resultat = liste_objets_categorie($bdd, $categorie);
      }
      if ($resultat && mysqli_num_rows($resultat) > 0) {
          while ($objet = mysqli_fetch_assoc($resultat)) {
              echo '<div class="col-md-4 mb-3">';
              echo '<div class="card h-100">';
              echo '<div class="card-body">';
              if (!empty($objet['image_objet'])) {
                  echo '<img src="../assets/images/' . htmlspecialchars($objet['image_objet']) . '" class="img-fluid mb-2" style="max-height:120px; border-radius:1rem;">';
              }
              echo '<h5 class="card-title">' . htmlspecialchars($objet['nom_objet']) . '</h5>';
              if($objet['date_retour'] != NULL  ) {
                  $nom_emprunteur = $objet['nom_emprunteur'] ?? 'Indisponible';
                  echo '<p class="card-text">Emprunté par : ' . htmlspecialchars($nom_emprunteur) . '</p>';
                  echo '<p class="card-text">Date de retour : ' . htmlspecialchars($objet['date_retour']) . '</p>';
                  $jours = jour_disponible($bdd, $objet['id_objet']);
                  if ($jours > 0) {
                      echo '<p class="card-text text-danger">Disponible dans : ' . htmlspecialchars($jours) . ' jour(s)</p>';
                  }
              } else {
                  echo '<p class="card-text">Disponible</p>';
                  echo '<a class="btn btn-success" href="../pages/emprunt.php?id_objet=' . $objet['id_objet'] . '">Emprunter</a>';
              }
              echo '</div>';
              echo '</div>';
              echo '</div>';
          }
      } else {
          echo '<p>Aucun objet trouvé.</p>';
      }
      ?>
    </div>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>