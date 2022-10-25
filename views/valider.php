<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
include "../models/connexionBdd.php";
$db = getConnexion();
if ($_SESSION['pseudo'] == NULL) {
    header("Location:/../views/connexion.php");
}
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
    <link href="../assets/css/btn.css" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../assets/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
                <ul class="navbar-nav" aria-labelledby="compte">
                    <li class="nav-item dropdown dropleft">
                        <a class="nav-link dropdown-toggle" id="compte" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['pseudo']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="compte">
                            <li><a class="dropdown-item" href="../views/profil.php">Mon profil</a></li>
                            <li><a class="dropdown-item" href="../views/mestrajets.php">Mes trajets</a></li>
                            <li><a class="dropdown-item" href="../views/deconnexion.php">Deconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </nav>

    <!-- Contenu de la page-->
    <div class="container-fluid">
        <a href="../views/accueil.php" id="btn" name="retour" style="width:auto;height:auto;"
            class="btn btn-primary">Retour aux trajets</a>
        <a href="../views/mestrajets.php" id="btn" onclick="window.print()"
            style="width: auto; height: auto;color :white;display:none;" class="btn btn - primary"
            name="print">Imprimer</a>
    </div>
    <br><br><br><br>
    <h1 class="text-center" style="color:#023062;">Trajet </h1>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="font-weight:bold;"> Temps de route selon Google Maps API : <span
                    id="output"></span><br>Distance : <span
                    id="distance">km</span></div>
        </div>

        <div class="row">
            <div class="col-md-4" id="map" style="height:560px;width:500px;background-color:grey;border-radius:5%">
            </div>
            <div class="col-md-4 text-center" id="gauche">
            </div>
            <div class="col-md-4">
                <div class="container text-center"
                    style="background-color:#0A82F1;border-radius: 7%;color: white;font-size: 20px;" id="droite">
                </div>
                <div class="container-fluid text-center"
                    style="background-color: #0A82F1;border-radius: 7%;font-size: 20px;color:white;" id="synthese">
                </div>
            </div>
        </div>

    </div>
    <br>
    <div id="btn" style="width:auto;height:auto;margin-left:45%;color:white;" class="btn btn-primary" name="validation">
        Valider ce trajet</div>
    <br><br><br><br><br><br><br><br>
    </div>
    <!-- Pied de page -->
    <div class="footer-basic" id="backBleu">
        <footer class="text-lg-start text-white">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="mailto:covoitisen@gmail.com">Nous contacter</a></li>
                <li class="list-inline-item"><a href="mentions_legales.php">Mentions légales</a></li>
                <li class="list-inline-item"><a href="donnees_personnelles.php">Données personnelles</a></li>
            </ul>
            <p class="copyright">Covoit'ISEN © 2021 - Noemie LEMPEREUR & Jules LUCAS</p>
        </footer>
    </div>

    <!-- Bootstrap core JS-->
    <script src="../assets/dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/trajet.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXOcXnVqNIu99yo36S4poXOTSqr1E-Cbc">
    </script>
</body>

</html>