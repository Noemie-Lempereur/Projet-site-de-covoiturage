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
                //Pour afficher le menu deroulant "s'identifier" ou pseudo en fonction de si l'utilisateur est connecté ou non
                if ($_SESSION['pseudo'] == NULL) {  //s'il n'est pas connecté
                    echo '<ul class="navbar-nav" aria-labelledby="compte">';
                    echo '<li class="nav-item dropdown dropleft">';
                    echo '<a class="nav-link dropdown-toggle" id="compte" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo 'S identifier';
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="compte">';
                    echo '<li><a class="dropdown-item" href="inscription.php">Inscription</a></li>';
                    echo '<li><a class="dropdown-item" href="connexion.php">Connexion</a></li>';
                    echo '</ul> ';
                } else {        //s'il est connecté
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

                <!-- Barre de recherche de trajet -->
                <section class="search-sec">
                    <div class="container">
                        <div class="card bg-light">
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                &nbsp&nbsp

                                                <!-- Depart -->
                                                <div class="col-lg-5 col-md-3 col-sm-12 p-1">

                                                    Partir de :

                                                    <!-- Partir d'un site (liste des sites de l'isen) -->
                                                    <select class="form-control" id="partirSite">
                                                        <option>ISEN Brest</option>
                                                        <option>ISEN Caen</option>
                                                        <option>ISEN Nantes</option>
                                                        <option>ISEN Rennes</option>
                                                    </select>

                                                    <!-- Partir d'une ville (champ pour écrire) -->
                                                    <input type="text" class="form-control" id="partirVille"
                                                        placeholder="Entrez la ville de départ" style="display: none;">
                                                </div>

                                                &nbsp&nbsp

                                                <!-- Destination -->
                                                <div class="col-lg-6 col-md-3 col-sm-12 p-1">

                                                    Aller à :

                                                    <!-- Arriver dans une ville (champ pour écrire) -->
                                                    <input type="text" class="form-control" id="arriverVille"
                                                        placeholder="Entrez la ville de destination">

                                                    <!-- Arriver sur un site (liste des sites de l'isen) -->
                                                    <select class="form-control" id="arriverSite"
                                                        style="display: none;">
                                                        <option>ISEN Brest</option>
                                                        <option>ISEN Caen</option>
                                                        <option>ISEN Nantes</option>
                                                        <option>ISEN Rennes</option>
                                                    </select>
                                                </div>

                                                &nbsp&nbsp

                                                <!-- Date de départ -->
                                                <div class="col-lg-2 col-md-3 col-sm-10 p-2">
                                                    Date de depart : <br>
                                                    <input type="date" class="form-control" id="date_depart"
                                                        min="23-06-2021">
                                                </div>
                                                <script type="text/javascript">
                                                date_depart.min = new Date().toISOString().split("T")[0];
                                                </script>

                                                &nbsp&nbsp

                                                <!-- Heure de départ -->
                                                <div class="col-lg-2 col-md-3 col-sm-10 p-2">
                                                    Heure de depart : <br>
                                                    <input type="time" class="form-control" id="heure_depart">
                                                </div>

                                                &nbsp&nbsp&nbsp

                                                <!-- Bouton rechercher pour lancer la recherche des trajets disponnibles -->
                                                <div class="col-lg-7 col-md-5 col-sm-12 p-2">
                                                    <br>
                                                    <button type="button" class="btn" id="btnNouvRech"
                                                        style="background-color:#023062;"><a
                                                            style="text-decoration:none; color:white;font-weight:bold;">Recherche</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Checkbox pour savoir si on part d'un site de l'isen ou si on arrive à un site de l'isen -->
                                    <!-- Les changements se font en js grace au fichier accueil.js -->
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="switch">
                                        <!-- Lorsqu'on lance la page, c'est par default sur partir d'un site de l'isen -->
                                        <label class="form-check-label" for="switch" name=textSwitch
                                            id="textCheckbox">Partir d'un site de l'ISEN</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br>

                <div class="container" id="menu">
                    <div class="row">
                        <div class="col-md-4 p-2">

                            <!-- Card pour image + bouton qui permet de renvoyer vers la page proposer un trajet -->
                            <div class="card text-center" id="card1">
                                <!-- image de voiture -->
                                <img class="card-img-top" src="../assets/img/car.png" alt="Voiture">
                                <!-- Bouton pour proposer un trajet -->
                                <div class="card-body" id="backBleu">
                                    <button type="button" class="btn" style="background-color:white;"><a
                                            style="text-decoration:none; color:#023062;font-weight:bold;"
                                            href="../views/proposertrajet.php">Proposer un trajet</a></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 p-2 text-center">
                            <!-- Card pour le carrousel des images des 4 sites de l'Isen et d'un bouton qui renvoie vers le site de l'isen -->
                            <div class="card">
                                <div class="row">
                                    <!--carrousel des images des sites de l'Isen -->
                                    <div class="col-md-8">
                                        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="img-fluid" src="../assets/img/isenNantes.jpg"
                                                        alt="Isen Nantes">
                                                    <br>
                                                    <h3 style="text-align: center;">Isen Nantes</h3>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="img-fluid" src="../assets/img/isenBrest.jpg"
                                                        alt="Isen Brest">
                                                    <br>
                                                    <h3 style="text-align: center;">Isen Brest</h3>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="img-fluid" src="../assets/img/isenRennes.jpg"
                                                        alt="Isen Rennes">
                                                    <br>
                                                    <h3 style="text-align: center;">Isen Rennes</h3>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="img-fluid" src="../assets/img/isenCaen.jpg"
                                                        alt="Isen Caen">
                                                    <br>
                                                    <h3 style="text-align: center;">Isen Caen</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Lien vers le site de l'Isen -->
                                    <div class="col-md-4 text-center">
                                        <h5 class="card-text">Les 4 sites ISEN Ouest</h5>
                                        <br><br>
                                        <p class="card-text" id="cardInfosIsen">Si vous voulez en
                                            savoir
                                            plus sur l'Isen Ouest, cliquez sur le bouton</p>
                                        <!-- Bouton pour acceder au site de l'isen -->
                                        <button type="button" class="btn" id="boutonRecherche"
                                            style="background-color:#023062;"><a
                                                style="text-decoration:none; color:white;font-weight:bold;"
                                                href="https://www.isen.fr/">Accéder
                                                au site de
                                                l'Isen</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Pour l'affichage suite à une recherche -->
                <div class="container">
                    <div class="row" id="number"></div>
                    <div class="row" id="trajets">
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
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
    <!-- Script js -->
    <script src="../js/accueil.js" defer></script>
    <script src="../js/trajet.js" defer></script>
    <script src="../js/ajax.js" defer></script>
</body>

</html>