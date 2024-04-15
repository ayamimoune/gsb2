<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    header("Location: connexion.php");
    exit();
}

// Inclusion des fichiers nécessaires
include_once "../modele/proprietaireBD.php";
include_once "../modele/appartementBD.php";

// Récupération de l'ID du propriétaire connecté
$id_proprietaire = $_SESSION["id_proprietaire"];

// Vérification si le formulaire est soumis (modification d'un appartement)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_appart"])) {
    // Récupération des données du formulaire
    $id_appartement = $_POST["id_appart"];
    $adresse = $_POST["adresse"];
    $cp = $_POST["cp"];
    $type_appart = $_POST["type_appart"];
    $loyer = $_POST["loyer"];
    $date_libre = $_POST["date_libre"];

    // Création d'un nouvel objet Appartement avec les données mises à jour
    $appartement = new appartement(
        $id_appartement,
        $adresse,
        $cp,
        $type_appart,
        null, // num_bat non utilisé dans le formulaire de modification
        null, // num_appart non utilisé dans le formulaire de modification
        $loyer,
        $date_libre,
        $id_proprietaire
    );

    // Initialisation de l'objet appartementBD pour accéder à la base de données
    $appartementBD = new appartementBD();

    // Mise à jour de l'appartement dans la base de données
    $resultat = $appartementBD->modifierAppart($appartement);

    // Vérification si la mise à jour a réussi
    if ($resultat) {
        // Redirection vers la page appropriée après la modification
        header("Location: ../vue/tableau_de_bord_proprietaire.php");
        exit();
    } else {
        echo "Erreur : La modification de l'appartement a échoué. Veuillez réessayer.";
    }
}
?>
