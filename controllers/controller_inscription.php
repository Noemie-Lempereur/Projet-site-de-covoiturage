<?php

include("../models/connexionBdd.php");
include("../models/etudiant.php");
include_once("models/lieu.php");
function addUser()
{
    $db = getConnexion();
    if (isset($_POST['tel']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordrepeat']) && isset($_POST['pseudo'])  && isset($_POST['nom']) && isset($_POST['prenom'])) {
        if ($_POST['password'] == $_POST['passwordrepeat']) {
            $tel = $_POST['tel'];
            $ville = $_POST['ville'];
            $ville = strtoupper($ville);
            $adresse = $_POST['adresse'];
            $adresse = strtoupper($adresse);
            //Verification de l'existence du lieu
            //RequeteSQL
            $query = 'SELECT COUNT(*) FROM lieu WHERE ville=:ville AND adresse=:adresse;';
            $statement = $db->prepare($query);
            //Parametres de la requête
            $statement->bindParam(':ville', $ville);
            $statement->bindParam(':adresse', $adresse);
            $statement->execute();
            //Recuperation du resultat
            if ($statement->fetch()['count'] != 0) {
                //Le lieu existe deja donc on veut recuperer l'id
                $idVille = getIDLieu($db, $ville, $adresse);
            } else {
                //Le lieu n'existe pas, on veut le creer
                //Creation d'un lieu à partir de la ville et l'adresse
                $idVille = createLieu($db, $ville, $adresse);
            }
            $email = $_POST['email'];
            $pseudo = $_POST['pseudo'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $nom =  $_POST['nom'];
            $prenom = $_POST['prenom'];
            if (createEtudiant($db, $pseudo, $password, $nom, $prenom, $email, $tel, $idVille) == true) {
                header("Location:/../views/accueil.php");
            }
        } else {
?>
            <script type="text/javascript">
                alert("Les mots de passe ne correspondent pas");
                location = "../views/inscription.php";
            </script>
<?php
        }
    }
}
//recuperer la fonction
$_GET['func']();

?>