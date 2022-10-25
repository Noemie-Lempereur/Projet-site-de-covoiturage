//Script js pour le fichier accueil.php et resultats_recherche.php

//Pour l'accueil, il faut faire un bouton qui change l'affichage en fonction du choix
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
        //partirAdresse.style.display = "block";
        arriverSite.style.display = "block";
        arriverVille.style.display = "none";
        //arriverAdresse.style.display = "none";
    } else {
        //si elle est désactivée alors c'est l'option partir d'un site de l'ISEN et arriver dans une ville :

        //on affiche le texte dans le textCheckbox pour dire que l'option choisie est partir d'un site de l'ISEN
        textCheckbox.innerHTML = "Partir d'un site de l'ISEN";

        //on affiche les inputs partirSite et arriverVille
        //on cache les inputs partirVille et arriverSite
        partirSite.style.display = "block";
        partirVille.style.display = "none";
        //partirAdresse.style.display = "none";
        arriverSite.style.display = "none";
        arriverVille.style.display = "block";
        //arriverAdresse.style.display = "block";
    }
}