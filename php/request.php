<?php

include_once("../models/connexionBdd.php");
include_once("../models/trajet.php"); 
include_once("../models/etudiant.php"); 
include_once("../models/site.php"); 
include_once("../models/rejoindre.php"); 

$request_type = $_SERVER['REQUEST_METHOD'];

$request = substr($_SERVER['PATH_INFO'], 1);
$req=$request;
$request = explode('/', $request);
$requestRessource = array_shift($request);

$db=getConnexion();

if($req=="trajets"){
        switch ($request_type) {
            case "GET":
                function get_trajet($db){
                    $result = getTrajet($db,$_GET['id_trajet']);
                    echo json_encode($result);
                }
                function get_trajets($db){
                    $result = getTrajets($db);
                    echo json_encode($result);
                }
                function get_nb_places($db){
                    $result = getNbPlaces($db, $_GET['idTrajet']);
                    echo json_encode($result);
                }
                function get_trajetsConducteur($db){
                    $result = getTrajetsConducteur($db,$_SESSION['pseudo']);
                    echo json_encode($result);
                }
                function search_trajets($db){
                    $result = searchTrajets($db, $_GET['id_site'], $_GET['ville'], $_GET['date'], $_GET['heure'], $_GET['site_depart']);
                    echo json_encode($result);
                }
                function update_nb_places($db){
                    $result=updateNbPlaces($db, $_GET["idTrajet"], $_SESSION['pseudo']);
                    echo json_encode($result);
                }
                if (isset($_GET['function'])) {
                    $_GET['function']($db);
                }
                break;
            case "POST":
                function create_trajet($db){
                    $result = createTrajet($db, $_POST['date'], $_POST['nb_passagers'], $_POST['prix'], $_POST['site_depart'], $_POST['fumeur'], $_POST['animaux'], $_POST['site_heure'], $_POST['ville_heure'], $_POST['commentaire'], $_SESSION['pseudo'], $_POST['idSite'], $_POST['ville'], $_POST['adresse']);
                    echo json_encode($result);
                }
                if (isset($_POST['function'])) {
                    $_POST['function']($db);
                }
                break;
                /*
            case "PUT":
                $result=updateNbPlaces($db, $_GET["idTrajet"]);
                echo json_encode($result);
                break;
*/
            case "DELETE":
                function delete_trajet($db){
                    $result = deleteTrajet($db, $_GET['idTrajet']);
                    echo json_encode($result);
                }
                if (isset($_GET['function'])) {
                    $_GET['function']($db);
                }
            break;
    }
}elseif($req=="etudiants"){
        switch ($request_type) {
            case "GET":
                function get_etudiant($db){
                    $result = getEtudiant($db,$_GET['pseudo']);
                    echo json_encode($result);
                }
                function get_etudiants($db){
                    $result = getEtudiants($db);
                    echo json_encode($result);
                }
                if (isset($_GET['function'])) {
                    $_GET['function']($db);
                }
                break;                
            case "POST":
                function create_etudiant($db){
                    $result = createEtudiant($db, $_POST['pseudo'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['ville'], $_POST['adresse']);
                    echo json_encode($result);
                }
                if (isset($_POST['function'])) {
                    $_POST['function']($db);
                }
                break;
            default:
                break;
        }
}elseif($req == "sites"){
    switch ($request_type) {
        case "GET":
            function get_sites($db){
                $result = getSites($db);
                echo json_encode($result);
            }
            if (isset($_GET['function'])) {
                $_GET['function']($db);
            }
            break;
        default:
            break;
    }
}elseif($req == "inscriptions"){
    switch ($request_type) {
        case "GET":
            function get_trajets_passagers($db){
                $result = recupererTrajetsId($db, $_SESSION['pseudo']);
                echo json_encode($result);
            }
            if (isset($_GET['function'])) {
                $_GET['function']($db);
            }
            break;
        case "POST":
            function create_inscription($db){
                $result = createInscription($db, $_SESSION['pseudo'], $_POST['trajet_id']);
                echo json_encode($result);
            }
            if (isset($_POST['function'])) {
                $_POST['function']($db);
            }
            break;
        case "DELETE":
            function delete_inscription($db){
                $result = deleteInscription($db, $_SESSION['pseudo'], $_GET['trajet_id']);
                echo json_encode($result);
            }
            if (isset($_GET['function'])) {
                $_GET['function']($db);
            }
            break;
        default:
            break;
    }
}