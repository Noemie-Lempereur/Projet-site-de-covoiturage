<?php

include_once("lieu.php");

//Fonction qui permet de rechercher des trajets
function searchTrajets($db, $id_site, $ville, $date, $heure, $site_depart)
{
    //Recuperation des trajets sous forme de tableau
    //Requete SQL
    $heure = $date . ' ' . $heure;
    $query =  'SELECT trajet.id, trajet.date, trajet.nb_passagers, trajet.prix, trajet.site_depart,trajet.fumeur, trajet.animaux, trajet.site_heure, trajet.ville_heure, trajet.commentaire,trajet.pseudo, lieu.ville, lieu.adresse, site.nom ';
    $query .= ' FROM trajet INNER JOIN lieu ON trajet.id_lieu=lieu.id INNER JOIN site ON trajet.id_site=site.id';
    $query .= " WHERE trajet.nb_passagers>0 AND trajet.id_site=:id_site AND lieu.ville=:ville AND trajet.date=:date AND trajet.site_depart=:site_depart AND (trajet.site_heure - :heureu)>=('00:00:00') AND (trajet.ville_heure - :heured)>=('00:00:00');";

    $statement = $db->prepare($query);
    $statement->bindParam(':id_site', $id_site);
    $statement->bindParam(':ville', $ville);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':heureu', $heure);
    $statement->bindParam(':heured', $heure);
    $statement->bindParam(':site_depart', $site_depart);
    $statement->execute();
    //Recuperation du resultat
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Fonction qui renvoie la liste des trajets
function getTrajets($db)
{
    //Recuperation des trajets sous forme de tableau
    //Requete SQL
    $query =  'SELECT trajet.id, trajet.date, trajet.nb_passagers, trajet.prix, trajet.site_depart,trajet.fumeur, trajet.animaux, trajet.site_heure, trajet.ville_heure, trajet.commentaire, trajet.pseudo, lieu.ville, lieu.adresse, site.nom ';
    $query .= ' FROM trajet INNER JOIN lieu ON trajet.id_lieu=lieu.id INNER JOIN site ON trajet.id_site=site.id;';
    $statement = $db->query($query);
    $statement->execute();
    //Recuperation du resultat
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Fonctions qui renvoie la liste des trajets dont l'etudiant est conducteur
function getTrajetsConducteur($db, $pseudo)
{
    //Recuperation des trajets d'un conducteur sous forme de tableau
    //Requete SQL
    $query =  'SELECT trajet.id, trajet.date, trajet.nb_passagers, trajet.prix, trajet.site_depart,trajet.fumeur, trajet.animaux, trajet.site_heure, trajet.ville_heure, trajet.commentaire, trajet.pseudo,lieu.ville, lieu.adresse,site.nom ';
    $query .= 'FROM trajet INNER JOIN lieu ON trajet.id_lieu=lieu.id INNER JOIN site ON trajet.id_site=site.id ';
    $query .= 'WHERE trajet.pseudo=:pseudo;';
    $statement = $db->prepare($query);
    $statement->bindParam(':pseudo', $pseudo);
    $statement->execute();
    //Recuperation du resultat
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//Fonction qui renvoie un trajet grace à son id
function getTrajet($db, $idTrajet)
{
    //Recuperation d'un trajet grâce à son id
    //Requete SQL
    $query =  'SELECT trajet.id, trajet.date, trajet.nb_passagers, trajet.prix, trajet.site_depart,trajet.fumeur, trajet.animaux, trajet.site_heure, trajet.ville_heure, trajet.commentaire, trajet.pseudo,lieu.ville, lieu.adresse,site.nom, etudiant.telephone ';
    $query .= 'FROM trajet INNER JOIN lieu ON trajet.id_lieu=lieu.id INNER JOIN site ON trajet.id_site=site.id INNER JOIN etudiant ON trajet.pseudo=etudiant.pseudo ';
    $query .= 'WHERE trajet.id=:idTrajet;';
    $statement = $db->prepare($query);
    //Parametre de la requête
    $statement->bindParam(':idTrajet', $idTrajet);
    $statement->execute();
    //Recuperation du resultat
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//Fonction qui permet de creer un trajet
function createTrajet($db, $date, $nb_passagers, $prix, $site_depart, $fumeur, $animaux, $site_heure, $ville_heure, $commentaire, $pseudo, $idSite, $ville, $adresse)
{
    //on regarde si on a toutes les informations pour creer
        //Verification de l'existence du lieu
        //RequeteSQL
        $query = 'SELECT COUNT(*) FROM lieu WHERE ville=:ville AND adresse=:adresse;';
        $statement = $db->prepare($query);
        //Parametres de la requête
        $statement->bindParam(':ville', $ville);
        $statement->bindParam(':adresse', $adresse);
        $statement->execute();
        //Recuperation du resultat
        if ($resultat = $statement->fetch()['count'] != 0) {
            //Le lieu existe deja donc on veut recuperer l'id
            $idVille = getIDLieu($db, $ville, $adresse);
        } else {
            //Le lieu n'existe pas, on veut le creer
            //Creation d'un lieu à partir de la ville et l'adresse
            $idVille = createLieu($db, $ville, $adresse);
        }
        //Creation du trajet
        //Requete SQL
        $query = 'INSERT INTO trajet(date, nb_passagers, prix, site_depart, fumeur, animaux, site_heure, ville_heure, commentaire, pseudo, id_site, id_lieu) VALUES(:date, :nb_passagers, :prix, :site_depart, :fumeur, :animaux, :site_heure, :ville_heure, :commentaire, :pseudo, :id_site, :id_lieu) RETURNING id;';
        $statement = $db->prepare($query);
        //Parametres de la requête
        $statement->bindParam(':date', $date);
        $statement->bindParam(':nb_passagers', $nb_passagers);
        $statement->bindParam(':prix', $prix);
        $statement->bindParam(':site_depart', $site_depart);
        $statement->bindParam(':fumeur', $fumeur);
        $statement->bindParam(':animaux', $animaux);
        $statement->bindParam(':site_heure', $site_heure);
        $statement->bindParam(':ville_heure', $ville_heure);
        $statement->bindParam(':commentaire', $commentaire);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':id_site', $idSite);
        $statement->bindParam(':id_lieu', $idVille);
        $statement->execute();
        //Recuperation du resultat
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
}

//Fonction qui permet de decrementer le nombre de place d'un trajet
function updateNbPlaces($db, $idTrajet, $pseudo)
{
    //Verification de si l'inscription est deja faite
    //RequeteSQL
    $query = 'SELECT COUNT(*) FROM rejoindre WHERE id_trajet=:idTrajet AND pseudo=:pseudo;';
    $statement = $db->prepare($query);
    //Parametres de la requête
    $statement->bindParam(':idTrajet', $idTrajet);
    $statement->bindParam(':pseudo', $pseudo);
    $statement->execute();
    //Recuperation du resultat
    if ($resultat = $statement->fetch()['count'] == 0) {
        //Il n'y a pas encore d'inscription donc on en crée une
        //Requete SQL
        $query = 'UPDATE trajet SET nb_passagers = (nb_passagers - 1) WHERE id = :idTrajet RETURNING nb_passagers, id;';
        $statement = $db->prepare($query);
        $statement->bindParam(':idTrajet', $idTrajet);
        $statement->execute();
        //Recuperation du resultat
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        //return du nouveau nombre de passagers
        return $result;
    }
    return false;
}

//Fonction qui permet de renvoyer le nombre de place d'un trajet
function getNbPlaces($db, $idTrajet)
{
    //Requete SQL
    $query = 'SELECT nb_passagers, id FROM trajet WHERE id = :idTrajet;';
    $statement = $db->prepare($query);
    $statement->bindParam(':idTrajet', $idTrajet);
    $statement->execute();
    //Recuperation du resultat
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}


//Fonction qui permet de supprimer un trajet dont on est conducteur
function deleteTrajet($db, $idTrajet)
{
    try {
        //Suppression des inscriptions dans la table rejoindre
        $query = 'DELETE FROM rejoindre WHERE id_trajet = :idTrajet;';
        $statement = $db->prepare($query);
        $statement->bindParam(':idTrajet', $idTrajet);
        $statement->execute();

        //Suppression du trajet
        //Requete SQL
        $query = 'DELETE FROM trajet WHERE id = :idTrajet;';
        $statement = $db->prepare($query);
        $statement->bindParam(':idTrajet', $idTrajet);
        $statement->execute();
        return true;
    } catch (Exception $e) {
        echo 'Exception reçue : ' . $e->getMessage() . "\n";
        return false;
    }
}
