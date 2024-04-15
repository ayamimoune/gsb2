<?php
include_once "modele/connexionPDO.php";
include_once "modele/appartementBD.php";

$pdo = new connexionPDO();
$appartementDB = new appartementBD(); // Utilise déjà le PDO dans son constructeur

$appartements = $appartementDB->getApparts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Appartements</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="vue/connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <h1>Liste des Appartements</h1>
    <div>
        <?php if ($appartements): ?>
            <?php foreach ($appartements as $appartement): ?>
                <div>
                    <h2><?= htmlspecialchars($appartement->getAdresse()); ?></h2>
                    <p>Type: <?= htmlspecialchars($appartement->getTypeAppart()); ?></p>
                    <p>Loyer: <?= htmlspecialchars($appartement->getLoyer()); ?>€/mois</p>
                    <a href="demande.php?appartement_id=<?= $appartement->getIDAppart(); ?>">Faire une demande</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun appartement disponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>
