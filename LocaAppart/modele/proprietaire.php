<?php

class proprietaire 
{
    private $id_proprietaire;
    private $nomProprio;
    private $prenomProprio;
    private $mailProprio;
    private $telephoneProprio;
    private $loginProprio;
    private $mdpProprio;

    public function __construct($id_proprietaire, $nomProprio, $prenomProprio, $mailProprio, $telephoneProprio, $loginProprio, $mdpProprio)
    {
        $this->id_proprietaire = $id_proprietaire;
        $this->nomProprio = $nomProprio;
        $this->prenomProprio = $prenomProprio;
        $this->mailProprio = $mailProprio;
        $this->telephoneProprio = $telephoneProprio;
        $this->loginProprio = $loginProprio;
        $this->mdpProprio = $mdpProprio;
    }

    public function getIDProprio()
    {
        return $this->id_proprietaire;
    }

    public function getNomProprio()
    {
        return $this->nomProprio;
    }

    public function getPrenomProprio()
    {
        return $this->prenomProprio;
    }

    public function getMailProprio()
    {
        return $this->mailProprio;
    }

    public function getTelephoneProprio()
    {
        return $this->telephoneProprio;
    }

    public function getLoginProprio()
    {
        return $this->loginProprio;
    }

    public function getMdpProprio()
    {
        return $this->mdpProprio;
    }
}
?>
