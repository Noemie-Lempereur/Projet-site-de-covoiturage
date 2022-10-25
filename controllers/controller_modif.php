<?php

include("../models/connexionBdd.php");
include("../models/etudiant.php");
session_start();
// Initialisation des variables
      

function modifMDP(){
   $db = getConnexion();
   if (isset($_POST['password'])&&isset($_POST['passwordrepeat'])) { 
      // Récupération des informations de connexion saisies 
      $password = $_POST['password']; 
      $password2 = $_POST['passwordrepeat'];
      if($password == $password2){
      $pseudo = $_SESSION['pseudo'];
      $password_h = password_hash($_POST['password'], PASSWORD_DEFAULT);
      // Modification du mdp
      updateMDPEtudiant($db, $pseudo, $password_h);
      } else {
        ?>
                    <script type="text/javascript">
                        alert("Les mots de passe ne correspondent pas");
                        location = "../views/inscription.php";
                    </script> 
                    <?php
      }      
   }  
}
$_GET['func']();

