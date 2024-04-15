<?php
// Inclure les classes nécessaires avec les bons chemins
include_once "../modele/proprietaireBD.php";
include_once "../modele/locataireBD.php";

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // Récupérer le rôle choisi

    // Valider et insérer les données dans la base de données
    if (!empty($nom) && !empty($prenom) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($login) && !empty($password) && !empty($role)) {
        // Créer une instance appropriée en fonction du rôle choisi
        if ($role === "proprietaire") {
            $proprietaireBD = new ProprietaireBD();
            // Insérer dans la table des propriétaires
            // Exemple : $proprietaireBD->registerProprietaire($nom, $prenom, $email, $login, $password);
        } elseif ($role === "locataire") {
            $locataireBD = new LocataireBD();
            // Insérer dans la table des locataires
            // Exemple : $locataireBD->registerLocataire($nom, $prenom, $email, $login, $password);
        }
        
        // Rediriger l'utilisateur vers une page de connexion
        header("Location: ../vue/connexion.php");
        exit();
    } else {
        // En cas d'erreur de validation, afficher un message d'erreur ou rediriger vers une autre page
        echo "Veuillez remplir tous les champs correctement.";
        // Inclure à nouveau le formulaire d'inscription avec un message d'erreur si nécessaire
        include "../vue/inscription.php";
    }
} else {
    // Afficher le formulaire d'inscription par défaut
    include "../vue/inscription.php";
}
?>
