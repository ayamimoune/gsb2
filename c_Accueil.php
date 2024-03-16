<?php
// cet exemple est volontairement ultra-simplifié
include ('class ChoixAccueil.php');
$type='?';
if (isset($_GET['type']))
{
	$type = $_GET['type'];
}
// la classe 
$monAccueil = new ChoixAccueil($type);  // peut être "init" ou "login" ou "erreur"
$monAccueil->afficher();
?>