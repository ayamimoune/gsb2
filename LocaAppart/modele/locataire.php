<?php

class locataire
{
    private $id_locataire;
    private $nomLocaitaire;
    private $prenomLocataire;
    private $mailLocataire;
    private $telephoneLocataire;
    private $loginLocataire;
    private $mdpLocataire;

    public function __construct($id_locataire, $nomLocaitaire, $prenomLocataire, $mailLocataire, $telephoneLocataire, $loginLocataire, $mdpLocataire)
    {
        $this->id_locataire = $id_locataire;
        $this->nomLocaitaire = $nomLocaitaire;
        $this->prenomLocataire = $prenomLocataire;
        $this->mailLocataire = $mailLocataire;
        $this->telephoneLocataire = $telephoneLocataire;
        $this->loginLocataire = $loginLocataire;
        $this->mdpLocataire = $mdpLocataire;
    }

    public function getIdLocataire()
    {
        return $this->id_locataire;
    }

    public function getNomLocataire()
    {
        return $this->nomLocaitaire;
    }

    public function getPrenomLocataire()
    {
        return $this->prenomLocataire;
    }

    public function getMailLocataire()
    {
        return $this->mailLocataire;
    }

    public function getTelephoneLocataire()
    {
        return $this->telephoneLocataire;
    }

    public function getLoginLocataire()
    {
        return $this->loginLocataire;
    }

    public function getMdpLocataire()
    {
        return $this->mdpLocataire;
    }
}
?>