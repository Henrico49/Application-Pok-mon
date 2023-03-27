<?php


class Pokemon {


    private int $id;
    private string $name;
    private $height;
    private $weight;
    private $type;


    public function getname(){
        return $this->name;
    }

    public function getid(){
        return $this->id;
    }

    public function getheight(){
        return $this->height;
    }

    public function getweight(){
        return $this->weight;
    }

    public function gettype(){
        return $this->type;
    }

    public function setType($newType){
        $this->type=$newType;
}
    /**
     * constructeur de pokemon.
     * @param $id int id du pokemon que l'on veut crée.
     */
    public function __construct($id) {
            $this->id = $id;
            $this->name = $this->getPokemon($id)->pok_name;
            $this->height = $this->getPokemon($id)->pok_height;
            $this->weight = $this->getPokemon($id)->pok_weight;
            $this->type = new type();


    }


    /**
     * Recherche d'un pokemon par ID.
     * @param $id id du pokemon recherché.
     * @return mixed retourne les informations du pokemon.    */
    function getPokemon($id) {
        $bdd = new ConnexionPDO();
        $pdo = $bdd->connexPDO('pokemon');
        $query = $pdo->prepare('SELECT * FROM pokemon WHERE pok_id = :id');
        $query->execute(array(':id' => $id));
        $result =$query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    /**
     * Création d'un tableau associatif d'objet avec comme clée l'id du pokemon et pour valeur le pokemon et ses types.
     * @return array $tab tableau de tous les pokemons avec leur types.
     */
    public static function getPokemons(): array
    {
        $bdd = new ConnexionPDO();
        $objdb = $bdd->connexPDO('pokemon');
        $sql = "SELECT p.pok_id,type_id FROM pokemon p JOIN pokemon_types ON p.pok_id = pokemon_types.pok_id ORDER BY p.pok_name ASC";
        $result = $objdb->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tab = array();
        foreach ($rows as $pokemon) {
            $poke = new Pokemon($pokemon->pok_id);
            $typeTab = array();
            foreach ($poke->type->getTypesID($pokemon->type_id) as $type){
               $typeTab[] = new type($type->type_id,$type->type_name);
            }
            $poke->type = $typeTab;
            $tab[$poke->id] = $poke;
        }

        return $tab;

    }




}