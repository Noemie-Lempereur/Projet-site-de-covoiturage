//On recupere le bouton rechercher du fichier /views/accueil.php
let rechercheBouton = document.getElementById("btnNouvRech");

//S'il est defini alors on lui ajoute un evenement qui va permettre de lancer une fonction quand on clique sur le bouton
if (rechercheBouton) {
    rechercheBouton.addEventListener('click', fuRechercher);
}

let urlParametres = new URLSearchParams(window.location.search);
//permet de faire la requete ajax pour la recherche de trajet
function fuRechercher() {
    //On recupere les donnees de la page accueil grace aux ids
    let siteP = document.getElementById("partirSite").options[document.getElementById('partirSite').selectedIndex].text;
    let siteA = document.getElementById("arriverSite").options[document.getElementById('arriverSite').selectedIndex].text;
    let villeP = document.getElementById("partirVille").value;
    let villeA = document.getElementById("arriverVille").value;
    let date = document.getElementById("date_depart").value;
    let heure = document.getElementById("heure_depart").value;
    let site;
    let ville;

    let checkBox = document.getElementById("switch");
    //si la checkbox est active alors on arrive à un site sinon on part d'un site
    let site_depart = !checkBox.checked; //site_depart est un booleen, c'est une negation par rapport à la checkbox
    if (site_depart) { //si on part d'un site
        ville = villeA; //alors la ville est egale à la ville arrivee
        site = siteP; //et le site est egal au site de depart
    } else {
        ville = villeP; //sinon la ville est egale à la ville de depart
        site = siteA; //et le site est egal au site de depart
    }
    switch (site) {
        case "ISEN Brest": //car id de ISEN BREST=1
            site = 1;
            break;
        case 'ISEN Caen': //car id de ISEN CAEN=2
            site = 2;
            break;
        case 'ISEN Nantes': //car id de ISEN NANTES=3
            site = 3;
            break;
        case 'ISEN Rennes': //car id de ISEN RENNES=4
            site = 4;
            break;
    }

    ville = ville.toUpperCase();

    ajaxRequest('GET', '../php/request.php/trajets', displayTrajet, 'function=search_trajets&id_site=' + site + '&ville=' + ville + '&date=' + date + '&heure=' + heure + '&site_depart=' + site_depart);
}
//Pour faire la requete ajax pour recuperer la synthese du trajet
//On recupere le bouton de validation du trajet du fichier /views/valider.php
let valideBouton = document.getElementsByName('validation')[0];
let printBouton = document.getElementsByName('print')[0];
let retourBouton = document.getElementsByName('retour')[0];
let synthese = false;

//S'il est defini alors on lui ajoute un evenement qui va permettre de lancer une fonction quand on clique sur le bouton
if (valideBouton) {
    if (synthese == false) {
        fuValider();
    }
    valideBouton.addEventListener('click', fuSynthese);
}

//permet de faire la requete ajax pour la recuperation des informations d'un trajet
function fuValider() {
    console.log("VALIDER");
    //On recupere l'id du trajet grace à un GET
    $id_trajet = urlParametres.get("idTrajet");
    ajaxRequest('GET', '../php/request.php/trajets', displayValider, 'function=get_trajet&id_trajet=' + $id_trajet);
}

//permet de faire la requete ajax pour la recuperation des informations d'un trajet
function fuSynthese() {
    //On recupere l'id du trajet grace à un GET
    $id_trajet = urlParametres.get("idTrajet");
    ajaxRequest('GET', '../php/request.php/trajets', nbPassagersTrajet, 'function=get_nb_places&idTrajet=' + $id_trajet);
}

//si on n'a pas d'erreur alors on affiche ce message dans la console
function creationInscri() {
    console.log('Inscription au trajet reussie si pas deja inscrit');
}


function nbPassagersTrajet(trajet) {
    console.log("SYNTHESE");
    document.getElementById('gauche').style.display = "none";
    document.getElementById('droite').style.display = "none";
    console.log(trajet.nb_passagers);
    if (trajet.nb_passagers > 0) {
        $synthese = true;
        ajaxRequest('POST', '../php/request.php/inscriptions', creationInscri, 'function=create_inscription&trajet_id=' + trajet.id);
        ajaxRequest('GET', '../php/request.php/trajets', displaySynthese, 'function=get_trajet&id_trajet=' + trajet.id);
        valideBouton.style.display = "none";
        retourBouton.style.display = "none";
        printBouton.style.display = "block";
        //ajaxRequest('GET', '../php/request.php/trajets', modifnbPassagers, 'function=update_nb_places&idTrajet=' + trajet.id);
        //ajaxRequest('PUT', '../php/request.php/trajets', modifnbPassagers, 'idTrajet=' + trajet.id);
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



var menu = document.getElementById('menu');
//fonction display pour la page recherche UNIQUEMENT
function displayTrajet(trajets) {
    menu.style.display = "none";
    let animaux;
    let fumeur;
    let depart;
    let arrivee;
    let depart_time;
    let arrivee_time;
    $('#number').empty();
    $('#number').append('<h1>' + trajets.length + ' trajet(s) disponible(s) : </h1>');
    if (trajets.length == 0) {
        alert("Pas de covoiturage disponible ;(");
    }
    $('#trajets').empty();
    var carte = '';
    for (i = 0; i < trajets.length; i++) {
        if (i < 10) {
            if (trajets[i].animaux == true) {
                animaux = '<p class="text">Accepte les animaux</p>'
            } else {
                animaux = '<p class="text">Refuse les animaux</p>'
            }
            if (trajets[i].fumeur == true) {
                fumeur = '<p class="text">Fumeur</p>'
            } else {
                fumeur = '<p class="text">Non fumeur</p>'
            }
            if (trajets[i].site_depart == true) {
                depart = '<p class="text">Site de départ : ' + trajets[i].nom + '</p>';
                depart_time = displayTime(deleteDate(trajets[i].site_heure));
                arrivee = '<p class="text">Lieu arrivée : ' + trajets[i].adresse + ', ' + trajets[i].ville + '</p>'
                arrivee_time = displayTime(deleteDate(trajets[i].ville_heure));
            } else {
                depart = '<p class="text">Lieu de départ : ' + trajets[i].adresse + ', ' + trajets[i].ville + '</p>';
                depart_time = displayTime(deleteDate(trajets[i].ville_heure));
                arrivee = '<p class="text">Site arrivée : ' + trajets[i].nom + '</p>'
                arrivee_time = displayTime(deleteDate(trajets[i].site_heure));
            }
            adresse = "../views/valider.php?idTrajet=" + trajets[i].id;
            //on ajoute chaque element a afficher
            carte += '<div class = "col-sm-4" > ' +
                '<div class="container text-center" id="trajet" style="width: 20rem;height:auto;font-size:20px;margin-bottom:50px;">' +
                '<p class="text" style="float: left;margin-top: 5%;">' + trajets[i].prix + '€</p>' +
                '<p class="text" style="float: right;margin-top: 5%;">' + tempsTrajet(trajets[i].ville_heure, trajets[i].site_heure) + ' min </p>' +
                '<img src="../assets/img/allisdigital.jpg" width="150px" height="150px" class="rounded-circle" alt="image">' +
                '<h5 class="title">' + trajets[i].pseudo + '</h5>' +
                '<p class="text">' + depart_time + ' / ' + arrivee_time + '</p>' +
                '<p class="text">' + SortDate(trajets[i].date) + '</p>' +
                depart +
                arrivee +
                '<p class="text">' + trajets[i].nb_passagers + ' passagers</p>' +
                animaux + fumeur +
                '<a href="' + adresse + '" id="choisir"class="btn btn-primary" style="align-items: center;">Choisir</a>' +
                '</div></div></div>';


        }
    }
    //on affiche les resultats
    $('#trajets').append(carte);
}
//fonction display pour la page valider.php
function displayValider(trajets) {
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
    //affichage pour la partie gauche de la page
    initMap(depart, arrivee);
    $('#gauche').append('<div row style="font-weight:bold;"> <img src="../assets/img/tick_square2.png" alt="validé">  ' + depart + ' - ' + depart_time + '</div>' +
        '<div row ><img src="../assets/img/green-line.png" alt="line"></div>' +
        '<div row style="font-weight:bold;"><img src="../assets/img/tick_square2.png" alt="validé">  ' + arrivee + ' - ' + arrivee_time + '</div>' +
        '<div row ><img src="../assets/img/green-line.png" alt="line"></div>' +
        '<div row style="color:#0A82F1;font-weight:bold;"><img src="../assets/img/Clock.png" alt="temps">  ' + tempsTrajet(trajets.ville_heure, trajets.site_heure) + ' min</div>'
    );
    $('#droite').append('<div class="row"><p id="prix" class="text" style="margin-top: 10%;"> Prix : ' + trajets.prix + '€</p></div>' +
        '<img src="../assets/img/allisdigital.jpg" width="150px" height="150px" class="rounded-circle" alt="image">' +
        '<div class="row"><p id="conducteur" class="text-center"> Conducteur :</p><p id="nom_pre" class="text-center"> ' + trajets.pseudo + '</p></div>' +
        '<div class="col-md-12 text-center"><div class="row"><p id="tel" class="text"> Téléphone : ' + trajets.telephone + '</p></div>' +
        '<div class="row"><p id="rdv" class="text">Lieu de rendez-vous : ' + depart + '</p></div>' +
        '<div class="row"><p id="places" class="text"> Places restantes : ' + trajets.nb_passagers + '</p></div>' +
        '<div class="row"><p id="com" class="text"> Commentaire : ' + trajets.commentaire + '</p></div></div>'
    );
}
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
    $('#synthese').append('<h1  class="text" style="color:white;margin-bottom:50px;">Synthese de voyage</h1>' +
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