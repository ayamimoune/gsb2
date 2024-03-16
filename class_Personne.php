<?php

// Classe mère Personne
class Personne {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $mail;
    protected $telephone;
    protected $role; // Nouveau champ pour indiquer le rôle (propriétaire, locataire, visiteur)
    protected $mdp;

    public function __construct($id, $nom, $prenom, $mail, $telephone, $role, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->role = $role;
        $this->mdp = $mdp;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getRole() {
        return $this->role;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function connexion($mail, $mdp) {
        global $lien_base; // Assurez-vous que $lien_base est correctement défini dans votre script de connexion.
    
        // Requête SQL pour vérifier l'authentification
        $sql = "SELECT * FROM personne WHERE mail = :mail AND mdp = :mdp";
        
        try {
            $stmt = $lien_base->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':mdp', $mdp);
    
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                // Authentification réussie, redirigez vers la page appropriée
                if ($result['role'] == 'proprietaire') {
                    header("Location: ../vues/proprietaire/proprio.php");
                    exit;
                } elseif ($result['role'] == 'locataire') {
                    header("Location: ../vues/accueil.php");
                    exit;
                }
            } else {
                // Échec de l'authentification, redirigez avec un message d'erreur
                echo 'L\'identifiant ou le mot de passe est incorrect.';
            }
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion à la base de données
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}

?>
