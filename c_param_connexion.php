<?php
// paramètres de connexion, à changer en fonction du serveur et de la base utilisée
   $monserveur = "localhost";	// adresse du serveur sql que vous utilisez. ex : "sql.free.fr" ; "localhost" sur WAMP 
   $mabase="gsb2";	// nom de la base ;suivant ce que vous avez créé comme base dans WAMP)
   $monlogin = "root";	// login de la base de données. "root" sur WAMP en local	
   $monpass = "";		// mot de passe de la base de données. vide sur WAMP en local


try{
    $lien_base = new PDO("mysql:host=$monserveur;dbname=$mabase", $monlogin, $monpass, 
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	$lien_base->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>