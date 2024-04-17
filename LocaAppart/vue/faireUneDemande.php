<?php
// Assurez-vous que la session est démarrée pour accéder aux variables de session
session_start();

// Vérifiez si l'utilisateur est connecté en tant que locataire
if (!isset($_SESSION["id_locataire"]) || !isset($_SESSION["nomLocataire"])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté en tant que locataire
    header("Location: connexion.php");
    exit();
}

// Vérifiez si l'identifiant de l'appartement à demander est présent dans les paramètres GET
if (!isset($_GET['id_appart'])) {
    // Redirigez l'utilisateur vers la liste des appartements s'il n'y a pas d'identifiant spécifié
    header("Location: tableau_de_bord_locataire.php");
    exit();
}

// Récupérez l'identifiant de l'appartement depuis les paramètres GET
$appartementId = $_GET['id_appart'];

// Inclure les fichiers nécessaires
include_once "../modele/connexionPDO.php";
include_once "../modele/appartementBD.php";

// Créer une instance de la classe appartementBD pour interagir avec les appartements
$pdo = new connexionPDO();
$appartementDB = new appartementBD();

// Récupérer les détails de l'appartement spécifié
$appartement = $appartementDB->getAppartById($appartementId);

// Vérifiez si l'appartement existe
if (!$appartement) {
    // Redirigez l'utilisateur vers la liste des appartements si l'appartement n'est pas trouvé
    header("Location: tableau_de_bord_locataire.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Faire une Demande</title>
    <link rel="stylesheet" href="../locataire.css">
</head>
<body>
    <div class="header">
        <h2>Faire une Demande</h2>
        <div class="profile">
            <a href="tableau_de_bord_locataire.php">Retour au Tableau de Bord</a>
        </div>
    </div>

    <div class="content">
        <h3>Confirmer la demande pour l'appartement suivant :</h3>
        <p>Adresse: <?= htmlspecialchars($appartement->getAdresse()); ?></p>
        <p>Type: <?= htmlspecialchars($appartement->getTypeAppart()); ?></p>
        <p>Loyer: <?= htmlspecialchars($appartement->getLoyer()); ?>€/mois</p>

        <form action="faireUneDemande.php" method="post">
            <input type="hidden" name="appartement_id" value="<?= $appartementId ?>">
            <input type="submit" name="confirm_demande" value="Demander l'Appartement">
        </form>
    </div>

</body>
</html>
