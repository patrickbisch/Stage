<?php
/*============================================================*/
/*
/*      Cette classe outil permet de controler et de saisir 
/*              tout type de saisie 
/*
/*============================================================*/
class OutilSaisie
{
    //  Type de la saisie :
    //      "A" => Saisie d'une chaine alphanumerique
    //      "N" => Saisie numerique
    //      "I" => Saisie d'un numerique dans un interval
    //      "T" => Saisie d'une valeur faisant partie d'un tableau
    //      "%" => Saisie d'un numerique ou d'un pourcentage
    private $typeS;
    //  Le tableau de controle contient :
    //      "I" => [0] pour la borne inferieure
    //             [1] pour la borne superieure
    //      "T" => Liste des valeurs valide pour la saisie
    private $tableC = array();
    //  La valeur saisie sera en majuscule = 1, sinon = 0
    private $chaineM;
    //  Un saisie de chaine vide est autorisé = 1, sinon = 0
    private $chaineV;
    //  Le label de la saisie
    private $labelS;
    //  La taille du label = 0 aucun changement, sinon on complete avec '.' en focntion de la taille
    private $tailleL;

    function __construct($typeSaisie,
                        $labelSaisie, 
                        $saisieMajuscule = 1,
                        $chaineVideAutorise = 1,
                        $tailleLabel = 0,
                        $tableauControle = array())
    {
        $this->typeS = $typeSaisie;
        $this->tableC = $tableauControle;
        $this->chaineM = $saisieMajuscule;
        $this->chaineV = $chaineVideAutorise;
        $this->labelS = $labelSaisie;
        $this->tailleL = $tailleLabel;

        $this->CodeRetour = -1;
        $this->ChaineRetour = "";
    }
    function Saisir($ValeurDefaut = "")
    {
        if ($ValeurDefaut != "")
        {
            if ($this->Controler($ValeurDefaut) > 0)
            {
                return($ValeurDefaut);
            }
        }
        $Label = $this->FormaterLabel();
        do 
        {
            $Reponse = readline($Label);
            if ($this->chaineM == 1)
            {
                $Reponse = strtoupper($Reponse);
            }
            if ($this->Controler($Reponse) > 0)
            {
                return($Reponse);
            }
        }while($Reponse != "");
        return("");
    }
    function Controler($chaineControle) 
    {
        if ($chaineControle == "")
        {
            switch($this->chaineV)
            {
                case 1;
                    return(1);
                default;
                    return(-1);
            }
        }
        switch($this->typeS)
        {
            case "N";   //  Saisie d'un numerique
                if (is_numeric($chaineControle))
                {
                    return(1);
                }
                else
                {
                    echo "    La valeur doit etre numerique.\n";
                }
                break;
            case "I";   //  Saisie d'un numerique dans un interval
                if (is_numeric($chaineControle))
                {
                    if (($chaineControle >= $this->tableC[0]) &&
                         ($chaineControle <= $this->tableC[1]))
                    {
                        return(1);
                    }
                    else
                    {
                        echo "    La valeur doit etre entre " . $this->tableC[0] . " et " . $this->tableC[1] . "\n";
                    }
                }
                else
                {
                    echo "    La valeur doit etre numerique.\n";
                }
                break;
            case "T";   //  Saisie d'une valeur dans un tableau
                $tmp = "";
                for ($x = 0; $x < count($this->tableC); $x++)
                {
                    if ($this->tableC[$x] == $chaineControle)
                    {
                        return(1);
                    }
                    if ($x > 0)
                    {
                        $tmp .= ", ";
                    }
                    $tmp .= $this->tableC[$x];
                }
                echo "    La valeur possible est (" . $tmp . ")\n";
                break;
            case "A";
                return(1);
            case "%";
                case "N";   //  Saisie d'un numerique
                $chaine = explode("%", $chaineControle);
                if (is_numeric($chaine[0]))
                {
                    return(1);
                }
                else
                {
                    echo "    La valeur doit etre numerique.\n";
                }
                break;
            default;
                return(-1);
        }
        return(-1);
    }

    private function FormaterLabel()
    {
        $Label = $this->labelS;
        if ($this->tailleL > 0)
        {
            $NbPoint = $this->tailleL - strlen($Label) -3;
            if ($NbPoint > 0)
            {
                $Label .= substr(" ..........................................", 0, $NbPoint);
            }
            $Label .= " : ";
        }
        return($Label);
    }
}


    
