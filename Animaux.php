<?php

class Animaux implements GestionAnimaux
{
    //  Commun a tous les animaux
    protected $nom;
    protected $tarif;
    protected $nourriture;
    protected $quantite;
    //  Unique pour la gestion du stock des animaux du magasin
    static $LstAnimaux = array();

    protected function __construct($Nom, $Tarif, $Nourriture, $Quantite)
    {
        $this->nom = $Nom;
        $this->tarif = $Tarif;
        $this->nourriture = $Nourriture;
        if (is_numeric($Nourriture))
        {
            $this->nourriture = Nourriture::NomNourriture($Nourriture);
        }
        $this->quantite = $Quantite;
    }
    static function Afficher($Type)
    {
        echo "Liste des " . $Type . "\n";
        echo "        Nom              Tarif  ";
        if ($Type == "Poisson")
        {
            echo "  Eau";
        }
        echo "      Nourriture\n";
        $Nb = 0 ;
        foreach(self::$LstAnimaux as $Cle => $Ptr)
        {
            if (get_class($Ptr) == $Type)
            {
                echo sprintf("  [%3d] ", $Cle) . substr($Ptr->nom . "                                           ",0,15);
                echo sprintf(" %6d   ",$Ptr->tarif);
                if ($Type == "Poisson")
                {
                    echo $Ptr->habitat;
                }
                echo sprintf("%2d", $Ptr->quantite) . " * " . $Ptr->nourriture . "\n";
                $Nb++;
            }
        }
        if ($Nb == 0)
        {
            echo "   La liste est vide.\n";
        }
        return(1);
    }
    /*===================================================================================*/
    //  Declaration pour l'interface
    /*===================================================================================*/
    function achat($nouvelAnimal)
    {
        echo "  Achat : " . $nouvelAnimal . "\n";
    }
    function vente()
    {
        echo "Vente d'un chien\n";
    }
    function manger($typeNourriture)
    {
        echo "Type de nourriture : " . $typeNourriture . "\n";
    }
}
