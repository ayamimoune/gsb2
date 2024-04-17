<?php
// Assurez-vous que la session est démarrée pour accéder aux variables de session
session_start();

// Vérifiez si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté en tant que propriétaire
    header("Location: connexion.php");
    exit();
}

// Inclure le modèle pour accéder à la base de données des demandes
include_once "../modele/demandeBD.php";

// Récupérer l'identifiant du propriétaire depuis la session
$id_proprietaire = $_SESSION["id_proprietaire"];

// Créer une instance de la classe demandeBD
$demandeBD = new demandeBD();

// Récupérer les demandes associées à l'appartement du propriétaire
$demandes = $demandeBD->getDemandesByProprietaire($id_proprietaire);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Demandes</title>
    <link rel="stylesheet" href="../proprietaire.css">
</head>
<body>
    <div class="header">
        <h2>Gérer les Demandes</h2>
        <a href="tableau_de_bord_proprietaire.php">Retour au Tableau de Bord</a>
        <a href="../controleur/deconnexion.php">Déconnexion</a>
    </div>

    <div class="content">
        <h3>Demandes reçues pour votre appartement</h3>
        <?php if ($demandes): ?>
            <ul>
                <?php foreach ($demandes as $demande): ?>
                    <li>
                        <strong>Locataire:</strong> <?= htmlspecialchars($demande->getNomLocataire()); ?><br>
                        <strong>Adresse:</strong> <?= htmlspecialchars($demande->getAdresseAppart()); ?><br>
                        <strong>Type:</strong> <?= htmlspecialchars($demande->getTypeAppart()); ?><br>
                        <strong>Loyer:</strong> <?= htmlspecialchars($demande->getLoyerAppart()); ?>€/mois<br>
                        <a href="accepterDemande.php?id_demande=<?= $demande->getId(); ?>">Accepter</a>
                        <a href="rejeterDemande.php?id_demande=<?= $demande->getId(); ?>">Rejeter</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune demande reçue pour le moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
