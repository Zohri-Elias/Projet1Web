<?php
$bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
$requete = $bdd->prepare('SELECT* FROM inscrit');

$res= execute(array(

));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des membres</title>
</head>
<body>
<h1>Gestion des membres</h1>

<h2>Modifier un membre</h2>
<form action="Modification.php" method="POST">
    <label for="inscrit">Sélectionner un membre :</label>
    <select name="nom" id="inscrit" required>
    </select>

    <button type="submit">Modifier</button><br><br>

    <label for="email">Nouveau Email :</label>
    <input type="email" name="email"/><br><br>
    <label for="tel_fixe">Nouveau Telephone Fixe :</label>
    <input type="number" name="tel_fixe"/><br><br>
    <label for="tel_portable">Nouveau Telephone Portable :</label>
    <input type="number" name="tel_portable"/><br><br>
    <label for="rue">Nouvelle Rue :</label>
    <input type="text" name="rue"/><br><br>
    <label for="cp">Nouveau Code Postal :</label>
    <input type="number" name="cp"/><br><br>
    <label for="ville">Nouvelle Ville :</label>
    <input type="text" name="ville"/><br><br>
    <label for="password">Nouveau Mot de passe :</label>
    <input type="password" name="password"/><br><br>

    <button type="submit">Modifier</button>

</form>

<h2>Supprimer un membre</h2>
<form action="Suppression.php" method="POST">
    <label for="id_inscrit">Sélectionner un membre :</label>
    <select name="nom" id="nom" required></select>
    <button type="submit">Supprimer</button>
</form>

</body>
</html>