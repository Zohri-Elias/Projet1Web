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
header("Location: acces.html");
?>


