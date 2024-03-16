<?php
include_once '../controleurs/c_param_connexion.php';
include_once '../modeles/class_Medecin.php';
include_once '../css/style.css';

// Appeler la méthode pour rechercher le médecin par nom
$nom = "Nom à rechercher";
$resultatRecherche = Medecin::rechercherMedecinParNom($nom);

// Vérifier si des résultats ont été trouvés
if ($resultatRecherche) {
    // Afficher les informations du médecin
    echo "<p>Nom : " . $resultatRecherche->getNom() . "</p>";
    echo "<p>Prenom : " . $resultatRecherche->getPrenom() . "</p>";
    echo "<p>Tel : " . $resultatRecherche->getTel() . "</p>";
    echo "<p>Spécialité : " . $resultatRecherche->getSpecialiteComplementaire() . "</p>";
    echo "<p>Mail : " . $resultatRecherche->getMail() . "</p>";
    // Afficher d'autres informations si nécessaire
} else {
    echo "Aucun médecin trouvé pour le nom '$nom'.";
}
?>

<?php include("v_zoneLogin.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Résultats de la recherche</title>
    <meta name="Author" content="Votre Nom">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
    <h1>Résultats de la recherche</h1>
    <ul>
        <li><a href='../vues/v_acceuil.php'>Retour</a></li>
    </ul>
</body>
</html>

