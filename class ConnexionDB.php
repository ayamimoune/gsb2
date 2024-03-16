<?php
class ConnexionDB 
{
    private static $instance = null;
    private $connexion;

    // Informations de connexion (déplacées en dehors du constructeur)
    private $dbHost = 'localhost';
    private $dbName = 'gsb2';
    private $dbUser = 'root';
    private $dbPassword = '';

    // Méthode statique pour récupérer l'instance de la connexion (singleton)
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnexionDB();
        }
        return self::$instance;
    }

    private function __construct() // crée la connexion
    {
        // On appelle le constructeur de la classe PDO
        try {
            $this->connexion = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8", $this->dbUser, $this->dbPassword);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer la connexion
    public function getConnexion()
    {
        return $this->connexion;
    }
}
?>
