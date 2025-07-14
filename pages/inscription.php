<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez inscrire ! </title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<body class="bg-light text-dark d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow-lg bg-white border border-secondary" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-4">
      <h2 class="mt-2">Inscription</h2>
      <p class="text-muted">Créez votre compte</p>
    </div>
    <form action="../pages/traitement2.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" id="name" class="form-control bg-light text-dark border-secondary" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input type="email" name="mail" id="email" class="form-control bg-light text-dark border-secondary" required>
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Mot de passe</label>
        <input type="password" name="pwd" id="pwd" class="form-control bg-light text-dark border-secondary" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Valider</button>
    </form>
  </div>
</body>
</html>