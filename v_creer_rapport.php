<?php
include('../controleurs/c_param_connexion.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Créer un nouveau rapport</title>
    <meta name="Author" content="Aya Mimoune">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
    <h1>Créer un nouveau rapport</h1>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href='../vues/v_gerer_rapport.php'>Retour</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <form method="POST" action="../controleurs/c_creer_rapport.php" enctype="application/x-www-form-urlencoded">
        <fieldset>

        <label for="id_medecin">Sélectionnez un médecin :</label>
        <select name="id_medecin" id="id_medecin" required>
        <?php


        // Requête pour récupérer les médecins
        $sql = "SELECT id_medecin, nom FROM medecin";
        $resultat = $lien_base->query($sql);

        // Afficher la liste déroulante des médecins
        if ($resultat->rowCount() > 0) {
            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row["id_medecin"] . "'>" . $row["nom"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun médecin trouvé</option>";
        }
        ?>
        </select><br><br>


        <label for="date_rapport">Date du rapport :</label>
        <input type="date" name="date_rapport" id="date_rapport" required><br><br>

        <label for="motif">Motif de la visite :</label>
        <input type="text" name="motif" id="motif" required><br><br>

        <label for="bilan">Bilan de la visite :</label>
        <textarea name="text" id="bilan" rows="4" required></textarea><br><br>

        <label for="id_medicament">Sélectionnez un médicament :</label>
        <select name="id_medicament" id="id_medicament" required>
        <?php
 
        // Requête pour récupérer les médicaments
        $sql = "SELECT id_medicament, nomCommercial FROM medicament";
        $resultat = $lien_base->query($sql);

        // Afficher la liste déroulante des médicaments
        if ($resultat->rowCount() > 0) {
            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row["id_medicament"] . "'>" . $row["nomCommercial"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun médecin trouvé</option>";
        }
        ?>
        </select><br><br>

        <label for="quantite">Saisissez la quantité :</label>
        <input type="text" name="quantite" id="quantite" required><br><br>

        <input type="submit" value="Valider">
</fieldset>
</form>
</body>
</html>
