<?php


$bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
$requete = $bdd->prepare('UPDATE email,tel_fixe,tel_portable,rue,cp,ville,password FROM inscrit SET email= :email,tel_fixe= :tel_fixe,tel_portable= :tel_portable,rue= :rue,cp= :cp,ville= :ville,password= :password');

$requete->execute(array(
    "email" => $_POST['email'],
    "tel_fixe" => $_POST['tel_fixe'],
    "tel_portable" => $_POST['tel_portable'],
    "rue" => $_POST['rue'],
    "cp" => $_POST['cp'],
    "ville" => $_POST['ville'],
    "password" => $_POST['password']
));
