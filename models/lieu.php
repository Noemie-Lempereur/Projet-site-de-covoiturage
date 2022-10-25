<?php


function createLieu($db,$ville,$adresse){
    //Ajout d'un lieu
    //Requete SQL
    $query='INSERT INTO lieu(ville, adresse) VALUES(:ville,:adresse) RETURNING id';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':ville',$ville);
    $statement->bindParam(':adresse',$adresse);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    //Renvoie l'id du lieu créé
    return $result['id'];
}

function getIDLieu($db, $ville, $adresse){
    //Recuperer l'id d'un lieu
    //RequeteSQL
    $query='SELECT id FROM lieu WHERE ville=:ville AND adresse=:adresse;';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':ville',$ville);
    $statement->bindParam(':adresse',$adresse);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    //Renvoie l'id du lieu
    return $result['id'];
}

function getLieu($db, $id){
    //Recuperer le lieu grace a son id
    //RequeteSQL
    $query='SELECT * FROM lieu WHERE id=:id';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':id',$id);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    //Renvoie l'id du lieu
    return $result;
}

?>