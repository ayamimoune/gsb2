<?php
include_once '../controleurs/c_param_connexion.php';
include_once '../modeles/class_Visiteur.php';


$confirmation = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $date_embauche = $_POST['date_embauche'];

    $visiteur = new Visiteur($nom, $prenom, $email, $login, $mdp, $adresse, $tel, $cp, $ville, $date_embauche);

    if ($visiteur->inscription()) {
        $confirmation = "Inscription réussie!";
        echo"<li><a href='../vues/v_connexion.php'>Connexion</a></li>";
    } else {
        $confirmation = "Erreur lors de l'inscription.";
    }    
}
echo $confirmation;

?>
