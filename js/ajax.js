//------------------------------------------------------------------------------
//--- ajaxRequest --------------------------------------------------------------
//------------------------------------------------------------------------------
// Ajax Request
// Type de requete (GET, DELETE, POST, PUT).
function ajaxRequest(type, url, callback, data = null) {
    let xhr;

    // Creer la requete XML HTTP
    xhr = new XMLHttpRequest();
    if (type == 'GET' && data != null)
        url += '?' + data;
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Add the onload function.
    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
                console.log(xhr.responseText);
                callback(JSON.parse(xhr.responseText));
                break;
            default:
                httpErrors(xhr.status);
        }
    };

    // Envoie la requete XML HTTP
    xhr.send(data);
}

//------------------------------------------------------------------------------
//--- httpErrors ---------------------------------------------------------------
//------------------------------------------------------------------------------
// Affiche un message d'erreur
function httpErrors(errorCode) {
    let messages = {
        400: 'Requête incorrecte',
        401: 'Authentifiez vous',
        403: 'Accès refusé',
        404: 'Page non trouvée',
        500: 'Erreur interne du serveur',
        503: 'Service indisponible'
    };

    if (errorCode in messages) {
        $('#errors').html('<strong>' + messages[errorCode] + '</strong>');
        $('#errors').show();
        setTimeout(() => {
            $('#errors').hide();
        }, 5000);
    }
}