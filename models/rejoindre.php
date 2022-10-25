<?php
include("../connexionBdd.php");

//Fonction qui permet de recuperer les trajets en passager d'un etudiant
function recupererTrajetsId($db, $pseudo){
    //Recuperation des trajets
    //Requete SQL
    $query='SELECT trajet.id,trajet.date, trajet.nb_passagers, trajet.prix, trajet.site_depart,trajet.fumeur, trajet.animaux, trajet.site_heure, trajet.ville_heure, trajet.commentaire, trajet.pseudo,lieu.ville, lieu.adresse,site.nom ';
    $query .= 'FROM rejoindre INNER JOIN trajet ON id_trajet=trajet.id INNER JOIN site ON trajet.id_site=site.id INNER JOIN lieu ON trajet.id_lieu=lieu.id WHERE rejoindre.pseudo=:pseudo;';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':pseudo',$pseudo);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Fonction qui permet de recuperer le pseudo des passagers d'un trajet
function recupererPseudo($db, $trajet_id){
    //Recuperation des trajets
    //Requete SQL
    $query='SELECT pseudo FROM rejoindre WHERE rejoindre.id_trajet=:id_trajet;';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':id_trajet',$trajet_id);
    $statement->execute();
    //Recuperation du resultat
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Fonction qui permet d'inscrire un etudiant à un trajet
function createInscription($db, $pseudo,$trajet_id){
    //Verification de si l'inscription est deja faite
    //RequeteSQL
    $query = 'SELECT COUNT(*) FROM rejoindre WHERE id_trajet=:idTrajet AND pseudo=:pseudo;';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':idTrajet',$trajet_id);
    $statement->bindParam(':pseudo',$pseudo);
    $statement->execute();
    //Recuperation du resultat
    $resultat=$statement->fetch()['count'];
    if($resultat == 0){
        //Verification que l'utilisateur n'est' pas le conducteur
        $query = 'SELECT pseudo FROM trajet WHERE id=:idTrajet ;';
        $statement = $db->prepare($query);
        //Parametres de la requête
        $statement->bindParam(':idTrajet',$trajet_id);
        $statement->execute();
        //Recuperation du resultat
        $resu=$statement->fetch(PDO::FETCH_ASSOC)['pseudo'];
        if( $resu != $pseudo){
            //Il n'y a pas encore d'inscription donc on en crée une
            //Decrementation du nombre de place (normalement PUT mais le PUT ne marchait pas)
            //Requete SQL
            $query = 'UPDATE trajet SET nb_passagers = (nb_passagers - 1) WHERE id = :idTrajet RETURNING nb_passagers, id;';
            $statement = $db->prepare($query);
            $statement->bindParam(':idTrajet',$trajet_id);
            $statement->execute();
            //Recuperation du resultat
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //Ajout d'une inscription
            //Requete SQL
            $query='INSERT INTO rejoindre(id_trajet, pseudo) VALUES(:id_trajet, :pseudo) RETURNING id_trajet';
            $statement = $db->prepare($query);
            //Parametres de la requête
            $statement->bindParam(':id_trajet',$trajet_id);
            $statement->bindParam(':pseudo',$pseudo);
            $statement->execute();
            //return du nouveau nombre de passagers et de l'id
            return $result;
        }
    }
    return false;
    
}

//Fonction qui permet de desinscrire un passager d'un trajet
function deleteInscription($db, $pseudo,$trajet_id){
    try{
        //Augmenation du nombre de place sur le trajet car desinscription(normalement PUT mais le PUT ne marchait pas)
        //Requete SQL
        $query = 'UPDATE trajet SET nb_passagers = (nb_passagers + 1) WHERE id = :idTrajet;';
        $statement = $db->prepare($query);
        $statement->bindParam(':idTrajet',$trajet_id);
        $statement->execute();  
        //desinscription sur la table rejoindre      
        //Requete SQL
        $query='DELETE FROM rejoindre WHERE id_trajet = :id_trajet AND pseudo = :pseudo;';
        $statement = $db->prepare($query);
        //Parametres de la requête
        $statement->bindParam(':id_trajet',$trajet_id);
        $statement->bindParam(':pseudo',$pseudo);
        $statement->execute();
        return true;
    }catch(Exception $e){
        echo 'Exception reçue : '.$e->getMessage()."\n";
        return false;
    }
}


?>