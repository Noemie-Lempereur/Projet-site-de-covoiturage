//permet d'affiche les trajets dont on est passager et ceux dont on est conducteur
ajaxRequest('GET', '../php/request.php/trajets', displayConducteur, 'function=get_trajetsConducteur');
ajaxRequest('GET', '../php/request.php/inscriptions', displayPassager, 'function=get_trajets_passagers');


//apres avoir supprime un trajet, on affiche de nouveau les listes des trajets avec la modification
function Afterdelete() {
    ajaxRequest('GET', '../php/request.php/trajets', displayConducteur, 'function=get_trajetsConducteur');
    ajaxRequest('GET', '../php/request.php/inscriptions', displayPassager, 'function=get_trajets_passagers');
}

//supprimer un trajet dont on est conducteur
$('#mestrajets').on('click', '.del', () => {
    ajaxRequest('DELETE', '../../php/request.php/trajets' + '?function=delete_trajet&idTrajet=' + $(event.target).closest('.del').attr('value'), Afterdelete);
});


//supprimer un trajet dont on est passager
$('#join_trajet').on('click', '.del2', () => {
    console.log("clic");
    console.log($(event.target).closest('.del2').attr('value'));
    ajaxRequest('DELETE', '../../php/request.php/inscriptions' + '?function=delete_inscription&trajet_id=' + $(event.target).closest('.del2').attr('value'), Afterdelete);
});

//Fonction permettant d'afficher les trajets dont on est conducteur sur la page /views/mestrajets.php
function displayConducteur(trajets) {
    $('#mestrajets').empty();
    let depart;
    let arrivee;
    let depart_time;
    let arrivee_time;
    for (i = 0; i < trajets.length; i++) {
        if (trajets[i].site_depart == true) {
            depart = trajets[i].nom;
            depart_time = displayTime(deleteDate(trajets[i].site_heure));
            arrivee = trajets[i].adresse + ', ' + trajets[i].ville;
            arrivee_time = displayTime(deleteDate(trajets[i].ville_heure));
        } else {
            depart = trajets[i].adresse + ', ' + trajets[i].ville;
            depart_time = displayTime(deleteDate(trajets[i].ville_heure));
            arrivee = trajets[i].nom;
            arrivee_time = displayTime(deleteDate(trajets[i].site_heure));
        }
        adresse = "../views/synthese.php?idTrajet=" + trajets[i].id;
        $('#mestrajets').append('<div class="container" style="color:black;margin-bottom:10px;" id="trajet"><div class="row"><div class="col-md-3"><label for="lieu_départ" style="font-weight:bold">Lieu de départ : ' + depart + ' </label></div>' +
            ' <div class="col-md-3"><label for="date_départ" style="font-weight:bold">Date de départ : ' + depart_time + ' ' + SortDate(trajets[i].date) + '</label></div>' +
            ' <div class="col-md-3"><label for="conducteur" style="font-weight:bold">Conducteur : ' + trajets[i].pseudo + '<br> Places restantes : ' + trajets[i].nb_passagers + '</label></div>' +
            ' <div class="col-md-3"><button class=" btn btnPopup btn-danger del" " style="float: right;text-decoration:none;font-weight:bold;color:white" value="' + trajets[i].id + '">Annuler</button></div></div><br>' +
            ' <div class="row"><div class="col-md-3"><label for="lieu_arrivée" style="font-weight:bold">Lieu d arrivée : ' + arrivee + ' </label></div>' +
            ' <div class="col-md-3"><label for="arrivee_prevue" style="font-weight:bold">Arrivée prévue : ' + arrivee_time + ' </label></div>' +
            ' <div class="col-md-3"><button type="button" class="btn btn-primary "><a style="text-decoration:none;font-weight:bold;color:white" href="' + adresse + '" >Voir synthese</a></button></div> ' +
            '<div class="col-md-3"><label for="prix" style="font-weight:bold;float: right;">Prix : ' + trajets[i].prix + '€</label></div></div></div>'
        );
    }
}

//Fonction permettant d'afficher les trajets dont on est passager sur la page /views/mestrajets.php
function displayPassager(trajets) {
    $('#join_trajet').empty();
    let depart;
    let arrivee;
    let depart_time;
    let arrivee_time;
    for (i = 0; i < trajets.length; i++) {
        if (trajets[i].site_depart == true) {
            depart = trajets[i].nom;
            depart_time = displayTime(deleteDate(trajets[i].site_heure));
            arrivee = trajets[i].adresse + ', ' + trajets[i].ville;
            arrivee_time = displayTime(deleteDate(trajets[i].ville_heure));
        } else {
            depart = trajets[i].adresse + ', ' + trajets[i].ville;
            depart_time = displayTime(deleteDate(trajets[i].ville_heure));
            arrivee = trajets[i].nom;
            arrivee_time = displayTime(deleteDate(trajets[i].site_heure));
        }
        adresse = "../views/synthese.php?idTrajet=" + trajets[i].id;
        $('#join_trajet').append('<div class="container" style="color:black;margin-bottom:10px;" id="trajet"><div class="row"><div class="col-md-3"><label for="lieu_départ" style="font-weight:bold">Lieu de départ : ' + depart + ' </label></div>' +
            ' <div class="col-md-3"><label for="date_départ" style="font-weight:bold">Date de départ : ' + depart_time + " " + SortDate(trajets[i].date) + '</label></div>' +
            ' <div class="col-md-3"><label for="conducteur" style="font-weight:bold">Conducteur : ' + trajets[i].pseudo + '<br> Places restantes : ' + trajets[i].nb_passagers + ' </label></div>' +
            ' <div class="col-md-3"><button class=" btn btnPopup btn-danger del2" " style="float: right;text-decoration:none;font-weight:bold;color:white" value="' + trajets[i].id + '">Annuler</button></div></div><br>' +
            ' <div class="row"><div class="col-md-3"><label for="lieu_arrivée" style="font-weight:bold">Lieu d arrivée : ' + arrivee + ' </label></div>' +
            ' <div class="col-md-3"><label for="arrivee_prevue" style="font-weight:bold">Arrivée prévue : ' + arrivee_time + ' </label></div>' +
            ' <div class="col-md-3"><button type="button" class="btn btn-primary"><a style="text-decoration:none;font-weight:bold;color:white" href="' + adresse + '" >Voir synthese</a></button></div> ' +
            '<div class="col-md-3"><label for="prix" style="font-weight:bold;float: right;">Prix : ' + trajets[i].prix + '</label></div></div></div>'
        );
    }
}