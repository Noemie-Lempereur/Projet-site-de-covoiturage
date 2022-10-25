<?php

//Fonction qui renvoie la liste des sites
function getSites($db){
    //Recuperation des sites sous forme de tableau
    //Requete SQL
    $query="SELECT nom FROM site;";
    $statement = $db->query($query);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


?>