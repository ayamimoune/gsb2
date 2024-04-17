<?php
// Assurez-vous que la session est démarrée pour accéder aux variables de session
session_start();

// Vérifiez si l'utilisateur est connecté en tant que locataire
if (!isset($_SESSION["id_locataire"]) || !isset($_SESSION["nomLocataire"])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté en tant que locataire
    header("Location: connexion.php");
    exit();
}

// Récupérez les informations de l'utilisateur connecté depuis la session
$id_locataire = $_SESSION["id_locataire"];
$nom_locataire = $_SESSION["nomLocataire"];

include_once "../modele/connexionPDO.php";
include_once "../modele/appartementBD.php";

$pdo = new connexionPDO();
$appartementDB = new appartementBD(); // Utilise déjà le PDO dans son constructeur

$appartements = $appartementDB->getApparts();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Appartements</title>
    <link rel="stylesheet" href="../locataire.css">
</head>
<div class="header">
        <h2>Tableau de Bord Locataire</h2>
        <div class="profile">
            <a href="./mesdemandes.php">Mes demandes</a>
            <a href="profilLocataire.php">Mon Profil</a>
        </div>
    </div>
<body>
    <h1>Liste des Appartements</h1>
    <div>
        <?php if ($appartements): ?>
            <?php foreach ($appartements as $appartement): ?>
                <div>
                    <h2><?= htmlspecialchars($appartement->getAdresse()); ?></h2>
                    <p>Type: <?= htmlspecialchars($appartement->getTypeAppart()); ?></p>
                    <p>Loyer: <?= htmlspecialchars($appartement->getLoyer()); ?>€/mois</p>
                    <a href="./faireUneDemande.php?id_appart=<?= $appartement->getIDAppart(); ?>">Faire une demande</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun appartement disponible.</p>
        <?php endif; ?>
    </div>



</body>
</html>