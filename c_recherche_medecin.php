<?php
include_once '../controleurs/c_param_connexion.php';
include_once '../modeles/class_Medecin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_medecin = $_POST['nom_medecin'];

    // Effectuer la recherche des médecins par le début de leur nom
    $resultat = Medecin::rechercherMedecinParNom($nom_medecin);

    // Afficher les résultats ou rediriger vers une page de résultat
    if ($resultat) {
        include('../vues/v_resultat_recherche_medecin.php');
    } else {
        include('../vues/v_erreur.php');
    }
}
?>
