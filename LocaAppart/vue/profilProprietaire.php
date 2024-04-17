<?php

include_once "../modele/connexionPDO.php";

session_start();

// Vérifier si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    header("Location: connexion.php");
    exit();
}

// Inclure le modèle pour accéder à la base de données des propriétaires
include_once "../modele/proprietaireBD.php";

// Récupérer l'identifiant du propriétaire à partir de la session
$id_proprietaire = $_SESSION["id_proprietaire"];

// Créer une instance de la classe proprietaireBD
$proprietaireBD = new proprietaireBD();

// Récupérer les informations du propriétaire en utilisant son identifiant
$proprietaire = $proprietaireBD->getProprioById($id_proprietaire);

// Vérifier si le propriétaire existe
if ($proprietaire) {
    $nom = $proprietaire->getNomProprio();
    $prenom = $proprietaire->getPrenomProprio();
    $email = $proprietaire->getMailProprio();
    $telephone = $proprietaire->getTelephoneProprio();
} else {
    // Rediriger avec un message d'erreur si le propriétaire n'existe pas
    header("Location: tableau_de_bord_proprietaire.php?error=proprietaire_non_trouve");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../proprietaire.css">
    <title>Profil Propriétaire</title>
</head>
<body>
    <div class="header">
        <h2>Profil Propriétaire</h2>
        <a href="tableau_de_bord_proprietaire.php">Retour</a>
        <a href="../controleur/deconnexion.php">Déconnexion</a>
    </div>

    <div class="content">
        <h3>Mes informations</h3>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($nom); ?></p>
        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($prenom); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($telephone); ?></p>
    </div>
</body>
</html>
