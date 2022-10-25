//Script js pour le fichier proposertrajet.js

//Pour proposertrajet, il faut faire un bouton qui change l'affichage en fonction du choix
//de l'utilisateur entre partir d'un site de l'Isen ou arriver à un site de l'Isen

//on recupere la checkbox qui a l'id switch
var checkBox = document.getElementById("switch");

//pour permettre de lancer la fonction checkboxFunction des qu'on clique sur la checkbox
checkBox.addEventListener('click', checkboxFunction);


//Fonction qui permet de modifier l'affichage des que l'utilisateur clique sur le switch
function checkboxFunction() {

    //on recupere le texte qui s'affiche à cote de la checkbox qui a l'id textCheckbox
    var textCheckbox = document.getElementById("textCheckbox");

    //on recupere l'input qui correspond à partir d'un site de l'Isen
    var partirSite = document.getElementById("partirSite");

    //on recupere l'input qui correspond à partir d'une ville et d'une adresse
    var partirVille = document.getElementById("partirVille");
    var partirAdresse = document.getElementById("partirAdresse");
    //on recupere l'input qui correspond à arriver à un site de l'Isen
    var arriverSite = document.getElementById("arriverSite");

    //on recupere l'input qui correspond à partir à arriver dans une ville et d'une adresse
    var arriverVille = document.getElementById("arriverVille");
    var arriverAdresse = document.getElementById("arriverAdresse");

    //on regarde si la checkbox est activé
    if (checkBox.checked == true) {
        //si elle est active alors c'est l'option partir d'une ville et arriver à un site de l'Isen :

        //on affiche le texte dans le textCheckbox pour dire que l'option choisie est arriver à un site de l'ISEN
        textCheckbox.innerHTML = "Arriver à un site de l'ISEN";

        //on cache les inputs partirSite et arriverVille
        //on affiche les inputs partirVille et arriverSite
        partirSite.style.display = "none";
        partirVille.style.display = "block";
        partirAdresse.style.display = "block";
        arriverSite.style.display = "block";
        arriverVille.style.display = "none";
        arriverAdresse.style.display = "none";
    } else {
        //si elle est désactivée alors c'est l'option partir d'un site de l'ISEN et arriver dans une ville :

        //on affiche le texte dans le textCheckbox pour dire que l'option choisie est partir d'un site de l'ISEN
        textCheckbox.innerHTML = "Partir d'un site de l'ISEN";

        //on affiche les inputs partirSite et arriverVille
        //on cache les inputs partirVille et arriverSite
        partirSite.style.display = "block";
        partirVille.style.display = "none";
        partirAdresse.style.display = "none";
        arriverSite.style.display = "none";
        arriverVille.style.display = "block";
        arriverAdresse.style.display = "block";
    }
}

//Pour faire la requete ajax d'ajout de trajet
//On recupere le bouton rechercher du fichier /views/proposertrajet.php
let proposeBouton = document.getElementsByName('btnSubmit')[0];

//S'il est defini alors on lui ajoute un evenement qui va permettre de lancer une fonction quand on clique sur le bouton
if (proposeBouton) {
    proposeBouton.addEventListener('click', fuProposer);
}


function fuProposer() {

    //On recupere les donnees de la page proposertrajet grace aux ids
    let siteP = document.getElementById("partirSite").options[document.getElementById('partirSite').selectedIndex].text;
    let siteA = document.getElementById("arriverSite").options[document.getElementById('arriverSite').selectedIndex].text;
    let villeP = document.getElementById("partirVille").value;
    let villeA = document.getElementById("arriverVille").value;
    let adresseP = document.getElementById("partirAdresse").value;
    let adresseA = document.getElementById("arriverAdresse").value;
    let dateP = document.getElementById("date_depart").value;
    let dateA = document.getElementById("arrivee").value;
    let heureP = document.getElementById("time_depart").value;
    let heureA = document.getElementById("time_arrivee").value;
    let nbPlaces = document.getElementById("nbPass").value;
    let animaux = document.querySelector('input[name="animaux"]:checked').value
    let fumeur = document.querySelector('input[name="fumeur"]:checked').value
    let commentaire = document.getElementById("idCommentaire").value
    let prix = document.getElementById("idPrix").value

    //on definit des variables generales qui ne dependent pas de l'arrivee et du depart
    let site;
    let ville;
    let adresse;
    let site_heure;
    let ville_heure;

    //on recupere les donnees de la checkbox (depart d'un site ou arrivee à un site)
    let checkBox = document.getElementById("switch");
    let site_depart = !checkBox.checked;
    if (site_depart) {
        //si le site est le lieu de depart alors on defini les variables en partant du site
        site_heure = dateP + " " + heureP;
        ville_heure = dateA + " " + heureA;
        ville = villeA;
        adresse = adresseA;
        site = siteP;
    } else {
        //sinon on defini les variables en partant du lieu
        site_heure = dateA + " " + heureA;
        ville_heure = dateP + " " + heureP;
        ville = villeP;
        adresse = adresseP;
        site = siteA;
    }
    //on recupere l'id du site
    switch (site) {
        case "ISEN Brest":
            site = 1;
            break;
        case 'ISEN Caen':
            site = 2;
            break;
        case 'ISEN Nantes':
            site = 3;
            break;
        case 'ISEN Rennes':
            site = 4;
            break;
    }
    //on met en majuscule les chaines de caracteres pour permettre d'avoir des données uniforme dans la BDD
    ville = ville.toUpperCase();
    adresse = adresse.toUpperCase();

    //on verifie que le formulaire a les infos nécessaires
    if (dateP == '' || dateA == '' || nbPlaces == null || prix == null || heureP == "" || heureA == "" || site == '' || ville == '' || adresse == '') {
        alert('Il manque des informations pour créer un trajet');
        //on reste sur le formulaire
        location = '../views/proposertrajet.php';
    } else {
        //on peut faire la requete ajax
        ajaxRequest('POST', '../php/request.php/trajets', nulle, 'function=create_trajet&date=' + dateP + '&nb_passagers=' + nbPlaces + '&prix=' + prix + '&site_depart=' + site_depart + '&fumeur=' + fumeur + '&animaux=' + animaux + '&site_heure=' + site_heure + '&ville_heure=' + ville_heure + '&commentaire=' + commentaire + '&idSite=' + site + '&ville=' + ville + '&adresse=' + adresse);
    }
}

function nulle(trajets) {
    console.log("Bien créé");
    //on va à la page de resume des trajets
    location = "../views/mestrajets.php";
}


//on utilise jquery pour recuperer les infos nécessaires

var depart = "";
var arrivee = "";
//a chaque clic sur l'element body de la page
$(document).ready(function() {
    $("#body").click(function() {
        //on regarde d'ou on part et ou on arrive
        let checkBox = document.getElementById("switch");
        let site_depart = !checkBox.checked;
        if (site_depart) {
            //si le site est le lieu de depart alors on defini les variables en partant du site
            let siteP = document.getElementById("partirSite").options[document.getElementById('partirSite').selectedIndex].text;
            depart = siteP;
            let ville_arriver = document.getElementById("arriverVille").value;
            let adresse_arriver = document.getElementById("arriverAdresse").value;
            arrivee = ville_arriver + adresse_arriver;
        } else {
            //sinon on defini les variables en partant du lieu
            let siteA = document.getElementById("arriverSite").options[document.getElementById('arriverSite').selectedIndex].text;
            let partir_ville = document.getElementById("partirVille").value;
            let partir_adresse = document.getElementById("partirAdresse").value;
            depart = partir_ville + partir_adresse;
            arrivee = siteA;
        }
        //si le depart n'est pas vide ni l'arrivee, on affiche sur la carte
        if (depart != "" && arrivee != "") {
            let heure_dep = document.getElementById('time_depart').value;
            initMap(depart, arrivee, heure_dep);
        }
    });
});
//variable pour la carte maps
let map;
//variables qui vont garder "en memoire" le depart et arrivee d'avant
let a;
let d;
let h;

function initMap(depart, arrivee, heure_dep) {

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    //si la map n'est pas defini on l'affiche, si le nouveau depart est different de l'ancien on affiche une nouvelle carte, idem pour l'arrive
    if (map === undefined || depart != d || a != arrivee || d === undefined || a === undefined) {
        //on definit les nouvelles variables qui serviront a verifier
        d = depart;
        a = arrivee;
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 47.5709, lng: -0.594299 },
            zoom: 8,
        });
        //on affiche la map
        directionsDisplay.setMap(map);
        //on affiche la route pour le nouveau depart / arrivee
        calculateAndDisplayRoute(directionsService, directionsDisplay, depart, arrivee);
        if (heure_dep != "") {
            arriveePrevue(directionsService, directionsDisplay, depart, arrivee, h);
        }
    }
    if (heure_dep != "" && h != heure_dep) {
        h = heure_dep;
        arriveePrevue(directionsService, directionsDisplay, depart, arrivee, h);
    }

}
//fonction pour afficher l'arrivée prevue
function arriveePrevue(directionsService, directionsDisplay, depart, arrivee, heure) {
    directionsService.route({
        origin: depart,
        destination: arrivee,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            var sp = heure.split(':');
            let trajet_secondes = response.routes[0].legs[0].duration.value;
            let depart_secondes = parseInt(sp[0] * 3600) + parseInt(sp[1] * 60);
            let total_secondes = trajet_secondes + depart_secondes;
            let total_minutes = total_secondes / 60;
            //on convertit les minutes en h
            var heures_dec = (total_minutes / 60);
            var heure_ent = Math.floor(heures_dec);
            var min = (heures_dec - heure_ent) * 60;
            var min_ent = Math.round(min);
            const ap = document.getElementById('ap');
            if (min_ent < 10) {
                min_ent = '0' + min_ent;
            }
            ap.innerHTML = (heure_ent + 'h' + min_ent);
        } else {
            window.alert('Fail')
        }
    });
}



//pour afficher le trajet a suivre
function calculateAndDisplayRoute(directionsService, directionsDisplay, depart, arrivee) {
    directionsService.route({
        origin: depart,
        destination: arrivee,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            //si jamais on veut le temps de trajet d'apres google
            const output = document.getElementById("output");
            const distance = document.getElementById("distance");
            distance.innerHTML = response.routes[0].legs[0].distance.text;
            output.innerHTML = response.routes[0].legs[0].duration.text;

        } else {
            window.alert('Fail')
        }
    });

}