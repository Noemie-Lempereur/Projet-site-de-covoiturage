<!DOCTYPE html>
<html lang="fr">

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

<body class="wrapper" id="bodyID">
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
                            S'identifier
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="compte">
                            <li><a class="dropdown-item" href="inscription.php">Inscription</a></li>
                            <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                        </ul>
            </div>
    </nav>
    <!--corps de page-->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Créez votre compte</h2>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-6 p-4">
                            <form method="post" action="../controllers/controller_inscription.php?func=addUser">
                                <div class="form-group">
                                    <label for="prenom" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_account_circle_black_24dp.png" alt="icon">Prénom</label>
                                    <input id="prenom" type="text" class="form-control" name="prenom"
                                        placeholder="Entrez votre prénom" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="nom" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_account_circle_black_24dp.png" alt="icon">Nom</label>
                                    <input id="nom" type="text" class="form-control" name="nom"
                                        placeholder="Entrez votre nom" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_email_black_24dp.png" alt="icon">Adresse mail</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        placeholder="Entrez votre adresse mail" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="tel" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_smartphone_black_24dp.png" alt="icon">Numéro de telephone</label>
                                    <input id="tel" type="text" class="form-control" name="tel"
                                        placeholder="0102030405" required>
                                </div>

                        </div>
                        <div class="col-6 p-4">

                            <div class="form-group">
                                <label for="ville" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_location_on_black_24dp.png" alt="icon">Ville</label>
                                <input id="ville" type="text" class="form-control" name="ville"
                                    placeholder="Entrez votre ville" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="adresse" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_location_on_black_24dp.png" alt="icon">Adresse</label>
                                <input id="adresse" type="text" class="form-control" name="adresse"
                                    placeholder="Entrez votre adresse" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_lock_black_24dp.png" alt="icon">Mot de passe</label>
                                <input id="password" type="password" class="form-control" name="password"
                                    placeholder="Entrez votre mot de passe" required>
                                <br>
                                <span style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_lock_black_24dp.png" alt="icon">Confirmer votre mot de passe</span>  
                                <br>
                                <input type="password" class="form-control" name="passwordrepeat"
                                    placeholder="Entrez de nouveau votre mot de passe" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 p-2"></div>
                            <div class="col-6 p-2">
                                <div class="form-group">
                                    <label for="pseudo" style="font-weight: bold;font-size: 20px;"><img src="../assets/img/outline_account_circle_black_24dp.png" alt="icon">Pseudonyme</label>
                                    <input id="pseudo" type="text" class="form-control" name="pseudo"
                                        placeholder="Entrez votre pseudonyme" required>
                                </div>
                            </div>
                            <div class="col-3 p-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-4 p-0"></div>
                            <div class="col-4 p-0">
                                <small id="help" class="form-text text-muted">Vos informations restent
                                    confidentielles.</small>
                                <div class="col-4 p-0"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 p-0"></div>
                            <div class="col-3 p-0">
                                <button type="submit" class="btn btn-primary" style="background: #023062;border-radius: 10px;color:white;">S'inscrire</button>
                                </form>
                                <div class="col-4 p-0"></div>
                            </div>
                        </div>

                    </div>
                </div>
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