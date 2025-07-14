<?php
require('../inc/function.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Indrana</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/style2.css">
</head>
<body class="bg-light text-dark d-flex justify-content-center align-items-center vh-100">

  <div class="card p-4 shadow-lg bg-white border border-secondary" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-4">
      <i class="bi bi-camera-video-fill fs-1 text-danger"></i>
      <h2 class="mt-2">Indrana</h2>
      <p class="text-muted">Connectez-vous pour continuer</p>
      <?php
      if (isset($_GET['num']) && $_GET['num'] == 1) {
            echo '<p class="text-danger text-center mt-3">Email ou Mot de Passe incorrect</p>';
        }
      ?>
    </div>

    <form action="../pages/traitement1.php" method="post">
      <div class="mb-3">
        <label for="email">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="form-control bg-light text-dark border-secondary" required>
      </div>
      <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" class="form-control bg-light text-dark border-secondary" required>
      </div>
      <button type="submit" class="btn btn-danger w-100">Se connecter</button>
    </form>

    <div class="text-center mt-3">
      <p class="mb-0">Pas encore de compte ?</p>
      <a href="../pages/inscription.php" class="text-info">Créer un compte</a>
    </div>
  </div>

</body>
</html>
