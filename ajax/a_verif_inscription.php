<?php

session_start();

/*
  Crée le 19 déc. 2016, 14:46
  Auteur : Romain Jacquiez
  Nom du php : verifInscription
  But : Vérifier si les informations envoyées sont présentes sont correctes
 */

/*inclusion objet requete */
include '../objets/o_requete.php';
$objet = new o_requete();

/*varaible erreur pour savoir si on fait la requete*/
$erreur = false;

if (( isset($_GET['pseudo']) AND empty($_GET['pseudo']) ) || ((strlen($_GET['pseudo'])) > 20)) {        // verification du champ pseudo
    echo "Veuillez saisir un pseudo";
    $erreur = true;
} else if (( isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {   // verification du champ de l'adresse mail
    echo "Veuillez spécifier une adresse mail";
    $erreur = true;
} else if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$/i", $_GET['email'])) == 0) {          // verification de l'adresse mail pour savoir si elle est conforme a une adresse mail
    echo "L'adresse " . $_GET['email'] . " n'est pas valide</br>";
    $erreur = true;
} else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {          // verification du champ mot de passe
    echo "Veuillez spécifier un mot de passe";
    $erreur = true;
} else if (( isset($_GET['cmdp']) AND empty($_GET['cmdp']) ) || ((strlen($_GET['cmdp'])) > 50)) {       // verification de la copie de mot de passe
    echo "Veuillez spécifier une confirmaion de mot de passe";
    $erreur = true;
} else if ($_GET['mdp'] != $_GET['cmdp']) {                                                             // verification pour savoir si les deux mots de passe sont identique
    echo "Votre mot de passe et sa confirmation sont différents";
    $erreur = true;
}


if (isset($_GET['pseudo']) AND ! empty($_GET['pseudo'])AND                                                                           //* verification si tout les champ sont ok
        isset($_GET['mdp']) AND ! empty($_GET['mdp']) AND                                                                            //*
        isset($_GET['cmdp']) AND ! empty($_GET['cmdp']) AND                                                                          //*
        isset($_GET['email']) AND ! empty($_GET['email']) AND ( strlen($_GET['pseudo']) <= 20) AND ( strlen($_GET['mdp']) <= 50)     //*
        AND ( strlen($_GET['cmdp']) <= 50) AND ( strlen($_GET['email']) <= 100) AND ( $_GET['mdp'] == $_GET['cmdp'])) 
 { 

    $pseudo = $_GET['pseudo'];  //* creation des variables pour les metre dans la bdd
    $email = $_GET['email'];    //*
    $mdp = md5($_GET['mdp']);   //*
    $retour;
        
    /*si aucun messages d'erreur alors on insert*/
    if ($erreur != true)
    {
        $retour = $objet->insere_inscription($pseudo, $email, $mdp);
        /*je traite le retour de la methode pour qu'il correspond au data dans les test de formulaire.js*/
        if ($retour == "ok")
        {
            echo 'OK';
        }
    }
    
}
?>
