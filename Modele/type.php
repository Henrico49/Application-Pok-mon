<?php

class type extends ConnexionPDO
{
    private $type_id;
    private $name;

    public function getId(){
        return $this->type_id;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * Constructeur de Type.
     * @param $id id du type.
     * @param $name noms des types.
     */
    function __construct($id =null ,$name= null)
    {
        if($id != null){
            $this->type_id = $id;
            $this->name = $name;
        }
    }

    /**
     * @param $id id du pokemon.
     * @return array $types tableau des types du pokemon recherché.
     */
    function getTypesID($id) {
        $objdb = $this->connexPDO("pokemon");
        $sql = "SELECT type_name,t.type_id FROM pokemon_types pt JOIN types t ON pt.type_id = t.type_id WHERE pok_id = $id";
        $result = $objdb->query($sql);
        $types = $result->fetchAll(PDO::FETCH_OBJ);
        return $types;
    }
}