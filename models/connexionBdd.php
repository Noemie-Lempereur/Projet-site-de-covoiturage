<?php

include("../constants.php");

// Fonction qui retourne une connexion à la base de données
function getConnexion(){
    $dsn='pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
    try {    
        $connexion = new PDO($dsn, DB_USER, DB_PASSWORD);
        return $connexion;
    } catch (PDOException $e){
        echo 'Connexion echouee : ' . $e->getMessage();
        return false;
    }   
}

?>
