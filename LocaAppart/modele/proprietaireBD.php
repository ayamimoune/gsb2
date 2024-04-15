<?php
include_once "proprietaire.php";
include_once "connexionPDO.php";

class proprietaireBD{

private $conn;

public function __construct()
{
    $pdo = new connexionPDO();
    $this->conn = $pdo->getConn();
}

public function addProprio($proprietaire)
{
    $mdpProprio = $proprietaire->getMdpProprio();
    $mdpHash = password_hash($mdpProprio, PASSWORD_BCRYPT);

    try {
        $req = $this->conn->prepare("INSERT INTO proprietaire (nomProprio, prenomProprio, mailProprio, telephoneProprio, loginProprio, mdpProprio) 
        VALUES (:nomProprio, :prenomProprio, :mailProprio, :telephoneProprio, :loginProprio, :mdpProprio)");
        $req->bindValue(':nomProprio', $proprietaire->getNomProprio());
        $req->bindValue(':prenomProprio', $proprietaire->getPrenomProprio());
        $req->bindValue(':mailProprio', $proprietaire->getMailProprio());
        $req->bindValue(':telephoneProprio', $proprietaire->getTelephoneProprio());
        $req->bindValue(':loginProprio', $proprietaire->getLoginProprio());
        $req->bindValue(':mdpProprio', $mdpHash);
        $req->execute();

        // Récupérer l'ID de la personne ajoutée
        $lastInsertedID = $this->conn->lastInsertId();

        // Retourner l'objet personne avec l'ID attribué
        return $this->getProprioByID($lastInsertedID);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

public function getProprios()
{
    try {
        $req = $this->conn->prepare("SELECT * from proprietaire");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        if ($resultat) {
            foreach ($resultat as $ligne ) {
                $proprietaire = new proprietaire(
                    $ligne["id_proprietaire"],
                    $ligne["nomProprio"],
                    $ligne["prenomProprio"],
                    $ligne["mailProprio"],
                    $ligne["telephoneProprio"],
                    $ligne["loginProprio"],
                    $ligne["mdpProprio"],
                );
                $proprietaires[] = $proprietaire;
            }
            return $proprietaires;
        }
        else{
            return null;
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

public function getProprioById($id_proprietaire)
{
    try{
        $req = $this->conn->prepare("SELECT * FROM proprietaire WHERE id_proprietaire=:id_proprietaire");
        $req->bindValue(":id_proprietaire", $id_proprietaire);
        $req->execute();

        $resultat=$req->fetch(PDO::FETCH_ASSOC);
        if($resultat){
            $proprietaire = new proprietaire(
                $resultat["id_proprietaire"],
                $resultat["nomProprio"],
                $resultat["prenomProprio"],
                $resultat["mailProprio"],
                $resultat["telephoneProprio"],
                $resultat["loginProprio"],
                $resultat["mdpProprio"],
            );
            return $proprietaire;
        }
        else{
            return null;
        }

    } catch(PDOException $e){
        print "Erreur !: ". $e->getMessage();
        die();
    }
}

public function getProprioByLogin($loginProprio)
{
    try {
        $req = $this->conn->prepare("SELECT * from proprietaire where loginProprio=:loginProprio");
        $req->bindValue(':loginProprio', $loginProprio);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        if($resultat){
            return new proprietaire(
                $resultat["id_proprietaire"],
                $resultat["nomProprio"],
                $resultat["prenomProprio"],
                $resultat["mailProprio"],
                $resultat["telephoneProprio"],
                $resultat["loginProprio"],
                $resultat["mdpProprio"],
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