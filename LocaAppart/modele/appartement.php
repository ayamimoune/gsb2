<?php
class appartement
{
    private $id_appart;
    private $adresse;
    private $cp;
    private $type_appart;
    private $num_bat;
    private $num_appart;
    private $loyer;
    private $date_libre;
    private $id_proprietaire;

    public function __construct($id_appart, $adresse, $cp, $type_appart, $num_bat, $num_appart, $loyer, $date_libre, $id_proprietaire)
    {
        $this->id_appart = $id_appart;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->type_appart = $type_appart;
        $this->num_bat = $num_bat;
        $this->num_appart = $num_appart;
        $this->loyer = $loyer;
        $this->date_libre = $date_libre;
        $this->id_proprietaire = $id_proprietaire;
    }

    public function getIDAppart()
    {
        return $this->id_appart;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCP()
    {
        return $this->cp;
    }

    public function getTypeAppart()
    {
        return $this->type_appart;
    }

    public function getNumBat()
    {
        return $this->num_bat;
    }

    public function getNumAppart()
    {
        return $this->num_appart;
    }

    public function getLoyer()
    {
        return $this->loyer;
    }

    public function getDateLibre()
    {
        return $this->date_libre;
    }

    public function getIdProprio()
    {
         return $this->id_proprietaire;
    }


    //Peut être plus tard
    public function setDateLibre($date_libre) {
         $this->date_libre = $date_libre;
     }
}

?>