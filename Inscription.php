<?php
$bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
$requete = $bdd->prepare("INSERT INTO inscrit(nom,prenom,email,tel_fixe,tel_portable,rue,cp,ville,password) VALUES (:nom,:prenom,:email,:tel_fixe,:tel_portable,:rue,:cp,:ville,:password)");

$requete->execute(array(
    "nom" => $_POST['nom'],
    "prenom" => $_POST['prenom'],
    "email" => $_POST['email'],
    "tel_fixe" => $_POST['tel_fixe'],
    "tel_portable" => $_POST['tel_portable'],
    "rue" => $_POST['rue'],
    "cp" => $_POST['cp'],
    "ville" => $_POST['ville'],
    "password" => $_POST['password']
));
header("Location: Arrive.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
</head>
<body>

<h1>Formulaire</h1>

<form action="Inscription.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom"/><br><br>
    <label for="prenom">prenom :</label>
    <input type="text" name="prenom"/><br><br>
    <label for="email">Email :</label>
    <input type="email" name="email"/><br><br>
    <label for="tel_fixe">Telephone Fixe :</label>
    <input type="number" name="tel_fixe"/><br><br>
    <label for="tel_portable">Telephone Portable :</label>
    <input type="number" name="tel_portable"/><br><br>
    <label for="rue">Rue :</label>
    <input type="text" name="rue"/><br><br>
    <label for="cp">Code Postal :</label>
    <input type="number" name="cp"/><br><br>
    <label for="ville">Ville :</label>
    <input type="text" name="ville"/><br><br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password"/><br><br>

    <input type="submit" value="Envoyer">
</form>
</body>
</html>

