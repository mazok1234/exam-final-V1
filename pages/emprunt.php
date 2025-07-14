<?php

    session_start();
    require('../inc/function.php');
    require('../inc/connection.php');
    $bdd = dbconnect();

    $id_objet = $_GET['id_objet'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow-lg bg-white border border-secondary" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-4">
      <i class="bi bi-bag-plus-fill fs-1 text-danger"></i>
      <h2 class="mt-2">Emprunter un objet</h2>
      <p class="text-muted">Indiquez la durée souhaitée</p>
    </div>
    <form action="../pages/traitement4.php" method="post">
      <div class="mb-3">
        <label for="duree" class="form-label">Date fin d'emprunt:</label>
        <input type="date" id="duree" name="duree" min="1" class="form-control bg-light text-dark border-secondary" required>
        <input type="hidden" name="id_objet" value="<?php echo htmlspecialchars($id_objet); ?>">
      </div>
      <button type="submit" class="btn btn-danger w-100">Emprunter</button>
    </form>
    <div class="text-center mt-3">
      <a href="home.php" class="text-info">Retour à l'accueil</a>
    </div>
  </div>
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</body>
</html>