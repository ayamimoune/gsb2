<?php
session_start();

if (!isset($_SESSION["id_locataire"]) || !isset($_SESSION["nomLocataire"])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm_demande"])) {
    // Récupérez les données du formulaire
    $nom = $_SESSION["nomLocataire"];
    $prenom = $_SESSION["prenomLocataire"]; // Si disponible dans la session
    $telephone = $_SESSION["telephoneLocataire"]; // Si disponible dans la session
    $mail = $_SESSION["mailLocataire"]; // Si disponible dans la session
    $message = "Bonjour, je souhaite demander cet appartement.";
    $idAppart = $_POST["appartement_id"];

    // Créez une instance de la classe Demande
    include_once "../modele/demande.php";
    $demande = new Demande($nom, $prenom, $telephone, $mail, $message, $idAppart);

    // Enregistrez la demande dans la base de données
    $result = $demande->enregistrerDemande();

    if ($result) {
        // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
        header("Location: tableau_de_bord_locataire.php?demande_envoyee=true");
        exit();
    } else {
        // Gérez l'échec de l'enregistrement de la demande
        // Peut-être afficher un message d'erreur à l'utilisateur
        header("Location: tableau_de_bord_locataire.php?error=demande_echec");
        exit();
    }
}
?>
