<?php
// Assurez-vous que la session est démarrée pour accéder aux variables de session
session_start();

// Vérifiez si l'utilisateur est connecté en tant que locataire
if (!isset($_SESSION["id_locataire"]) || !isset($_SESSION["nomLocataire"])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté en tant que locataire
    header("Location: connexion.php");
    exit();
}

// Inclure le modèle pour accéder à la base de données des locataires
include_once "../modele/locataireBD.php";

// Récupérer l'identifiant du locataire à partir de la session
$id_locataire = $_SESSION["id_locataire"];

// Créer une instance de la classe locataireBD
$locataireBD = new locataireBD();

// Récupérer les informations du locataire en utilisant son identifiant
$locataire = $locataireBD->getLocataireById($id_locataire);

// Vérifier si le locataire existe
if ($locataire) {
    $nom = $locataire->getNomLocataire();
    $prenom = $locataire->getPrenomLocataire();
    $email = $locataire->getMailLocataire();
    $telephone = $locataire->getTelephoneLocataire();
} else {
    // Rediriger avec un message d'erreur si le locataire n'existe pas
    header("Location: tableau_de_bord_locataire.php?error=locataire_non_trouve");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../locataire.css">
    <title>Profil Locataire</title>
</head>
<body>
    <div class="header">
        <h2>Profil Locataire</h2>
        <a href="tableau_de_bord_locataire.php">Retour</a>
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
