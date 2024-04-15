<?php
include_once "locataire.php";
include_once "connexionPDO.php";

class locataireBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addLocataire($locataire)
    {
        $mdp = $locataire->getMDPLoc();
        $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);

        try {
            $req = $this->conn->prepare("INSERT INTO locataires (id_locataire, nomLoc, prenomLoc, mailLoc, mdpLoc, dateNaiss, telLoc) values (:id_locataire, :nomLoc, :prenomLoc, :mailLoc, :mdpLoc, :dateNaiss, :telLoc)");
            $req->bindValue(':id_locataire', $locataire->getIdLoc());
            $req->bindValue(':nomLoc', $locataire->getNomLoc());
            $req->bindValue(':prenomLoc', $locataire->getPrenomLoc());
            $req->bindValue(':mailLoc', $locataire->getMailLoc());
            $req->bindValue(':mdpLoc', $mdpHash);
            $req->bindValue(':dateNaiss', $locataire->getAdresse());
            $req->bindValue(':telLoc', $locataire->getTelLoc());
            $req->execute();

            // Récupérer l'ID de la personne ajoutée
            $lastInsertedID = $this->conn->lastInsertId();
        
            // Retourner l'objet personne avec l'ID attribué
            return $this->getLocataireByID($lastInsertedID);

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage();
                die();
            }
    }

    public function getLocataires()
{
    try {
        $req = $this->conn->prepare("SELECT * from locataires");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        if ($resultat) {
            foreach ($resultat as $ligne ) {
                $locataire = new locataire(
                    $ligne["id_locataire"],
                    $ligne["nomLoc"],
                    $ligne["prenomLoc"],
                    $ligne["mailLoc"],
                    $ligne["mdpLoc"],
                    $ligne["dateNaiss"],
                    $ligne["telLoc"]
                );
                $locataires[] = $locataire;
            }
            return $locataire;
        }
        else{
            return null;
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

public function getLocataireById($id_locataire)
{
    try{
        $req = $this->conn->prepare("SELECT * FROM locataires WHERE id_locataire=:id_locataire");
        $req->bindValue(":id_locataire", $id_locataire);

        $req->execute();

        $resultat=$req->fetch(PDO::FETCH_ASSOC);
        if($resultat){
            $locataire = new locataire(
                $resultat["id_locataire"],
                $resultat["nomLoc"],
                $resultat["prenomLoc"],
                $resultat["mailLoc"],
                $resultat["mdpLoc"],
                $resultat["dateNaiss"],
                $resultat["telLoc"]
            );
            return $locataire;
        }
        else{
            return null;
        }

    } catch(PDOException $e){
        print "Erreur !: ". $e->getMessage();
        die();
    }
}

public function getLocataireByLogon($mailLoc)
    {
        try {
            $req = $this->conn->prepare("SELECT * from proprietaires where mailLoc=:mailLoc");
            $req->bindValue(':mailLoc', $mailLoc);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);

            if($resultat){
                return new locataire(
                    $resultat["id_locataire"],
                    $resultat["nomLoc"],
                    $resultat["prenomLoc"],
                    $resultat["mailLoc"],
                    $resultat["mdpLoc"],
                    $resultat["dateNaiss"],
                    $resultat["telLoc"]
                );
            }
            else{
                return null;
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

}
?>