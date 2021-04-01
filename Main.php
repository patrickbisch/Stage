<?php

require_once "Autoloader.php";
Autoloader::register();
/*===================================================================*/
function AfficherAide()
{
    echo "\n";
    echo "*****************************************************************\n";
    echo "Voici la liste des commandes pour la gestion de vos salariés :\n";
    echo "  T+ => Achat d'un chien.\n";
    echo "     Parametres optionnels :\n";
    echo "        Nom          => Nom du chien.\n";
    echo "        /Tarif       => Tarif de vente.\n";
    echo "        //Nourriture => Nourriture du chien.\n";
    echo "        ///Quantite  => Quantite de la nourriture.\n";
    echo "  LT => Liste de tous les chiens.\n";
    echo "_________________________________________________________________\n";
    echo "  M+ => Achat d'un chat.\n";
    echo "     Parametres optionnels :\n";
    echo "        Nom          => Nom du chat.\n";
    echo "        /Tarif       => Tarif de vente.\n";
    echo "        //Nourriture => Nourriture du chat.\n";
    echo "        ///Quantite  => Quantite de la nourriture.\n";
    echo "  LM => Liste de tous les chats.\n";
    echo "_________________________________________________________________\n";
    echo "  P+ => Achat d'un poisson.\n";
    echo "     Parametres optionnels :\n";
    echo "        Nom          => Nom du poisson.\n";
    echo "        /Tarif       => Tarif de vente.\n";
    echo "        //Nourriture => Nourriture du poisson.\n";
    echo "        ///Quantite  => Quantite de la nourriture.\n";
    echo "        ///Eau       => Habitat 0=Douce, 1=Salée.\n";
    echo "  LP => Liste de tous les poissons.\n";
    echo "_________________________________________________________________\n";
    echo "  N+ => Ajout de nourriture dans le stock.\n";
    echo "     Parametres optionnels :\n";
    echo "        Nom        => Nom de la nourriture.\n";
    echo "        /Qauntite  => Quantité à ajouter dans le stock.\n";
    echo "  LN => Liste de toutes les nourritures.\n";
    echo "_________________________________________________________________\n";
    echo "  ? => Affiche l'aide de l'application.\n";
    echo "  FIN => Permet de sortir du programme.\n";
    echo "*****************************************************************\n";
}
function AfficherTitre()
{
    echo "\n";
    echo "*****************************************************************\n";
    echo "*                 Bienvenue AUX ANIMAUX HEUREUX                 *\n";
    echo "*****************************************************************\n";
}

AfficherTitre();
AfficherAide();
$gstElement = new GestionElement();

//  Execution pour la mise au point de l'application
$gstElement->AjouterElement("Nutrivet/10","Nourriture");
$gstElement->AjouterElement("PURINA ONE/3","Nourriture");
$gstElement->AjouterElement("PURINA PRO PLAN/8","Nourriture");
$gstElement->AjouterElement("Royal Canin/100","Nourriture");
$gstElement->AjouterElement("Hill's Science Plan/20","Nourriture");
$gstElement->AjouterElement("Poisson rouge/2500","Nourriture");
$gstElement->AjouterElement("Poisson combattant/3000","Nourriture");
$gstElement->AjouterElement("Discus/300","Nourriture");
$gstElement->AjouterElement("Crevette/200","Nourriture");
$gstElement->AjouterElement("Crabe/400","Nourriture");
$gstElement->AjouterElement("Flocons/600","Nourriture");
$gstElement->AjouterElement("Granules/4176","Nourriture");
$gstElement->AjouterElement("Poisson de fond/782","Nourriture");
Chien::Ajouter("Boby","123","3","2");
Chien::Ajouter("Rantanplan","1","2","1");
Poisson::Ajouter("Nemo", "21","9","2","1");

/*===================================================================*/
//  Boucle principale pour la saisie des commandes
/*===================================================================*/
do 
{
    echo "\n";
    $reponse=readline("Votre requete : ");
    echo "\n";
    TraiterRequete($reponse);
}while($reponse	!= "");
echo "***********************************\n";
Echo "*    Au revoir et a bientot !!    *\n";
echo "***********************************\n";

//  Traitement des differentes commandes
function TraiterRequete(&$requete)
{
    global $gstElement;
    //  On recupere les 2 premiers caracteres en MAJUSCULE
    $cmds = substr(strtoupper($requete),0,2);
    switch($cmds)
    {
        case "T+";  //  Achat d'un chien
            echo "Achat d'un chien\n";
            $gstElement->AjouterElement(substr($requete,2,100),"Chien");
            break;
        case "LT";  //  Afficher la liste des chiens
            Animaux::Afficher("Chien");
            break;
        case "M+";  //  Achat d'un chat
            echo "Achat d'un chat\n";
            $gstElement->AjouterElement(substr($requete,2,100),"Chat");
            break;
        case "LM";  //  Afficher la liste des chats
            Animaux::Afficher("Chat");
            break;
        case "P+";  //  Achat d'un poisson
            echo "Achat d'un poisson\n";
            $gstElement->AjouterElement(substr($requete,2,100),"Poisson");
            break;
        case "LP";  //  Afficher la liste des poissons
            Animaux::Afficher("Poisson");
            break;
        case "N+";  //  Achat de nourriture
            echo "Ajout d'une nourriture\n";
            $gstElement->AjouterElement(substr($requete,2,100),"Nourriture");
            break;
        case "LN";  //  Afficher la liste de toutes les nourritures en stock
            Nourriture::Afficher();
            break;
        case "? ";
        case "?";
            AfficherAide();
            break;
        case 'FI';
            $requete="";
        case "";
            break;
        default;
            echo "  COMMANDE <" . $cmds . "> NON RECONNUE !!\n";
    }
}
