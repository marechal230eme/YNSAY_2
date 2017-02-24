<?php

session_start();

/*
  Crée le 19 déc. 2016, 14:46
  Auteur : Romain Jacquiez
  Nom du php : verifConnexion
  But : Vérifier si les informations envoyées sont présentes dans la base de données
 */

/*inclusion objet requete */
include '../objets/o_requete.php';
$objet = new o_requete();
/*------------------------------*/

/*varaible erreur pour savoir si on fait la requete*/
$erreur = false;

if (( isset($_GET['pseudo']) AND empty($_GET['pseudo']) ) || ((strlen($_GET['pseudo'])) > 20)) {            // verification du champ du pseudo , si il est vide ou plus de 20 carcatères
    echo "Veuillez saisir un pseudo";
    $erreur = true;
} else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {              //verification du champ du mot de passe , si il  est vide ou plus de 50 caractères
    echo "Veuillez spécifier un mot de passe";
    $erreur = true;
}
if (isset($_GET['pseudo']) AND ! empty($_GET['pseudo'])AND
        isset($_GET['mdp']) AND ! empty($_GET['mdp']) AND ( strlen($_GET['pseudo']) <= 20) AND ( strlen($_GET['mdp']) <= 50)) 
{ // si les champs sont ok alors

    $pseudo = $_GET['pseudo'];  //* creation des variables pour les metre dans la bdd
    $mdp = md5($_GET['mdp']);   //*
    $retour;
        
    /*si aucun messages d'erreur alors on insert*/
    if ($erreur != true)
    {
        $retour = $objet->recupere_connexion($pseudo, $mdp);
        /*je traite le retour de la methode pour qu'il correspond au data dans les test de formulaire.js*/
        if ($retour === "ok")
        {
            echo '42';
        } else {
            echo "Aucun résultat trouvé";
        }
    }
}
?>

