<?php

class ChoixAccueil {
	
	private $_type ; // type de la vue à afficher
	private $_nomfic ; // nom du fichier de la vue
	
	public function __construct($type = '?')
	{	
		$this->_type = $type; 
	}
	
	public function afficher()
	{
		
		if($this->_type == '?')
		{
			header("Location: index.php?action=erreur");// ou erreur 404
		}
		else
		{
		$this->get_nom_fichier();
		header("Location: $this->_nomfic");
		}
	}
	private function get_nom_fichier()
	{
		// norme = v_  + action/type + .html	
		$this->_nomfic = "v_". $this->_type . ".php";
	}
	
}