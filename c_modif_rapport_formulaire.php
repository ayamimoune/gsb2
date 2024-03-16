<?php
include_once 'c_param_connexion.php'; // Inclure le fichier de connexion à la base de données
include_once '../css/style.css';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id_rapport = $_POST['id_rapport'];
    $date_rapport = $_POST['date_rapport'];
    $motif = $_POST['motif'];
    $bilan = $_POST['bilan'];

    // Assurez-vous de valider et de sécuriser les variables

    // Effectuer la mise à jour dans la base de données
    try {
        $sql = "UPDATE rapport SET date_rapport = :date_rapport, motif = :motif, bilan = :bilan WHERE id_rapport = :id_rapport";
        $stmt = $lien_base->prepare($sql);
        $stmt->bindParam(':date_rapport', $date_rapport);
        $stmt->bindParam(':motif', $motif);
        $stmt->bindParam(':bilan', $bilan);
        $stmt->bindParam(':id_rapport', $id_rapport);
        $stmt->execute();

        // Rediriger l'utilisateur vers une page de confirmation
        header('Location: v_confirmation_modification.php');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, rediriger l'utilisateur vers une page d'erreur
        error_log("Erreur lors de la modification du rapport : " . $e->getMessage());
        header('Location: v_erreur.php');
        exit();
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger l'utilisateur vers une page d'erreur
    header('Location: v_erreur.php');
    exit();
}
?>
