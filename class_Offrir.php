<?php

class Offrir {
    private $id_rapport;
    private $id_medicament;
    private $quantite;

    public function __construct($id_rapport, $id_medicament, $quantite) {
        $this->id_rapport = $id_rapport;
        $this->id_medicament = $id_medicament;
        $this->quantite = $quantite;
    }

    // Ajoutez des méthodes spécifiques à l'offre ici
}

?>