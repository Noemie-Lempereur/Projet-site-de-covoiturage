<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
include "../models/connexionBdd.php";
  $db = getConnexion();
  if($_SESSION['pseudo']== NULL){
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
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="compte" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['pseudo'];?>
                        </a>
                        <ul class="dropdown-menu dropleft" aria-labelledby="compte">
                            <li><a class="dropdown-item" href="../views/profil.php">Mon profil</a></li>
                            <li><a class="dropdown-item" href="../views/mestrajets.php">Mes trajets</a></li>
                            <li><a class="dropdown-item" href="../views/deconnexion.php">Deconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row justify-content-center">
            <div class="col-md-1">
                <button type="button" class="btnBleu"> <a class="enleverDeco" href="profil.php">Retour au
                        profil</a></button>
            </div>
            <div class="col-md-8">
                <h2>Modifier mon profil</h2>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-6 p-4">
                            <form method="post">
                                <div class="form-group">
                                    <label for="pseudo">Pseudonyme</label>
                                    <input id="pseudo" type="text" class="form-control" name="pseudo" value="pseudo"
                                        required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email">Adresse mail</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="prenom.nom@email.fr" required>
                                </div>
                        </div>
                        <div class="col-6 p-4">
                            <div class="form-group">
                                <label for="tel">Numéro de telephone</label>
                                <input id="tel" type="text" class="form-control" name="tel" value="06XXXXXXXX" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input id="ville" type="text" class="form-control" name="ville" value="VILLE" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 p-2"></div>
                            <div class="col-6 p-2">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input id="adresse" type="text" class="form-control" name="adresse"
                                        value="35 AVENUE DU CHAMP DE MANOEUVRE" required>
                                </div>
                            </div>
                            <div class="col-3 p-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-5 p-0"></div>
                            <div class="col-3 p-0">
                                <br>
                                <button type="submit" class="btnBleu">Confirmer les modifications</button>
                                </form>
                                <div class="col-4 p-0"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
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
</body>

</html>