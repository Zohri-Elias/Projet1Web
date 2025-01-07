<?php
try {

    $bdd = new PDO("mysql:host=localhost;dbname=biblio", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (
        !isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])
        || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password'])
    ) {
        throw new Exception("Veuillez remplir tous les champs obligatoires.");
    }

    $nom        = filter_var(trim($_POST['nom']), FILTER_SANITIZE_STRING);
    $prenom     = filter_var(trim($_POST['prenom']), FILTER_SANITIZE_STRING);
    $email      = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $tel_fixe   = filter_var($_POST['tel_fixe'], FILTER_SANITIZE_NUMBER_INT);
    $tel_portable = filter_var($_POST['tel_portable'], FILTER_SANITIZE_NUMBER_INT);
    $rue        = filter_var(trim($_POST['rue']), FILTER_SANITIZE_STRING);
    $cp         = filter_var($_POST['cp'], FILTER_SANITIZE_NUMBER_INT);
    $ville      = filter_var(trim($_POST['ville']), FILTER_SANITIZE_STRING);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hachage du mot de passe

    $requete = $bdd->prepare("
        INSERT INTO inscrit (nom, prenom, email, tel_fixe, tel_portable, rue, cp, ville, password) 
        VALUES (:nom, :prenom, :email, :tel_fixe, :tel_portable, :rue, :cp, :ville, :password)
    ");

    $requete->execute(array(
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "tel_fixe" => $tel_fixe,
        "tel_portable" => $tel_portable,
        "rue" => $rue,
        "cp" => $cp,
        "ville" => $ville,
        "password" => $password
    ));

    header("Location: Arrive.html");
    exit();

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire d'Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Formulaire d'Inscription</h3>
                </div>
                <div class="card-body">
                    <form action="Inscription.php" method="POST">

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                        </div>

                        <div class="mb-3">
                            <label for="tel_fixe" class="form-label">Téléphone Fixe</label>
                            <input type="tel" class="form-control" id="tel_fixe" name="tel_fixe" placeholder="Entrez votre téléphone fixe">
                        </div>

                        <div class="mb-3">
                            <label for="tel_portable" class="form-label">Téléphone Portable</label>
                            <input type="tel" class="form-control" id="tel_portable" name="tel_portable" placeholder="Entrez votre téléphone portable">
                        </div>

                        <div class="mb-3">
                            <label for="rue" class="form-label">Rue</label>
                            <input type="text" class="form-control" id="rue" name="rue" placeholder="Entrez votre adresse">
                        </div>

                        <div class="mb-3">
                            <label for="cp" class="form-label">Code Postal</label>
                            <input type="number" class="form-control" id="cp" name="cp" placeholder="Entrez votre code postal">
                        </div>

                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrez votre ville">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Envoyer</button>
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


