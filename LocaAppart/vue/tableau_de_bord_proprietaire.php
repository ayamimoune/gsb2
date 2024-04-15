<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    header("Location: connexion.php");
    exit();
}

include_once "../modele/proprietaireBD.php";
include_once "../modele/appartementBD.php";

$proprietaireBD = new proprietaireBD();
$appartementBD = new appartementBD();

$id_proprietaire = $_SESSION["id_proprietaire"];
$proprietaire = $proprietaireBD->getProprioById($id_proprietaire);
$appartements = $appartementBD->getAppartByIdProprio($id_proprietaire);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../proprietaire.css">
    <title>Tableau de Bord Propriétaire</title>
</head>
<body>
    <div class="header">
        <h2>Tableau de Bord Propriétaire</h2>
        <div class="profile">
            <a href="./ajouterAppartement.php">Ajouter un Appartement</a>
            <a href="./gererdemende.php">Gérer les demandes</a>
            <a href="profilProprietaire.php">Mon Profil</a>
        </div>
    </div>

    <div class="content">
        <h3>Mes Appartements</h3>
        <?php if ($appartements) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Type</th>
                        <th>Loyer</th>
                        <th>Date Libre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appartements as $appartement) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appartement->getIDAppart()); ?></td>
                            <td><?php echo htmlspecialchars($appartement->getAdresse()); ?></td>
                            <td><?php echo htmlspecialchars($appartement->getCP()); ?></td>
                            <td><?php echo htmlspecialchars($appartement->getTypeAppart()); ?></td>
                            <td><?php echo htmlspecialchars($appartement->getLoyer()); ?></td>
                            <td><?php echo htmlspecialchars($appartement->getDateLibre()); ?></td>
                            <td>
                                <button onclick="toggleEditMode(<?php echo $appartement->getIDAppart(); ?>)">Modifier</button>
                                <a href="../controleur/supprimerAppart.php?id_appart=<?php echo $appartement->getIDAppart(); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet appartement ?')">Supprimer</a>
                                <form id="form_<?php echo $appartement->getIDAppart(); ?>" style="display:none;" action="../controleur/modifierAppart.php" method="post">
                                    <input type="hidden" name="id_appart" value="<?php echo $appartement->getIDAppart(); ?>">
                                    <label for="adresse">Adresse:</label>
                                    <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($appartement->getAdresse()); ?>"><br>
                                    <label for="cp">Code Postal:</label>
                                    <input type="text" id="cp" name="cp" value="<?php echo htmlspecialchars($appartement->getCP()); ?>"><br>
                                    <label for="type_appart">Type d'appartement:</label>
                                    <input type="text" id="type_appart" name="type_appart" value="<?php echo htmlspecialchars($appartement->getTypeAppart()); ?>"><br>
                                    <label for="loyer">Loyer:</label>
                                    <input type="text" id="loyer" name="loyer" value="<?php echo htmlspecialchars($appartement->getLoyer()); ?>"><br>
                                    <label for="date_libre">Date de Disponibilité:</label>
                                    <input type="text" id="date_libre" name="date_libre" value="<?php echo htmlspecialchars($appartement->getDateLibre()); ?>"><br>
                                    <input type="submit" value="Enregistrer">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun appartement trouvé.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleEditMode(id_appartement) {
            const form = document.getElementById('form_' + id_appartement);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
