<?php
class Medecin {
    private $id_medecin;
    private $nom;
    private $prenom;
    private $adresse;
    private $cp;
    private $ville;
    private $tel;
    private $specialiteComplementaire;
    private $departement;
    private $mail;
    private $mdp;

    public function __construct($id_medecin, $nom, $prenom, $adresse, $cp, $ville, $tel, $specialiteComplementaire, $departement, $mail, $mdp) {
        $this->id_medecin = $id_medecin;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->tel = $tel;
        $this->specialiteComplementaire = $specialiteComplementaire;
        $this->departement = $departement;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }

       // Accesseurs
       public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getSpecialiteComplementaire() {
        return $this->specialiteComplementaire;
    }

    public function getMail() {
        return $this->mail;
    }
    
	

    public static function rechercherMedecinParNom($nom) {
        try {
            global $lien_base;
    
            $sql = "SELECT nom, prenom, tel, specialiteComplementaire, mail FROM medecin WHERE nom LIKE :nom";
            $stmt = $lien_base->prepare($sql);
            $stmt->bindValue(':nom', $nom . "%");
            $stmt->execute();
    
            // Retourner le résultat sous forme d'objet Medecin
            return $stmt->fetch(PDO::FETCH_PROPS_LATE, 'Medecin');

        } catch (PDOException $e) {
            // Gestion des erreurs
            error_log("Erreur lors de la recherche des médecins : " . $e->getMessage());
            return false;
        }
    }
    
    
}
?>