<?php

Class Nourriture
{
    protected $nom;
    protected $quantite;

    static $LstNourriture = array();

    protected function __construct($Nom, $Quantite)
    {
        $this->nom = $Nom;
        $this->quantite = $Quantite;
    }
    public function __get($attr)
    {
        return($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    static function Ajouter($Nom, $Quantite)
    {
        $indice = self::IndiceNourriture($Nom);
        if ($indice < 0 )
        {
            self::$LstNourriture[] = new Nourriture($Nom, $Quantite);
        }
        else
        {
            self::$LstNourriture[$indice]->quantite += $Quantite;
        }
        return(1);
    }
    static function IndiceNourriture($Nom)
    {
        foreach(self::$LstNourriture as $cle => $nourriture)
        {
            if ($nourriture->nom == $Nom)
            {
                return($cle);
            }
        }
        return(-1);
    }
    static function NomNourriture($Indice)
    {
        return(self::$LstNourriture[$Indice]->nom);
    }
    static function Afficher()
    {
        echo "Liste de la nourriture dans le magasin:\n";
        echo "       Produit                 Quantite\n";
        foreach(self::$LstNourriture as $cle => $nourriture)
        {
            echo sprintf("  [%3d] ", $cle) . substr($nourriture->nom . " ..............................",0,24);
            echo sprintf(" %5d", $nourriture->quantite) . "\n";
        }
    }
}