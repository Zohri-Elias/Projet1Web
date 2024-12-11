<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        $bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $bdd->prepare("SELECT * FROM inscrit WHERE email = :email AND password = :password");
        $requete->execute([':email' => $email, ':password' => $password]);

        if ($requete->rowCount() > 0) {
            echo '<div class="alert alert-success text-center">Connexion réussie ! Bienvenue.</div>';
            header('Location: Arrive.html');
            exit();
        } else {
            $requete = $bdd->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
            $requete->execute([':email' => $email, ':password' => $password]);

            if ($requete->rowCount() > 0) {
                echo '<div class="alert alert-success text-center">Connexion réussie ! Bienvenue.</div>';
                header('Location: Arrive.html');
                exit();
            } else {
                echo '<div class="alert alert-danger text-center">Email ou mot de passe incorrect.</div>';
            }
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger text-center">Erreur : ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Connexion</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <div class="mt-3 text-center">
            <a href="#">Mot de passe oublié ?</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>