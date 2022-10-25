<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
include "../models/connexionBdd.php";
$db = getConnexion();

?>

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="description" content="Projet ISEN CIR2" />
    <meta name="author" content="Noemie LEMPEREUR & Jules LUCAS" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSS -->
    <link href="../assets/css/application.css" rel="stylesheet" />
    <link href="../assets/css/recherche.css" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link href="../assets/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="wrapper">

    <!-- Bandeau de navigation-->
    <nav class="navbar navbar-dark fixed-top navbar-expand-md" style="background-color: #023062;">
        <div class="container-fluid">
            <a href="../views/accueil.php"><img src="../assets/img/logo.png" class="navbar-logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Menu de navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../views/accueil.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mx-3">
                                <circle cx="10.5" cy="10.5" r="7.5"></circle>
                                <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                            </svg>
                            Rechercher un trajet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/proposertrajet.php">Proposer un trajet</a>
                    </li>
                </ul>
                <?php
                if ($_SESSION['pseudo'] == NULL) {
                    echo '<ul class="navbar-nav" aria-labelledby="compte">';
                    echo '<li class="nav-item dropdown dropleft">';
                    echo '<a class="nav-link dropdown-toggle" id="compte" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo 'S identifier';
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="compte">';
                    echo '<li><a class="dropdown-item" href="inscription.php">Inscription</a></li>';
                    echo '<li><a class="dropdown-item" href="connexion.php">Connexion</a></li>';
                    echo '</ul> ';
                } else {
                    echo '<ul class="navbar-nav" aria-labelledby="compte">';
                    echo '<li class="nav-item dropdown dropleft">';
                    echo '<a class="nav-link dropdown-toggle" id="compte" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo $_SESSION['pseudo'];
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="compte">';
                    echo '<li><a class="dropdown-item" href="../views/profil.php">Mon profil</a></li>';
                    echo '<li><a class="dropdown-item" href="../views/mestrajets.php">Mes trajets</a></li>';
                    echo '<li><a class="dropdown-item" href="../views/deconnexion.php">Deconnexion</a></li>';
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                }
                ?>
            </div>
    </nav>

    <!--corps de page-->
    <div class="container-fluid">
        <div class="row justify-content-center" id="menu1" display="none">
            <div class="col-md-8">
                <h1>Bienvenue sur Covoit'ISEN !</h1>
                <br>
                <h3>Site de covoiturage des sites ISEN</h3>
                <hr>
                <br>
                <h3>Mentions légales :</h3>
                <br>
                <b>Projet de fin d'année (2020-2021) à l'ISEN Nantes</b><br><br>

                <b>Editeurs :</b>
                <p>Noémie LEMPEREUR & Jules LUCAS<br>Etudiants à l'ISEN Nantes en CIR2<br><br></p>

                <b>Adresse :</b>
                <p>35 Avenue du Champ de Manœuvre, 44470 Carquefou</p>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <div class="footer-basic" id="backBleu">
        <footer class="text-lg-start text-white">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="mailto:covoitisen@gmail.com">Nous contacter</a></li>
                <li class="list-inline-item"><a href="mentions_legales.php">Mentions légales</a></li>
                <li class="list-inline-item"><a href="donnees_personnelles.php">Données personnelles</a>
                </li>
            </ul>
            <p class="copyright">Covoit'ISEN © 2021 - Noemie LEMPEREUR & Jules LUCAS</p>
        </footer>


        <!-- Bootstrap core JS-->
        <script src="../assets/dist/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Script js -->
        <script src="../js/accueil.js" defer></script>
        <script src="../js/trajet.js" defer></script>
        <script src="../js/ajax.js" defer></script>
</body>

</html>