<!DOCTYPE html>
<html lang="fr">
<head>
<title>Modifier un rapport</title>
 <meta NAME="Author" CONTENT="Aya Mimoune">
 <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
  <!-- appel feuille de style -->
 <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
 
</head>
<body>

<?php
include_once 'c_param_connexion.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer la date du rapport depuis le formulaire
    $date_rapport = $_POST['date_rapport'];

    // Assurez-vous de valider et de sécuriser la variable $date_rapport

    // Effectuer une requête SQL pour obtenir les rapports à la date spécifiée depuis la base de données
    $sql = "SELECT id_rapport, motif, bilan FROM rapport WHERE date_rapport = :date_rapport";
    $stmt = $lien_base->prepare($sql);
    $stmt->bindParam(':date_rapport', $date_rapport);
    $stmt->execute();
    $rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les rapports sous forme de liste avec des liens pour les modifier
    if (count($rapports) > 0) {
        echo "<h2>Rapports trouvés à la date $date_rapport :</h2>";
        echo "<ul>";
        foreach ($rapports as $rapport) {
            echo "<li>";
            echo "Motif : " . $rapport['motif'] . "<br>";
            echo "Bilan : " . $rapport['bilan'] . "<br>";
            echo "<a href='v_modifier_rapport_formulaire.php?id=" . $rapport['id_rapport'] . "'>Modifier ce rapport</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Aucun rapport trouvé à la date $date_rapport.";
    }
} else {
    // Rediriger ou afficher un message d'erreur si le formulaire n'a pas été soumis
    header('Location: v_modifier_rapport.php'); // Rediriger vers la page de sélection de la date
}
?>

</body>
</html>
