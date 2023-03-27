<?php
require_once("Controleur/controller.php") ;

try {
    //vérification de la page demandé est affichage si la page demandé existe sinon affichage de la page erreur
    if (isset($_GET['view'])) {
        switch ($_GET['view']) {
            case 'index':
                index();
                break;
            case 'historisation':
                historisation();
                break;
            case 'modifier':
                    modifier();
                break;
            case 'test':
                test();
                break;
            case 'afficher':
                afficher();
                break;
            case 'getTypeID' :
                if(isset($_GET['IDType'])){
                    afficherPokemonType(intval($_GET['IDType']));
                }
                break;
            default:
                throw new Exception("La page demandée n'existe pas");
        }
    } else {
        index();
    }
} catch (Exception $e) {
    erreur($e);

}


