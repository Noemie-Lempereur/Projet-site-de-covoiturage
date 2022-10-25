<?php

include_once("lieu.php");
session_start();

// Fonction qui renvoie la liste des etudiants
function getEtudiants($db)
{
    $query = 'SELECT * FROM etudiant';
    $statement = $db->prepare($query);
    $statement->execute();
    $etudiants = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $etudiants;
}

// Fonction qui renvoie un etudiant a partir de son pseudo
function getEtudiant($db, $pseudo)
{
    $query =  'SELECT etudiant.pseudo, etudiant.email, etudiant.nom, etudiant.prenom, etudiant.telephone,lieu.ville,lieu.adresse ';
    $query .= 'FROM etudiant INNER JOIN lieu ON etudiant.id_lieu=lieu.id ';
    $query .= 'WHERE etudiant.pseudo=:pseudo';
    $statement = $db->prepare($query);
    $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 50);
    $statement->execute();
    $etudiant = $statement->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}



// Ajout d'un etudiant dans la base de donnees
function createEtudiant($db, $pseudo, $password, $nom, $prenom, $email, $telephone, $id_lieu)
{
    // Verifier que le pseudo n'est pas utilise - sinon erreur (identifiant unique))
    if (!pseudoExist($db, $pseudo)) {
        // Recuperer le lieu a partir de la ville et de l'adresse
        $query =  'INSERT INTO etudiant (pseudo, password, nom, prenom, email, telephone, id_lieu) VALUES(:pseudo, :password_, :nom, :prenom, :email, :telephone, :id_lieu)';
        $statement = $db->prepare($query);

        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':password_', $password);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':telephone', $telephone);
        $statement->bindParam(':id_lieu', $id_lieu);
        $statement->execute();
        return true;
    } else {
?>
        <script type="text/javascript">
            alert("Pseudo déja utilisé");
            location = "../views/inscription.php";
        </script>
    <?php
    }
}

// Modification d'un etudiant dans la base de donnees
function updateEtudiant($db, $pseudo, $nom, $prenom, $email, $telephone)
{
    //

}


//Modification du mot de passe d'un etudiant
function updateMDPEtudiant($db, $pseudo, $password)
{
    try {
        $request = 'UPDATE etudiant SET password = :password where pseudo=:pseudo';
        $statement = $db->prepare($request);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        header('Location:/../views/profil.php');
    } catch (PDOException $exception) {
        error_log('Request error : ' . $exception->getMessage());
        return false;
    }
    return true;
}


// Fonction qui verifie que l'identification saisie est correcte 
function tryconnexion($db, $login, $mdp)
{
    $login = $_POST['login'];

    $statement = $db->query("SELECT COUNT(*) FROM etudiant where pseudo ='$login'");
    $result = $statement->fetchALL(PDO::FETCH_ASSOC);
    if ($result[0]['count'] == 0) {
    ?>
        <script type="text/javascript">
            alert("Pas d'utilisateur trouvé avec ce pseudo");
            location = "../views/connexion.php";
        </script>
    <?php
    }
    $request = "SELECT password from etudiant where pseudo =:pseudo";
    $statement = $db->prepare($request);
    $statement->bindParam(':pseudo', $login);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $hash = $result['password'];
    if (password_verify($mdp, $hash) == true) {
        getUserInfo($db,$login);
        //retourner a la page d'avant la connexion
        /*?>
        <script >
            window.history.go(-2);
        </script>
        <?php*/
        header('Location:/../views/accueil.php');
        exit();
    } else {
    ?>
        <script type="text/javascript">
            alert("Mauvais mot de passe");
            location = "../views/connexion.php";
        </script>
<?php
    }
}

// Fonction qui verifie si le login existe dans la base
function pseudoExist($db, $pseudo)
{
    $query = 'SELECT COUNT(*) FROM etudiant WHERE pseudo=:pseudo';
    $statement = $db->prepare($query);
    $statement->bindParam(':pseudo', $pseudo);
    $statement->execute([$pseudo]);
    return ($statement->fetch()['count'] != 0);
}


function getUserInfo($db,$login)
{

    $req = $db->query("SELECT * from etudiant where pseudo = '$login'");
    $req = $req->fetch();

    $_SESSION['pseudo'] = $req['pseudo'];
    $_SESSION['email'] = $req['email'];
    $_SESSION['nom'] = $req['nom'];
    $_SESSION['prenom'] = $req['prenom'];
    $_SESSION['password'] = $req['passord'];
    $_SESSION['telephone'] = $req['telephone'];
    $_SESSION['id_lieu'] = $req['id_lieu'];
}
