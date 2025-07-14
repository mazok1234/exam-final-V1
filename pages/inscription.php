<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez inscrire ! </title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark min-vh-100 d-flex flex-column justify-content-center align-items-center">
  <div class="container-fluid px-2 px-md-0 d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card p-3 p-md-4 shadow-lg bg-white border border-secondary w-100" style="max-width: 380px; border-radius: 1.5rem;">
    <div class="text-center mb-3">
      <i class="bi bi-person-circle fs-1 text-primary"></i>
      <h2 class="mt-2 mb-1">Inscription</h2>
      <p class="text-muted mb-0">Créez votre compte</p>
    </div>
    <form action="../pages/traitement2.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" id="name" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="prenom" class="form-label">Prenom</label>
        <input type="text" name="prenom" id="prenom" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="dtn" class="form-label">Date de naissance</label>
        <input type="date" name="dtn" id="dtn" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <select name="genre" id="genre" class="form-select bg-light text-dark border-secondary rounded-pill" required>
          <option value="M">Homme</option>
          <option value="F">Femme</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="ville" class="form-label">Ville</label>
        <input type="text" name="ville" id="ville" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <div class="mb-3">
        <label for="img" class="form-label">Photo de profil</label>
        <input type="file" name="img" id="img" class="form-control bg-light text-dark border-secondary rounded-pill" required>
      </div>
      <button type="submit" class="btn btn-danger w-100 rounded-pill py-2">Valider</button>
    </form>
    <div class="text-center mt-3">
      <p class="mb-0">Déjà un compte ? <a href="index.php" class="text-info">Connectez-vous</a></p>
    </div>
    </div>
  </div>
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</body>
</html>