<?php

class Chat extends Animaux 
{
    static function Ajouter($Nom, $Tarif, $Nourriture, $Quantite)
    {
        Animaux::$LstAnimaux[] = new Chat($Nom, $Tarif, $Nourriture, $Quantite);
        return(1);
    }
    //  Test pour Git
}