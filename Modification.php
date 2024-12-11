<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $requete = $bdd->prepare("SELECT * FROM inscrit WHERE id = :id");
        $requete->execute([':id' => $id]);
        $inscrit = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$inscrit) {
            throw new Exception("Utilisateur non trouvé.");
        }
    } else {
        throw new Exception("Aucun ID fourni.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = filter_var(trim($_POST['nom']), FILTER_SANITIZE_STRING);
        $prenom = filter_var(trim($_POST['prenom']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $ville = filter_var(trim($_POST['ville']), FILTER_SANITIZE_STRING);

        $requete = $bdd->prepare("
            UPDATE inscrit SET nom = :nom, prenom = :prenom, email = :email, ville = :ville WHERE id = :id
        ");
        $requete->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':ville' => $ville,
            ':id' => $id,
        ]);

        header("Location: admin.php");
        exit();
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Inscrit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Modifier un Inscrit</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($inscrit['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($inscrit['prenom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($inscrit['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?= htmlspecialchars($inscrit['ville']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="admin.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
