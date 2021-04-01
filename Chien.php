<?php

class Chien extends Animaux
{
    static function Ajouter($Nom, $Tarif, $Nourriture, $Quantite)
    {
        Animaux::$LstAnimaux[] = new Chien($Nom, $Tarif, $Nourriture, $Quantite);
        return(1);
    }
}