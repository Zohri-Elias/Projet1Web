<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['nom'])) {
        $nom = filter_var($_GET['nom'], FILTER_SANITIZE_STRING); // Assainir l'entrée pour éviter les problèmes de sécurité

        $requete = $bdd->prepare("DELETE FROM inscrit WHERE nom = :nom");
        $requete->execute([':nom' => $nom]);

        header("Location: admin.php?message=supprime");
        exit();
    } else {
        throw new Exception("Nom utilisateur non spécifié.");
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>
