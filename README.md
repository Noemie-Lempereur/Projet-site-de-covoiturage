# Covoit'ISEN

Le site de covoiturage des étudiants de l'ISEN Ouest.

## Sommaire
1. [Informations generales](#informations-generales)
2. [Utilisation](#utilisation)
3. [Technologies](#technologies)
4. [Architecture](#architecture)


## Informations generales
***
Ce projet a pour objectif de concevoir et développer une application web de covoiturage à destination des étudiants des quatre sites de l’ISEN Yncréa Ouest.
Cette application sécurisée permet de proposer un trajet, de rechercher un trajet et de réserver une place dans un véhicule.

### Screenshot
1) L'accueil :
![page d'accueil](/html/assets/img/accueil.jpg)

2) La recherche de trajet
![exemple recherche de trajets](/html/assets/img/.jpg)

3) La synthese du trajet
![exemple synthese d'un trajet](/html/assets/img/.jpg)

4) La liste de nos trajets (conducteur et passager)
![exemple liste des trajets](/html/assets/img/.jpg)

## Utilisation
***
 L'application est accessible à l'adresse [https://35.195.248.5/](https://35.195.248.5/).
 
 1 - Pour rechercher un trajet (possibilité de le faire sans s'être connecté) :
 * Renseigner les champs de recherche
 * Cliquer sur le bouton "Rechercher" pour voir la liste des trajets correspondants ayant encore au moins une place disponible

 2 - Pour réserver une place (connexion nécessaire):
 * Sur la liste des trajets, sélectionner un trajet
 * Cliquer sur "Choisir" pour voir le détail du trajet
 * Si vous êtes deja connecté : cliquer sur le bouton "Valider" pour finaliser la réservation. Vous êtes maintenant inscrit au trajet ! N'hésitez pas à imprimer la synthèse.
 * Si vous n'êtes pas connecté : il faut se connecter ou créer son compte le cas échéant. Puis recommencer la procédure. {1}

 3 - Pour proposer un trajet (connexion nécessaire):
 * Se connecter ou créer son compte le cas échéant
 * Cliquer sur le menu "Proposer un trajet"
 * Remplisser le formulaire
 * Cliquer sur "Publier". Vous avez reussi à publier votre trajet !

 4 - Pour consulter ses trajets (connexion nécessaire):
 * Cliquer sur votre pseudo (en haut à droite)
 * Cliquer sur mes trajets
 * Vos trajets sont affichés (en tant que conducteur et passager)

 5 - Pour annuler un trajet (connexion nécessaire):
 * Il faut aller dans mes trajets (suivre la procédure pour consulter ses trajets {4})
 * Cliquer sur annuler. N'oubliez pas que si vous êtes le conducteur, une annulation peut-être compliqué pour vos passagers et si vous êtes passager, vous pouvez prendre la place d'un autre étudiant.

 6 - Pour consulter les informations détaillées sur un trajet où on est deja inscrit (connexion nécessaire):
 * Il faut aller dans mes trajets (suivre la procédure pour consulter ses trajets {4})
 * Cliquer sur synthese. Vous pouvez également imprimer le résumé.

 
## Technologies
***
Voici la liste des technologies utilisées dans le projet:
* Apache: Version 2.4.38
* PostgreSQL: Version 11.12
* PHP: Version 7.3.27
* JQuery: Version 3.4.1
* Bootstrap: Version 4
* Zend Engine v3.3.27

***
Le fichier permettant la création de la base SQL se trouve dans /assets/sql/create_bdd.sql


## Utilisateur
***
Pour tester toutes les fonctionnalités du projet vous pouvez utilisé:
* Pseudonyme : visiteur
* Mot de passe : test

## Architecture
***

/var/www/html
  * assets
    * css
        * application.css
        * btn.css
        * mestrajets.css
        * profil.css
        * proposertrajet.css
        * recherche.css
    * dist
        * bootstrap
    * img
        * accueil.jpg
        * allisdigital.jpg
        * anonyme.jpg
        * car.png
        * Clock.png
        * favicon.ico
        * green-line.png
        * isenBrest.jpg
        * isenCaen.jpg
        * isenNantes.jpg
        * isenRennes.jpg
        * logo.png
        * logo2.png
        * outline_account_circle_black_24dp.png
        * outline_email_black_24dp.png
        * outline_location_on_black_24dp.png
        * outline_lock_black_24dp.png
        * outline_smartphone_black_24dp.png
        * pp.png
        * tick_square2.png
        * user.jpg
    * sql
        * bdd_test.sql
        * create_bdd.sql
  * controllers
    * controller_inscription.php
    * controller_login.php
    * controller_modif.php
  * js
    * accueil.js
    * ajax.js
    * mestrajets.js
    * proposertrajet.js
    * synthese.js
    * trajet.js
  * models
    * connexionBdd.php
    * etudiant.php
    * lieu.php
    * rejoindre.php
    * site.php
    * trajet.php
  * php
    * request.php
  * views
    * accueil.php
    * connexion.php
    * deconnexion.php
    * donnees_personnelles.php
    * inscription.php
    * mentions_legales.php
    * mestrajets.php
    * modifierMDP.php
    * modifierprofil.php
    * profil.php
    * proposertrajet.php
    * synthese.php
    * valider.php
  * constants.php
  * index.php
  * README.md

