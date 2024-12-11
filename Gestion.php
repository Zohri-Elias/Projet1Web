<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $inscrits = $bdd->query("SELECT * FROM inscrit")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Inscrits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Gestion des Inscrits</h1>
    <table class="table table-striped mt-4">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Ville</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($inscrits as $inscrit): ?>
            <tr>
                <td><?= htmlspecialchars($inscrit['nom']) ?></td>
                <td><?= htmlspecialchars($inscrit['prenom']) ?></td>
                <td><?= htmlspecialchars($inscrit['email']) ?></td>
                <td><?= htmlspecialchars($inscrit['ville']) ?></td>
                <td>
                    <a href="Modification.php?id=<?= $inscrit['nom'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="Suppression.php" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet inscrit ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
