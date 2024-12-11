<?php

$bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
$requete = $bdd->prepare("SELECT email,password FROM inscrit WHERE email= :email AND password= :password");

$requete->execute(array(
    "email" => $_POST['email'],
    "password" => $_POST['password']
));

$res = $requete->fetch();
var_dump($res);

if($requete->rowCount() > 0){
    header("Location: Arrive.html");
}else{
    header("Location: connexion.html");
}
?>
