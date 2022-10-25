<?php

include("../models/connexionBdd.php");
include("../models/etudiant.php");
session_start();
// Initialisation des variables
      

function connexion(){
   $login = ''; 
   $password = ''; 
   $db = getConnexion();
   if (isset($_POST['login'])&&isset($_POST['password'])) { 
      // Récupération des informations de connexion saisies 
      $login = $_POST['login']; 
      $password = $_POST['password']; 
      // Vérification que l'utilisateur existe 
      tryconnexion($db, $login, $password);
           
      // Cas où les identifiants de connexion sont corrects
      // Ouverture d'une session
      session_start();
      session_regenerate_id();     
   }  
}
$_GET['func']();
