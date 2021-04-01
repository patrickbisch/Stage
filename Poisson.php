<?php

class Poisson extends Animaux
{
    // 0 ==> Eau douce, sinon Eau salée
    protected $habitat;

    protected function __construct($Nom, $Tarif, $Nourriture, $Quantite, $Habitat)
    {
        parent::__construct($Nom, $Tarif, $Nourriture, $Quantite);
        $this->habitat = $this->TypeHabitat($Habitat);
    }
    static function Ajouter($Nom, $Tarif, $Nourriture, $Quantite, $Habitat)
    {
        Animaux::$LstAnimaux[] = new Poisson($Nom, $Tarif, $Nourriture, $Quantite, $Habitat);
        return(1);
    }
    private function TypeHabitat($Habitat)
    {
        switch($Habitat)
        {
            case "1";
            case "Salée";
                return("Salée");     
            default;
               return("Douce");     
        };
    }
}