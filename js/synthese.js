let urlParametres = new URLSearchParams(window.location.search);
//permet de faire la requete ajax pour la recherche de trajet

$id_trajet = urlParametres.get("idTrajet");
ajaxRequest('GET', '../php/request.php/trajets', nbPassagersTrajet, 'function=get_nb_places&idTrajet=' + $id_trajet);





function nbPassagersTrajet(trajet) {
    console.log("SYNTHESE");
    console.log(trajet.nb_passagers);
    if (trajet.nb_passagers > 0) {
        $synthese = true;
        ajaxRequest('GET', '../php/request.php/trajets', displaySynthese, 'function=get_trajet&id_trajet=' + trajet.id);
    } else {
        return false;
    }
}



//fonction pour obtenir le temps de trajet
function tempsTrajet(time1, time2) {
    //on enleve les +02 lié au décalage horaire
    let modif1 = time1.split(' ');
    let modif2 = time2.split(' ');
    //on divise l'heure en 3 tableaux, H M S
    let time_final1 = modif1[1].split(':');
    let time_final2 = modif2[1].split(':');
    //maintenant on recupere les heures et  minutes dans des variables a part(les secondes comptent peu)
    let heures1 = time_final1[0];
    let minutes1 = time_final1[1];

    let heures2 = time_final2[0];
    let minutes2 = time_final2[1];
    //desormais on convertit tous en int et minutes et on fait la difference
    var total1 = parseInt(heures1 * 60) + parseInt(minutes1);
    var total2 = parseInt(heures2 * 60) + parseInt(minutes2);

    let tempsTrajet = total1 - total2;
    if (tempsTrajet < 0) {
        tempsTrajet *= -1;
    }
    return tempsTrajet;
}

//fonction pour mettre la date dans l'ordre
function SortDate(date) {
    //pour récupérer l'année et le jour
    let tab = date.split("-");
    //pour avoir le mois en nom et pas en chiffre
    const mois = ["janvier", "fevrier", "mars", "avril", "mai", "juin",
        "juillet", "aout", "septembre", "octobre", "novembre", "decembre"
    ];
    var datemodif = new Date(date);
    return (tab[2] + " " + mois[datemodif.getMonth()] + " " + tab[0]);
}

function deleteDate(time1) {
    //on enleve les +02 lié au décalage horaire
    let modif = time1.split(' ');
    let new_time = modif[1];
    return new_time;
}
//fonction pour avoir l'heure en xxhxx et non XX:XX:XX
function displayTime(time) {
    let modif = time.split(':');
    let heures = modif[0];
    let minutes = modif[1];
    let temps = heures + 'h' + minutes;
    return temps;
}

//------------------------------------------------------------------------------
//--- Display functions --------------------------------------------------------
//------------------------------------------------------------------------------
//fonction qui affiche les infos dans synthese.php
function displaySynthese(trajets) {
    let depart;
    let arrivee;
    let depart_time;
    let arrivee_time;
    if (trajets.site_depart == true) {
        depart = trajets.nom;
        depart_time = displayTime(deleteDate(trajets.site_heure));
        arrivee = trajets.adresse + ', ' + trajets.ville;
        arrivee_time = displayTime(deleteDate(trajets.ville_heure));
    } else {
        depart = trajets.adresse + ', ' + trajets.ville;
        depart_time = displayTime(deleteDate(trajets.ville_heure));
        arrivee = trajets.nom;
        arrivee_time = displayTime(deleteDate(trajets.site_heure));
    }
    initMap(depart, arrivee);
    $('#synthese').append('<h1 class="text" style="color:white">Synthese de voyage</h1><br><br>' +
        '<div class="row"><label for="conducteur" class="col-sm-3 col-form-label" style="font-weight:bold;">Conducteur :</label><div class="col-md-4"><p id="conducteur">' + trajets.pseudo + '</p></div></div><br><br>' +
        '<div class="row"><label for="telephone" class="col-sm-3 col-form-label" style="font-weight:bold;">Téléphone :</label><div class="col-md-4"><p id="telephone">' + trajets.telephone + '</p></div></div><br><br>' +
        '<div class="row"><label for="rdv" class="col-sm-3 col-form-label" style="font-weight:bold;">Date du trajet :</label><div class="col-md-4"><p id="rdv">' + SortDate(trajets.date) + '</p></div></div><br><br>' +
        '<div class="row"><label for="lieu_départ" class="col-sm-3 col-form-label" style="font-weight:bold">Lieu de départ :</label><div class="col-md-4"><p id="lieu_départ">' + depart + '</p></div></div><br><br>' +
        '<div class="row"><label for="lieu_arrivee" class="col-sm-3 col-form-label" style="font-weight:bold;">Lieu d arrivée :</label><div class="col-md-4"><p id="lieu_arrivee">' + arrivee + '</p></div></div><br><br>' +
        '<div class="row"><label for="heure_depart" class="col-sm-3 col-form-label" style="font-weight:bold;">Heure de départ :</label><div class="col-md-4"><p id="heure_depart">' +
        depart_time + '</p></div></div><br><br>' +
        '<div class="row"><label for="heure_arrivée" class="col-sm-3 col-form-label" style="font-weight:bold;">Heure d arrivée :</label><div class="col-md-4"><p id="heure_arrivée">' + arrivee_time + ' </p></div></div><br><br>' +
        '<div class="row"><label for="temps_trajet" class="col-sm-3 col-form-label" style="font-weight:bold;">Temps de trajet :</label><div class="col-md-4"><p id="temps_trajet">' + tempsTrajet(trajets.ville_heure, trajets.site_heure) + ' min</p></div></div><br><br>' +
        '<div class="row"><label for="prix" class="col-sm-3 col-form-label" style="font-weight:bold;">Prix :</label><div class="col-md-4"><p id="prix">' + trajets.prix + '€</p></div></div><div class="row "><br><br></div>'
    );
}




//fonction pour afficher la map et le trajet
let map;

function initMap(depart, arrivee) {

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 47.5709, lng: -0.594299 },
        zoom: 8,
    });
    directionsDisplay.setMap(map);

    calculateAndDisplayRoute(directionsService, directionsDisplay, depart, arrivee);


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