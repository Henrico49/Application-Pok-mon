<?php

class ConnexionPDO
{
    /**
     * fonction pour la connection à une BDD.
     * @param $dbname nom de la base donnée à laquelle on veut se connecter.
     * @return $pdo retourne une instance de la classe PDO qui est connecté à la BDD.
     */
    public function connexPDO($dbname)
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=$dbname;", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

}

