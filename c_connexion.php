<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../controleurs/c_param_connexion.php'; // Assurez-vous que ce fichier existe et contient les paramètres de connexion à la base de données.
require_once '../modeles/class_Personne.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    // Créer une instance de la classe Personne avec les identifiants fournis
    $personne = new Personne(null, null, null, $mail, null, null, $mdp);

    // Connexion avec les identifiants fournis
    $personne->connexion($mail, $mdp);
} else {
    // Rediriger vers la page de connexion si le formulaire n'a pas été soumis
    header("Location: index.php");
    exit;
}
?>
