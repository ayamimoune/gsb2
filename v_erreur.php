
<html>
<head>
    <title>Annuaire : Affichage d'erreur</title>
    <meta name="Author" content="Aya Mimoune">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- appel feuille de style -->
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>

<?php
// Vérifier si la clé "erreur" existe dans le tableau $_GET
if (isset($_GET["erreur"])) {
    $erreur = $_GET["erreur"];
    echo "<p class='erreur'>$erreur</p>";
} else {
    echo "<p class='erreur'>Erreur inconnue</p>";
}

?>

<!-- Lien pour retourner à la page initiale -->
<a href="../vues/v_gerer_rapport.php">Retour accueil</a>

</body>
</html>
