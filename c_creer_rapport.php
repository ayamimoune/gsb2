<?php
// Inclure les fichiers des classes et le fichier de configuration de la base de données
include_once ('../controleurs/c_param_connexion.php');
include_once ('../modeles/class_Medecin.php');
include_once ('../modeles/class_Visiteur.php');
include_once ('../modeles/class_Medicament.php');
include_once ('../modeles/class_Rapport.php');
include_once ('../modeles/class_Offrir.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $date_rapport = isset($_POST['date_rapport']) ? $_POST['date_rapport'] : '';
    $motif = isset($_POST['motif']) ? $_POST['motif'] : '';
    $bilan = isset($_POST['bilan']) ? $_POST['bilan'] : '';
    $id_medecin_1= isset($_POST['id_medecin_1']) ? $_POST['id_medecin_1'] : '';
    $id_visiteur_1= isset($_POST['id_visiteur_1']) ? $_POST['id_visiteur_1'] : '';
    $id_medicament = isset($_POST['id_medicament']) ? $_POST['id_medicament'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : '';

    // Créer un objet Rapport en utilisant les données du formulaire
    $rapport = new Rapport($date_rapport, $motif, $bilan, $id_medecin_1, $id_visiteur_1, $id_medicament);

    // Ajouter le rapport à la base de données
    if ($rapport->creer_rapport($lien_base)) { 
        // Rediriger l'utilisateur vers une page de confirmation
        header('Location: ../vues/v_confirmation_rapport.php');
        exit();
    } else {
        // En cas d'échec, rediriger l'utilisateur vers une page d'erreur
        header('Location: ../vues/v_erreur.php');
        exit();
    }
} else {
    // Si le formulaire n'a pas été soumis, vous pouvez rediriger l'utilisateur ou afficher un message d'erreur
    header('Location: ../vues/v_erreur.php');
    exit();
}
?>
