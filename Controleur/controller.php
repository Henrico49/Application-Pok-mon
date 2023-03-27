<?php

/**
 * cette fonction affiche la page d'erreur.
 */
function erreur($e){
    $erreur = $e->getMessage();
    $page = "Erreur";
    require("Vue/Erreur.php");

}
/**
 *cette fonction affiche la page d'accueil.
 */
function index () {
    $page="Accueil";
    require_once("Vue/Accueil.php");
}
/**
 * cette fonction affiche la page Historisation.
 */
function historisation(){
    $page = "Historisation";
    $xml = simplexml_load_file('histo.xml');
    require_once("Vue/Historisation.php");
}
/**
 * cette fonction affiche la page modifie
 * et créee un tableau de pokemon avec leurs nom et leurs id.
 * elle gère aussi les envoie de donnée avec la gestion des erreurs
 */
    function modifier()
    {
        $page = "Modifier";
        require_once ("Modele/model.php");
        $pokeList = pokemon::getPokemons();
        require_once("Vue/Modifier.php");
        try {
            if (!empty($_POST)) {
                $pokeModifier = new pokemon($_POST['id']);
                // vérification si les données envoyé sont inchangé par rapport à celle de base
                if ($pokeModifier->getheight() == $_POST['taille'] && $pokeModifier->getweight() == $_POST['poids']) {
                    throw new Exception("Même poids et même taille choisis");
                } else {
                    // vérification si les valeurs envoyé sont bien positive
                    if ($_POST['taille'] < 0 or $_POST['poids'] < 0) {
                        throw new Exception("Modification du poids ou taille inférieur à 0 non autorisé");
                    } else {
                        modifierPokemon($pokeModifier, $_POST['taille'], $_POST['poids']);
                        //écriture dans le fichier XML
                        ecritureXML("Modifier",
                            "La taille (" . $pokeModifier->getheight() . "->" . $_POST['taille'] . ") et le poids (" .
                            $pokeModifier->getweight() . "->" . $_POST['poids'] . ") de " . $pokeModifier->getname() .
                            " [id=" . $pokeModifier->getid() . "] modifiés"
                        );
                    }
                }
            }
        }catch (Exception $e) {
            erreur($e);
        }

    }
/**
 * cette fonction affiche la page test
 * et créee un tableau de pokemon avec leurs nom, id, taille, poids et leurs types.
 */
function test(){
    require_once("Modele/model.php");
    $page = "Test";
    $pokeTab=pokemon::getPokemons();
    //écriture dans le fichier XML
    ecritureXML("Voir","Récupération des tous les Pokemon et leurs types en base.");
    require_once("Vue/Test.php");

}
/**
 * cette fonction affiche la page afficher.
 */
function afficher(){
    require_once ("Modele/model.php");
    $types = getTypes();
    ecritureXML("Voir","Récupération de tous les types de la base");
    $page = "Afficher";
    require_once("Vue/Afficher.php");
}

/**
 * récupération de tous les pokémons du type souhaité
 * @param $id int du type
 * @return void
 */
function afficherPokemonType($id){
    require_once ("Modele/model.php");
    $tab_pokemon = array();
    //on vérifie que le type est différent de celui par défault (0)
    if($id != 0){
        $data=getPokemonByTypeID($id);
        /**
         * création du tableau bien formé pour la fonction json_encode
         */
        foreach ($data as $pokemon){
            $tab_pokemon[]=array(
                "id" => $pokemon->getid(),
                "nom" => $pokemon->getname(),
                "taille" => $pokemon->getheight(),
                "poids" => $pokemon->getweight(),
                "types" => $pokemon->gettype()
            );

        }
        //écriture dans le fichier XML
        ecritureXML("Voir","Récupération des Pokémon pour le type d'id=$id");

    }
    $pokemons = json_encode($tab_pokemon);
    // Affichage du JSON
    echo $pokemons;

}
