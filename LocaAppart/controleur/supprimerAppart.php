<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    header("Location: connexion.php");
    exit();
}

// Vérifier si l'identifiant de l'appartement à supprimer est fourni dans l'URL
if (isset($_GET["id_appart"]) && !empty($_GET["id_appart"])) {
    $id_appartement = $_GET["id_appart"];

    // Inclure le modèle pour accéder à la base de données des appartements
    include_once "../modele/appartementBD.php";

    // Créer une instance de la classe appartementBD
    $appartementBD = new appartementBD();

    // Supprimer l'appartement en utilisant l'identifiant fourni
    $suppressionReussie = $appartementBD->suppAppart($id_appartement);

    // Vérifier si la suppression a réussi
    if ($suppressionReussie) {
        // Rediriger l'utilisateur vers le tableau de bord avec un message de succès
        header("Location: ../vue/tableau_de_bord_proprietaire.php?success=appart_supprime");
        exit();
    } else {
        // Rediriger avec un message d'erreur si la suppression a échoué
        header("Location: ../vue/tableau_de_bord_proprietaire.php?error=suppression_echouee");
        exit();
    }
} else {
    // Rediriger si l'identifiant de l'appartement à supprimer n'est pas valide
    header("Location: ../vue/tableau_de_bord_proprietaire.php?error=id_appart_non_valide");
    exit();
}
?>
