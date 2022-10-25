<?php
    session_start();
    //permet de se deconnecter
    //detruit la session en cours avec les informations de connexion
    session_destroy();
    header('Location:../views/accueil.php');
    exit;
?>