<?php
include_once('../modeles/class_Visiteur.php');
include_once('../modeles/class_Medecin.php');
include_once('../modeles/class_Offrir.php');
include_once('../modeles/class_Medicament.php');
include_once('../controleurs/c_param_connexion.php');

class Rapport {
    private $date_rapport;
    private $motif;
    private $bilan;
    private $id_medecin_1;
    private $id_visiteur_1;
    private $id_medicament;

    public function __construct($date_rapport, $motif, $bilan, $id_medecin_1, $id_visiteur_1, $id_medicament) {
        $this->date_rapport = $date_rapport;
        $this->motif = $motif;
        $this->bilan = $bilan;
        $this->id_medecin_1 = $id_medecin_1;
        $this->id_visiteur_1 = $id_visiteur_1;
        $this->id_medicament = $id_medicament;

    }

    // Accesseurs
    public function getDateRapport() {
        return $this->date_rapport;
    }

    public function getMotif() {
        return $this->motif;
    }
    
    public function getBilan() {
        return $this->bilan;
    }
    public function getIdMedecin() {
        return $this->id_medecin_1;
    }
    public function getIdVisiteur() {
        return $this->id_visiteur_1;
    }
    public function getIdMedicament() {
        return $this->medicament;
    }

    public function creer_rapport(PDO $lien_base) {
        $sql = "INSERT INTO rapport (date_rapport, motif, bilan, id_medecin_1, id_visiteur_1, id_medicament) 
                VALUES (:date_rapport, :motif, :bilan, :id_medecin_1, :id_visiteur_1, id_medicament)";
    
        try {
            $stmt = $lien_base->prepare($sql);
            $stmt->bindParam(':date_rapport', $this->date_rapport);
            $stmt->bindParam(':motif', $this->motif);
            $stmt->bindParam(':bilan', $this->bilan);
            $stmt->bindParam(':id_medecin_1', $this->id_medecin_1);
            $stmt->bindParam(':id_visiteur_1', $this->id_visiteur_1);
            $stmt->bindParam(':id_medicament', $this->id_medicament);

    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
