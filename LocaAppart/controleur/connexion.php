<?php
// Inclure les classes nécessaires avec les bons chemins
include_once "../modele/proprietaireBD.php";
include_once "../modele/locataireBD.php";
include_once "../modele/connexionPDO.php";
include_once "../modele/proprietaire.php";
include_once "../modele/locataire.php";

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    // Récupérer les valeurs du formulaire
    $login = $_POST["username"];
    $mdp = $_POST["password"];

    // Créer une instance de proprietaireBD pour gérer les opérations liées aux propriétaires
    $proprietaireBD = new ProprietaireBD();
    // Créer une instance de locataireBD pour gérer les opérations liées aux locataires
    $locataireBD = new LocataireBD();

    // Vérifier si le login correspond à un propriétaire
    $proprietaire = $proprietaireBD->getProprioByLogin($login);

    // Vérifier si le login correspond à un locataire si le propriétaire n'a pas été trouvé
    if (!$proprietaire) {
        $locataire = $locataireBD->getLocataireByLogin($login);
    }

    // Vérifier l'utilisateur trouvé (propriétaire ou locataire)
    if ($proprietaire || $locataire) {
        // Vérifier le mot de passe hashé
        if ($proprietaire) {
            $utilisateur = $proprietaire;
            $mdpUtilisateur = $utilisateur->getMdpProprio(); // Utiliser getMdpProprio pour obtenir le mot de passe du propriétaire
        } else {
            $utilisateur = $locataire;
            $mdpUtilisateur = $utilisateur->getMdpLocataire(); // Utiliser getMdpLocataire pour obtenir le mot de passe du locataire
        }

        if (password_verify($mdp, $mdpUtilisateur)) {
            // Authentification réussie
            session_start();
            if ($proprietaire) {
                $_SESSION["id_proprietaire"] = $proprietaire->getIDProprio();
                $_SESSION["nomProprio"] = $proprietaire->getNomProprio();
                // Rediriger le propriétaire vers le tableau de bord propriétaire
                header("Location: ../vue/tableau_de_bord_proprietaire.php");
                exit();
            } else {
                $_SESSION["id_locataire"] = $locataire->getIdLocataire();
                $_SESSION["nomLocataire"] = $locataire->getNomLocataire();
                // Rediriger le locataire vers le tableau de bord locataire
                header("Location: ../vue/tableau_de_bord_locataire.php");
                exit();
            }
        } else {
            // Mot de passe incorrect
            $error = "Mot de passe incorrect.";
            include "../vue/connexion.php";
        }
    } else {
        // Identifiant incorrect
        $error = "Identifiant incorrect.";
        include "../vue/connexion.php";
    }
} else {
    // Afficher le formulaire de connexion par défaut
    include "../vue/connexion.php";
}
?>
