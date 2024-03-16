<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Recherche de médecin</title>
    <meta name="Author" content="Votre Nom">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
    <h1>Recherche de médecin</h1>
    <form method="POST" action="../controleurs/c_recherche_medecin.php" enctype="application/x-www-form-urlencoded">
        <fieldset>
            <label for="nom_medecin">Entrez le début du nom du médecin :</label>
            <input type="text" name="nom_medecin" id="nom_medecin" required>
            <input type="submit" value="Rechercher">
        </fieldset>
    </form>
    <ul>
<li><a href='../vues/v_acceuil.php'>Retour</a></li>
</ul>
</body>
</html>
