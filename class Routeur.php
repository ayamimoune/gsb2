<?php
class Routeur
{
	private $_action;
	private $_table;
	private $_route; // chemin du fichier contrôleur
	
	public function __construct()
	{	
		$this->_action = '?'; 
		$this->_route = '?'; 
		$this->_table = '?'; 
		$this->_tri = '?'; 
		$this->_valeurcherchee='?';
	}
	
	private function set_chemin_controleur()
	{
		switch($this->_action) {
			case 'init' : 
				{
					$this->_route = 'c_Accueil.php?type=init';
					break;
				}
			case 'login' : 
				{
					$this->_route = 'c_Accueil.php?type=login';
					break;
				}	
			case 'controleLogin' : 
				{
					$this->_route = 'c_Login.php';
					break;
				}				
			case 'liste' : 
				{
					
					$this->_route = 'c_Liste.php?table='.$this->_table.'&tri='.$this->_tri;
					break;
				}
			case 'recherche' : 
				{
					
					$this->_route = 'v_Recherche.php';
					break;
				}			
			case 'rechercheGenerale' : 
				{
					
					$this->_route = 'c_Recherche.php';
					break;
				}	
			default:
			{ 	$this->_route = 'c_Accueil.php?type=erreur' ; }
		}
	}
	
	public function rediriger($action)
	{
		$this->_action = $action;
		if(isset($_SESSION['donnees_get']) ) // récupération données dans session
		{
			$donnees_get = array();
			$donnees_get=$_SESSION['donnees_get'];
			$this->_table=$donnees_get['table'];
			$this->_tri=$donnees_get['tri'];
		}
		if(isset($_SESSION['donnees_postees']) ) // récupération données dans session
		{
			$donnees_postees = array();
			$donnees_postees=$_SESSION['donnees_postees'];
			$this->_valeurcherchee=$donnees_postees['valeurcherchee'];
			$this->_tri=$donnees_get['tri'];
		}
	
		$this->set_chemin_controleur();
		$url = $this->_route;
		header("Location: $url"); // redirige
		die ("erreur inattendue");
	}
}
?>