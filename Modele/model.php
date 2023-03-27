<?php
require("connexpdo.php");
require_once("pokemon.php");
require_once("type.php");

/**
 * écriture dans le fichier XML 'histo.xml'
 * @param $type string est le type d'appel à la base de donéne effectué
 * @param $description string est le message qui sera affiché dans le fichier XML
 * @return void
 */
function ecritureXML($type,$description): void
{
    // On charge le contenu du fichier XML dans un objet SimpleXMLElement
    $xml = simplexml_load_file('histo.xml');
    date_default_timezone_set('Europe/Paris');
    $heure = date("H:i:s");
    $jour = date("d/m/Y");
    // On ajoute un nouvel élément
    $nouvelElement = $xml->addChild('operation');
    $nouvelElement->addChild('type', $type);
    $nouvelElement->addChild('horodate', $jour." ".$heure);
    $nouvelElement->addChild('desc', $description);

    // On enregistre les modifications dans une variable avec formatage
    $xml->asXML('histo.xml');


}


/**
 * modification du poids et de la taille d'un pokemon
 * @param $pokemon pokemon est le pokemon que l'on veut modifier
 * @param $newtaille int est la nouvelle taille du pokemon
 * @param $newpoids int est le nouveau poids du pokemon
 * @return void
 */
function modifierPokemon($pokemon, $newtaille, $newpoids): void
{
    $bdd = new ConnexionPDO();
    $objdb = $bdd->connexPDO('pokemon');
    $id = $pokemon->getid();
    $sql = "UPDATE pokemon SET pok_weight=$newpoids, pok_height=$newtaille WHERE pok_id=$id ";
    $objdb->query($sql);
}

/**
 * récupération du tableau de tous les types
 * @return array
 */
function getTypes()
{
    $bdd = new ConnexionPDO();
    $objdb = $bdd->connexPDO('pokemon');
    $sql = "Select * from types";
    $result = $objdb->query($sql);
    $types = $result->fetchAll(PDO::FETCH_OBJ);
    $typetab = array();
    foreach ($types as $type){
        $typetab[]=new type($type->type_id,$type->type_name);
    }
    return $typetab;
}

/**
 * récupération des types d'un pokémon
 * @param $id int du pokemon
 * @return array|false
 */
function getTypesID($id): false|array
{
    $bdd = new ConnexionPDO();
    $objdb = $bdd->connexPDO('pokemon');
    $sql = "SELECT type_name,t.type_id FROM pokemon_types pt JOIN types t ON pt.type_id = t.type_id WHERE pok_id = $id";
    $result = $objdb->query($sql);
    $types = $result->fetchAll(PDO::FETCH_OBJ);
    return $types;
}

/**
 * récupération de tous les pokémons qui sont du type id
 * @param $id int du type
 * @return array
 */

function getPokemonByTypeID($id): array
{
    $bdd = new ConnexionPDO();
    $objdb = $bdd->connexPDO('pokemon');
    $sql = "SELECT pok_name, pok_height, pok_weight,p.pok_id FROM pokemon_types pt JOIN pokemon p ON pt.pok_id = p.pok_id WHERE pt.type_id = $id";
    $result = $objdb->query($sql);
    $pokemons = $result->fetchAll(PDO::FETCH_OBJ);
    $pokemonsTab = array();
    foreach ($pokemons as $pokemon){
        $poke=new Pokemon($pokemon->pok_id);
        $typeTab = getTypesID($poke->getid());
        $poke->setType($typeTab);
        $pokemonsTab[]=$poke;

    }
    return $pokemonsTab;

}