<?php
$bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $requete = $bdd->prepare("INSERT INTO auteurs (nom, prenom, date, pays) VALUES (:nom, :prenom, :date, :pays)");
    $requete->execute(array(
        "nom" => htmlspecialchars($_POST["nom"]),
        "prenom" => htmlspecialchars($_POST["prenom"]),
        "date" => htmlspecialchars($_POST["date"]),
        "pays" => htmlspecialchars($_POST["pays"]),
    ));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
    $requete = $bdd->prepare("UPDATE auteurs SET nom = :nom, prenom = :prenom, date = :date, pays = :pays WHERE id = :id");
    $requete->execute(array(
        "id" => htmlspecialchars($_POST["id"]),
        "nom" => htmlspecialchars($_POST["nom"]),
        "prenom" => htmlspecialchars($_POST["prenom"]),
        "date" => htmlspecialchars($_POST["date"]),
        "pays" => htmlspecialchars($_POST["pays"]),
    ));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer'])) {
    $requete = $bdd->prepare("DELETE FROM auteurs WHERE id = :id");
    $requete->execute(array("id" => htmlspecialchars($_POST["id"])));
}

$authors = $bdd->query("SELECT * FROM auteurs ORDER BY nom ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Inscrits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h3>Ajouter un Auteur</h3>
                </div>
                <div class="card-body">
                    <form action="GAuteurs.php" method="POST">

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Entrez sa date naissance" required>
                        </div>

                        <div class="mb-3">
                            <label for="pays" class="form-label">Pays</label>
                            <input type="pays" class="form-control" id="pays" name="pays" placeholder="Entrez son pays">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-dark btn-lg px-5">Envoyer</button>
                        </div>
                    </form>
                </div>
                <div class="card-header bg-dark text-white text-center">
                    <h3>Liste des Auteurs</h3>
                </div>
                <div class="card-body">
                    <form action="GAuteurs.php" method="POST">

                        <div class="mb-3">
                            <tbody>
                            <?php foreach ($authors as $auteur): ?>
                                <tr>
                                    <form action="GAuteurs.php" method="POST">
                                        <td><input type="text" name="nom" value="<?= $auteur['nom'] ?>"></td>
                                        <td><input type="text" name="prenom" value="<?= $auteur['prenom'] ?>"></td>
                                        <td><input type="date" name="date" value="<?= $auteur['date'] ?>"></td>
                                        <td><input type="text" name="pays" value="<?= $auteur['pays'] ?>"></td>
                                        <input type="hidden" name="id" value="<?= $auteur['id'] ?>">
                                        <td>
                                            <button type="submit" name="modifier" class="btn btn-success">Modifier</button>
                                            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>