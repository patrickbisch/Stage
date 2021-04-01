<?php

/*===========================================================*/
/*
/*  Cette classe definie les methodes génériques pour gerer
/*          tous les elements 'metier' dans un tableau
/*                  (ici la classe Animal)
/*
/*===========================================================*/
class GestionElement
{
    //private $LstNourriture = array();
   
/*===========================================================*/
/*  Cette fonction initialiser toutes les saisies
/*      en fonction de l'action
/*===========================================================*/
    private function InitialiserEcranSaisie($action) 
    {
        //  Initialisation des saisies
        $taille = 16;
        $lstSaisie = array();
        switch($action)
        {
            case "AjoutChien";
            case "AjoutChat";
                $lstSaisie[]  = new OutilSaisie("A","  Nom",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("N","  Prix",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("A","  Nourriture",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("N","  Quantite",0,1,$taille);
                break;
            case "AjoutPoisson";
                $lstSaisie[]  = new OutilSaisie("A","  Nom",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("N","  Prix",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("A","  Nourriture",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("N","  Quantite",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("T","  Eau",1,1,$taille,array("0", "Douce", "1", "Salée"));
                break;
            case "AjoutNourriture";
                $lstSaisie[]  = new OutilSaisie("A","  Nom",0,1,$taille);
                $lstSaisie[]  = new OutilSaisie("N","  Quantite",0,1,$taille);
                break;
        }
        return($lstSaisie);
    }
/*===========================================================*/
/*  Cette fonction ajoute un element dans le tableau
/*      S'il manque des parametres, ils seront saisie automatiquement
/*===========================================================*/
    function AjouterElement($buffer, $param)
    {
        $valeur = explode("/", $buffer . "/////");
        //  Initialisation des saisies
        $lstSaisie = array();
        $lstSaisie = $this->InitialiserEcranSaisie("Ajout" . $param);

        //  Boucle pour le controle et la saisie de toutes les données du salarié
        for ($x = 0; $x < count($lstSaisie); $x++)
        {
            $valeur[$x] = $lstSaisie[$x]->Saisir($valeur[$x]);
            if ($valeur[$x] == "")
            {
                echo "    La saisie sera annulée !!\n";
                return(-1);
            }
        }

        switch($param)
        {
            case "Chien";
                Chien::Ajouter($valeur[0], $valeur[1], $valeur[2], $valeur[3]);
                return(1);
            case "Chat";
                Chat::Ajouter($valeur[0], $valeur[1], $valeur[2], $valeur[3]);
                return(1);
            case "Poisson";
                Poisson::Ajouter($valeur[0], $valeur[1], $valeur[2], $valeur[3], $valeur[4]);
                return(1);
            case "Nourriture";
                Nourriture::Ajouter($valeur[0], $valeur[1]);
                return(1);
        }
        return(-1);
    }
}
