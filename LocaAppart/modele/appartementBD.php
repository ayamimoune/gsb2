<?php
include_once "appartement.php";
include_once "connexionPDO.php";

class appartementBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addAppart($appartement)
    {
        try {
            $req = $this->conn->prepare("INSERT INTO apparts(id_appart, adresse, cp, type_appart, num_bat, num_appart, loyer, date_libre, id_proprietaire) values (:id_appart, :adresse, :cp, :type_appart, :num_bat, :num_appart, :loyer, :date_libre, :id_proprietaire)");
            $req->bindValue(':id_appart', $appartement->getIDAppart());
            $req->bindValue(':adresse', $appartement->getAdresse());
            $req->bindValue(':cp', $appartement->getCP());
            $req->bindValue(':type_appart', $appartement->getTypeAppart());
            $req->bindValue(':num_bat', $appartement->getNumBat());
            $req->bindValue(':num_appart', $appartement->getNumAppart());
            $req->bindValue(':loyer', $appartement->getLoyer());
            $req->bindValue(':date_libre', $appartement->getDateLibre());
            $req->bindValue(':id_proprietaire', $appartement->getIdProprio());
            $req->execute();

            // Récupérer l'ID de la personne ajoutée
            $lastInsertedID = $this->conn->lastInsertId();
    
            // Retourner l'objet personne avec l'ID attribué
            return $this->getAppartByID($lastInsertedID);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }


    public function getApparts()
    {
        try {
            $req = $this->conn->prepare("SELECT * from apparts");
            $req->execute();
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

            if ($resultat) {
                foreach ($resultat as $ligne ) {
                    $appart = new appartement(
                        $ligne["id_appart"],
                        $ligne["adresse"],
                        $ligne["cp"],
                        $ligne["type_appart"],
                        $ligne["num_bat"],
                        $ligne["num_appart"],
                        $ligne["loyer"],
                        $ligne["date_libre"],
                        $ligne["id_proprietaire"]

                    );
                    $apparts[] = $appart;
                }
                return $apparts;
            }
            else{
                return null;
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getAppartById($id_appart)
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM apparts WHERE id_appart=:id_appart");
            $req->bindValue(":id_appart", $id_appart);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($resultat) {
                $appart = new appartement(
                    $resultat["id_appart"],
                    $resultat["adresse"],
                    $resultat["cp"],
                    $resultat["type_appart"],
                    $resultat["num_bat"],
                    $resultat["num_appart"],
                    $resultat["loyer"],
                    $resultat["date_libre"],
                    $resultat["id_proprietaire"]
                );
                return $appart;
            } else {
                return null;
            }
    
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    

    public function getAppartByIdProprio($id_proprietaire)
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM apparts WHERE id_proprietaire=:id_proprietaire");
            $req->bindValue(":id_proprietaire", $id_proprietaire);
            $req->execute();
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    
            if ($resultat) {
                $apparts = [];
                foreach ($resultat as $ligne) {
                    // Créer un nouvel objet appartement sans passer l'ID du propriétaire
                    $appart = new appartement(
                        $ligne["id_appart"],
                        $ligne["adresse"],
                        $ligne["cp"],
                        $ligne["type_appart"],
                        $ligne["num_bat"],
                        $ligne["num_appart"],
                        $ligne["loyer"],
                        $ligne["date_libre"],
                        $ligne["id_proprietaire"]
                    );
                    $apparts[] = $appart;
                }
                return $apparts;
            } else {
                return null;
            }
    
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    

    public function suppAppart($id_appartement) {
        try {
            $req = $this->conn->prepare("DELETE FROM apparts WHERE id_appart=:id_appartement");
            $req->bindValue(":id_appartement", $id_appartement);
            $req->execute();
            // Retourner true si la suppression réussit
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, afficher le message d'erreur
            echo "Erreur lors de la suppression de l'appartement : " . $e->getMessage();
            return false;
        }
    }
    

    public function modifierAppart($appartement)
    {
        try {
            $req = $this->conn->prepare("UPDATE apparts SET adresse = :adresse, cp = :cp, type_appart = :type_appart, loyer = :loyer, date_libre = :date_libre WHERE id_appart = :id_appart");
    
            $req->bindValue(':adresse', $appartement->getAdresse());
            $req->bindValue(':cp', $appartement->getCP());
            $req->bindValue(':type_appart', $appartement->getTypeAppart());
            $req->bindValue(':loyer', $appartement->getLoyer());
            $req->bindValue(':date_libre', $appartement->getDateLibre());
            $req->bindValue(':id_appart', $appartement->getIDAppart());
    
            $req->execute();
    
            // Vérifier le nombre de lignes affectées par la requête UPDATE
            $rowCount = $req->rowCount();
    
            if ($rowCount > 0) {
                // Retourner l'appartement mis à jour
                return $this->getAppartById($appartement->getIDAppart());
            } else {
                // Aucune ligne mise à jour
                return null;
            }
        } catch (PDOException $e) {
            // En cas d'erreur, afficher le message d'erreur
            print "Erreur lors de la mise à jour de l'appartement : " . $e->getMessage();
            return null;
        }
    }
    

}
?>