<?php

    session_start();
    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $categories = liste_categories($bdd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout</title>
</head>
<body>
    <form action="../pages/traitement3.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom">
        <br>
        <label for="categorie">Categorie:</label>
        <select name="categorie" id="categorie">
            <?php while($donnee = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?php echo $donnee['id_categorie'];?>"><?php echo $donnee['nom_categorie'];?></option>
            <?php } ?>
        </select>
        <br>
        <label for="img">Selectionnez images:</label>
        <input type="file" name="img[]" id="img" required multiple>
        <br>
        <input type="submit" value="Valider">
    </form>
</body>
</html>