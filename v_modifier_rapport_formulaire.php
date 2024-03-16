<?php
include("v_zoneLogin.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Modifier un rapport</title>
    <meta name="Author" content="Aya Mimoune">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
    <h1>Modifier un rapport</h1>
    <form method="POST" action="../controleurs/c_modif_rapport_traitement.php" enctype="application/x-www-form-urlencoded">
        <fieldset>

        <label for="id_medecin">Sélectionnez un médecin :</label>
        <select name="id_medecin" id="id_medecin" required>
        <?php
        include('../controleurs/c_param_connexion.php');

        // Requête pour récupérer les médecins
        $sqlMedecin = "SELECT id_medecin, nom FROM medecin";
        $resultatMedecin = $lien_base->query($sqlMedecin);

        // Afficher la liste déroulante des médecins
        if ($resultatMedecin->rowCount() > 0) {
            while ($rowMedecin = $resultatMedecin->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $rowMedecin["id_medecin"] . "'>" . $rowMedecin["nom"] . "</option>";
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
        <textarea name="bilan" id="bilan" rows="4" required></textarea><br><br>

        <label for="id_medicament">Sélectionnez un médicament :</label>
        <select name="id_medicament" id="id_medicament" required>
        <?php
        // Requête pour récupérer les médicaments
        $sqlMedicament = "SELECT id_medicament, nomCommercial FROM medicament";
        $resultatMedicament = $lien_base->query($sqlMedicament);

        // Afficher la liste déroulante des médicaments
        if ($resultatMedicament->rowCount() > 0) {
            while ($rowMedicament = $resultatMedicament->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $rowMedicament["id_medicament"] . "'>" . $rowMedicament["nomCommercial"] . "</option>";
            }
        } else {
            echo "<option value=''>Aucun médicament trouvé</option>";
        }
        ?>
        </select><br><br>

        <label for="quantite">Saisissez la quantité :</label>
        <input type="text" name="quantite" id="quantite" required><br><br>

        <!-- Champ caché pour stocker l'ID du rapport que le visiteur souhaite modifier -->
        <input type="hidden" name="id_rapport" value="<?php echo $id_rapport; ?>">

        <input type="submit" value="Valider">
    </fieldset>
    </form>
</body>
</html>
