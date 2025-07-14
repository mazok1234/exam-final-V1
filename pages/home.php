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
    <div class="row mt-3">
        <form action="../pages/home.php" method="post">
            <select name="nomCat" id="nomCat">
                <?php while ($donnee = mysqli_fetch_assoc($categorie)) { ?>
                    <option value="<?php echo $donnee['nom_categorie'];?>"><?php echo $donnee['nom_categorie'];?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Filtrer">
        </form>
      <?php
      if (!isset($_POST['nomCat'])){
          $resultat = lister_objets_membre($bdd, $id_membre);
          if ($resultat && mysqli_num_rows($resultat) > 0) {
              while ($objet = mysqli_fetch_assoc($resultat)) {
                  echo '<div class="col-md-4 mb-3">';
                  echo '<div class="card h-100">';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-title">' . htmlspecialchars($objet['nom_objet']) . '</h5>';
                  if($objet['date_retour'] != NULL  ) {
                      if($objet['nom_emprunteur'] == NULL) {
                          $objet['nom_membre'] = 'Indisponible';
                      } else {
                          $objet['nom_membre'] = $objet['nom_emprunteur'];
                      }
                      echo '<p class="card-text">Emprunté par : ' . htmlspecialchars($objet['nom_membre']) . '</p>';
                      echo '<p class="card-text">Date de retour : ' . htmlspecialchars($objet['date_retour']) . '</p>';
                  } else {
                      echo '<p class="card-text">Disponible</p>';
                  }   
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }
          } else {
              echo '<p>Aucun objet trouvé.</p>';
          }
      }
      if (isset($_POST['nomCat'])){
          $categorie = $_POST['nomCat'];
          $resultat = liste_objets_categorie($bdd, $categorie);
          if (mysqli_num_rows($resultat) > 0) {
              while ($objet = mysqli_fetch_assoc($resultat)) {
                  echo '<div class="col-md-4 mb-3">';
                  echo '<div class="card h-100">';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-title">' . htmlspecialchars($objet['nom_objet']) . '</h5>';
                  if($objet['date_retour'] != NULL  ) {
                      if($objet['nom_emprunteur'] == NULL) {
                          $objet['nom_membre'] = 'Indisponible';
                      } else {
                          $objet['nom_membre'] = $objet['nom_emprunteur'];
                      }
                      echo '<p class="card-text">Emprunté par : ' . htmlspecialchars($objet['nom_membre']) . '</p>';
                      echo '<p class="card-text">Date de retour : ' . htmlspecialchars($objet['date_retour']) . '</p>';
                  } else {
                      echo '<p class="card-text">Disponible</p>';
                  }   
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }
          } else {
              echo '<p>Aucun objet trouvé.</p>';
          }
      }
      ?>
  </div>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>