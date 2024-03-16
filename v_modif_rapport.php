<?php
include('../controleurs/c_param_connexion.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd"><html>

<head>
    <title>Modifier un rapport</title>
    <meta name="Author" content="Aya Mimoune">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>

<body>
    <h1>Modifier un rapport</h1>

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
    <form method="POST" action="../controleurs/c_modif_rapport.php" enctype="application/x-www-form-urlencoded">
        <fieldset>
            <label for="date_rapport">Sélectionnez une date:</label>
            <select name="date_rapport" id="date_rapport" required>
                <?php
                include('../controleurs/c_param_connexion.php');

                // Requête pour récupérer les dates des rapports
                $sql = "SELECT date_rapport FROM rapport";
                $resultat = $lien_base->query($sql);

                // Afficher la liste déroulante des dates
                if ($resultat->rowCount() > 0) {
                    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["date_rapport"] . "'>" . $row["date_rapport"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucune date disponible</option>";
                }
                ?>
            </select>
        </fieldset>
        <input type="submit" value="Modifier">
    </form>
</body>

</html>
