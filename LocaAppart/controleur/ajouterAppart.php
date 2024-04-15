<?php
// Démarrer la session pour accéder aux données de session
session_start();

// Vérifier si l'utilisateur est connecté en tant que propriétaire
if (!isset($_SESSION["id_proprietaire"])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit(); // Arrêter l'exécution du script après la redirection
}

// Inclure les fichiers nécessaires
$racine = ".."; // À adapter selon l'arborescence de vos fichiers
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/appartement.php";

// Récupération de l'ID du propriétaire connecté
$proprietaireBD = new proprietaireBD();
$id_proprietaire = $_SESSION["id_proprietaire"];

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si tous les champs du formulaire sont définis et non vides
    if (!empty($_POST["adresse"]) && !empty($_POST["cp"]) && !empty($_POST["type_appart"]) && !empty($_POST["num_bat"]) && !empty($_POST["num_appart"]) && !empty($_POST["loyer"]) && !empty($_POST["date_libre"])) {
        // Récupération des données du formulaire
        $adresse = $_POST["adresse"];
        $cp = $_POST["cp"];
        $type_appart = $_POST["type_appart"];
        $num_bat = $_POST["num_bat"];
        $num_appart = $_POST["num_appart"];
        $loyer = $_POST["loyer"];
        $date_libre = $_POST["date_libre"];

        // Création d'un nouvel objet appartement
        $appartement = new appartement(NULL, $adresse, $cp, $type_appart, $num_bat, $num_appart, $loyer, $date_libre, $id_proprietaire);

        // Ajout de l'appartement dans la base de données
        $appartementBD = new appartementBD();
        $nouvelAppartement = $appartementBD->addAppart($appartement);

        // Vérification si l'ajout a réussi
        if ($nouvelAppartement) {
            echo "Appartement ajouté avec succès !";
            // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message de succès
        } else {
            echo "Erreur : ajout non réussi. Veuillez réessayer.";
            // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message d'erreur
        }
    } else {
        echo "Veuillez renseigner tous les champs.";
        // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message d'erreur
    }
}

// Inclusion de la vue correspondante
$titre = "Ajouter une Location";
include "../vue/ajouterAppartement.php";
?>
