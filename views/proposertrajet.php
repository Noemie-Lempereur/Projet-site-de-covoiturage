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
    <link href="../assets/css/proposertrajet.css" rel="stylesheet" />
    <link href="../assets/css/application.css" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../assets/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</head>

<body id="body" class="wrapper">
    <!-- Bandeau de navigation-->
    <nav class="navbar navbar-dark fixed-top navbar-expand-md" id="backBleu">
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
    <!--corps de page-->

    <a href="accueil.php" id="btn" style="width:auto;height:auto;margin-top: 5%;margin-left:5%;"
        class="btn btn-primary">Retour à l'accueil</a>
    <br><br>
    <div class="container contact-form">
        <form action="..." method="post">
            <h3>Proposer un trajet</h3>
            <div class="form-group row">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="switch">
                    <label class="form-check-label" for="switch" name=textSwitch id="textCheckbox">Partir d'un
                        site de
                        l'ISEN</label>
                </div>
            </div>
            <br><br><br>

            <div class="form-group row">
                <label for="départ" class="col-sm-3 col-form-label" style="font-weight:bold;">Lieu de départ :</label>
                <div class="col-md-4">
                    <select class="form-control" id="partirSite">
                        <option>ISEN Brest</option>
                        <option>ISEN Caen</option>
                        <option>ISEN Nantes</option>
                        <option>ISEN Rennes</option>
                    </select>
                    <input type="text" class="form-control" id="partirVille" placeholder="Entrez la ville de depart"
                        style="display: none;" required>

                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="partirAdresse" placeholder="Adresse de départ"
                        style="display:none;" required>
                </div>

            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="arrivée" class="col-sm-3 col-form-label" style="font-weight:bold;">Lieu d'arrivée :</label>
                <div class="col-md-4">
                    <select class="form-control" id="arriverSite" style="display: none;">
                        <option>ISEN Brest</option>
                        <option>ISEN Caen</option>
                        <option>ISEN Nantes</option>
                        <option>ISEN Rennes</option>
                    </select>
                    <input type="text" class="form-control" id="arriverVille"
                        placeholder="Entrez la ville de destination" required>

                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="arriverAdresse" placeholder="Adresse de destination"
                        required>

                </div>
                
            </div>

            <br><br><br>
            <div class="form-group row">
                <label for="places" class="col-sm-4 col-form-label" style="font-weight:bold;">Nombre de places
                    disponibles :</label>
                <div class="col-md-4">
                    <input type="number" id="nbPass" name="passagers" class="form-control" style="width:4rem;"
                        placeholder="" value="1" min="1" et max="10" required />

                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="date_depart" class="col-sm-3 col-form-label" style="font-weight:bold;">Date de départ
                    :</label>
                <div class="col-md-3">
                    <input type="date" id="date_depart" name="Date de départ :" class="form-control" placeholder=""
                        value="" required />

                </div>
                <script type="text/javascript">
                date_depart.min = new Date().toISOString().split("T")[0];
                </script>
                <div class="col-md-3">
                    <input type="time" id="time_depart" name="time_depart :" class="form-control" placeholder=""
                        value="" required />
                        <p style="font-weight:bold;"> Arrivée prévue : <span style="font-weight:bold;" id="ap"></span></p>
                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="arrivée_prévue" class="col-sm-3 col-form-label" style="font-weight:bold;">Arrivée prévue
                    :</label>
                <div class="col-md-3">
                    <input type="date" id="arrivee" name="arrivée_prévue" class="form-control" placeholder="" value=""
                        required />

                </div>
                <script type="text/javascript">
                arrivee.min = new Date().toISOString().split("T")[0];
                </script>
                <div class="col-md-3">
                    <input type="time" id="time_arrivee" name="time_arrivee :" class="form-control" placeholder=""
                        value="" required />
                </div>

            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="animaux" class="col-sm-3 col-form-label" style="font-weight:bold;">Animaux :</label>
                <div class="col-md-4">
                    <input type="radio" name="animaux" value="true"> Oui </input>
                    <input type="radio" name="animaux" value="false" checked> Non </input>
                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="fumeur" class="col-sm-3 col-form-label" style="font-weight:bold;">Fumeur :</label>
                <div class="col-md-4">
                    <input type="radio" name="fumeur" value="true"> Oui </input>
                    <input type="radio" name="fumeur" value="false" checked> Non </input>
                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="commentaire" class="col-sm-3 col-form-label" style="font-weight:bold;">Commentaire :</label>
                <div class="col-md-4">
                    <input type="textarea" id="idCommentaire" name="commentaire" class="form-control" placeholder=""
                        value="" />
                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <label for="prix" class="col-sm-1 col-form-label" style="font-weight:bold;">Prix</label>
                <div class="col-md-4">
                    <input type="number" min="0" step="0.5" style="width:5rem;" id="idPrix" name="prix"
                        class="form-control" placeholder="" value="0" required />
                </div>
            </div>
            <br><br><br>
            <div class="form-group row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <input type="button" id="btn" name="btnSubmit" class="btn btn-primary" value="Publier" />
                </div>
            </div>
            <div class="form-group row" style="margin-top:50px;">
                <div id="map" style="height:300px;width:300px;background-color:grey;border-radius:10%"></div>
                <p style="font-weight:bold;"> Estimation temps de trajet d'après Google Maps : <span id="output"
                    style="font-weight:bold;"></span></p>
                    <p style="font-weight:bold;"> Distance du trajet :<span style="font-weight:bold;" id="distance"></span>
            </div> </p>
        </form>
        
    </div>
    <br><br><br><br>
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
</body>
<!-- Bootstrap core JS-->
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXOcXnVqNIu99yo36S4poXOTSqr1E-Cbc"></script>
<script src="../assets/dist/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../js/ajax.js"></script>
<script src="../js/proposertrajet.js"></script>




</html>