<?php

class Demande {
    private $nomDemandeur;
    private $prenomDemandeur;
    private $telephoneDemandeur;
    private $mailDemandeur;
    private $message;
    private $idAppart;

    public function __construct($nom, $prenom, $telephone, $mail, $message, $idAppart) {
        $this->nomDemandeur = $nom;
        $this->prenomDemandeur = $prenom;
        $this->telephoneDemandeur = $telephone;
        $this->mailDemandeur = $mail;
        $this->message = $message;
        $this->idAppart = $idAppart;
    }

    // Méthode pour enregistrer la demande dans la base de données
    public function enregistrerDemande() {
        include_once 'connexionPDO.php'; // Inclure le fichier de connexion à la base de données

        try {
            $pdo = new connexionPDO();
            $stmt = $pdo->prepare("INSERT INTO demande (nomDemandeur, prenomDemandeur, telephoneDemandeur, mailDemandeur, message, id_appart) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->nomDemandeur, $this->prenomDemandeur, $this->telephoneDemandeur, $this->mailDemandeur, $this->message, $this->idAppart]);
            return true; // Retourne true si l'insertion est réussie
        } catch (PDOException $e) {
            // Gérer l'erreur ici (enregistrement de l'erreur dans les logs, etc.)
            return false; // Retourne false en cas d'échec
        }
    }
}
