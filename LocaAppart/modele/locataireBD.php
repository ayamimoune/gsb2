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
        $mdp = $locataire->getMdpLocataire(); // Utilisation de getMdpLocataire pour récupérer le mot de passe
        $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);

        try {
            $req = $this->conn->prepare("INSERT INTO locataire (nomLocataire, prenomLocataire, mailLocataire, telephoneLocataire, loginLocataire, mdpLocataire) VALUES (:nomLocataire, :prenomLocataire, :mailLocataire, :telephoneLocataire, :loginLocataire, :mdpLocataire)");
            $req->bindValue(':nomLocataire', $locataire->getNomLocataire());
            $req->bindValue(':prenomLocataire', $locataire->getPrenomLocataire());
            $req->bindValue(':mailLocataire', $locataire->getMailLocataire());
            $req->bindValue(':telephoneLocataire', $locataire->getTelephoneLocataire());
            $req->bindValue(':loginLocataire', $locataire->getLoginLocataire());
            $req->bindValue(':mdpLocataire', $mdpHash);
            $req->execute();

            // Récupérer l'ID de la personne ajoutée
            $lastInsertedID = $this->conn->lastInsertId();
        
            // Retourner l'objet locataire avec l'ID attribué
            return $this->getLocataireById($lastInsertedID);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getlocataire()
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM locataire");
            $req->execute();
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

            $locataires = [];
            foreach ($resultat as $ligne) {
                $locataire = new locataire(
                    $ligne["id_locataire"],
                    $ligne["nomLoc"],
                    $ligne["prenomLoc"],
                    $ligne["mailLoc"],
                    $ligne["telephoneLoc"],
                    $ligne["loginLoc"],
                    $ligne["mdpLoc"]
                );
                $locataires[] = $locataire;
            }
            return $locataires;

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getLocataireById($id_locataire)
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM locataire WHERE id_locataire=:id_locataire");
            $req->bindValue(":id_locataire", $id_locataire);
            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                $locataire = new locataire(
                    $resultat["id_locataire"],
                    $resultat["nomLocataire"],
                    $resultat["prenomLocataire"],
                    $resultat["mailLocataire"],
                    $resultat["telephoneLocataire"],
                    $resultat["loginLocataire"],
                    $resultat["mdpLocataire"]
                );
                return $locataire;
            } else {
                return null;
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getLocataireByLogin($loginLocataire)
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM locataire WHERE loginLocataire=:loginLocataire");
            $req->bindValue(':loginLocataire', $loginLocataire);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);

            if ($resultat) {
                $locataire = new locataire(
                    $resultat["id_locataire"],
                    $resultat["nomLocataire"],
                    $resultat["prenomLocataire"],
                    $resultat["mailLocataire"],
                    $resultat["telephoneLocataire"],
                    $resultat["loginLocataire"],
                    $resultat["mdpLocataire"]
                );
                return $locataire;
            } else {
                return null;
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
?>
