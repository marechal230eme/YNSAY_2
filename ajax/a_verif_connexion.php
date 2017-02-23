<?php

session_start();

/*
  Crée le 19 déc. 2016, 14:46
  Auteur : Romain Jacquiez
  Nom du php : verifConnexion
  But : Vérifier si les informations envoyées sont présentes dans la base de données
 */

if (( isset($_GET['pseudo']) AND empty($_GET['pseudo']) ) || ((strlen($_GET['pseudo'])) > 20)) {            // verification du champ du pseudo , si il est vide ou plus de 20 carcatères
    echo "Veuillez saisir un pseudo";
} else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {              //verification du champ du mot de passe , si il  est vide ou plus de 50 caractères
    echo "Veuillez spécifier un mot de passe";
}
if (isset($_GET['pseudo']) AND ! empty($_GET['pseudo'])AND
        isset($_GET['mdp']) AND ! empty($_GET['mdp']) AND ( strlen($_GET['pseudo']) <= 20) AND ( strlen($_GET['mdp']) <= 50)) { // si les champs sont ok alors
    try {
        $pseudo = $_GET['pseudo'];
        $mdp = md5($_GET['mdp']);

        $dbh = new PDO('mysql:host=localhost;dbname=ynsay', 'root', '');  // connection a la bdd
        $resultat = $dbh->query("SELECT id_utilisateur, pseudo, password FROM utilisateur ORDER BY id_utilisateur"); // requete sql pour savoir si l'on a un utilisateur connue
        $check = $resultat->fetch(PDO::FETCH_NUM);
        if ($check == true) {
            foreach ($resultat as $ligne) {
                if (($pseudo === $ligne['pseudo']) AND ( $mdp === $ligne['password'])) {  //verification du pseudo et du mot de passe
                    $_SESSION['connecte'] = true;                   //* création de variable de session pour naviguer entre les pages
                    $_SESSION['pseudo'] = $ligne['pseudo'];         //*
                    $_SESSION['id'] = $ligne['id_utilisateur'];     //*
                    echo '42';
                    break;
                }
            }
            if ($_SESSION['connecte'] != true) {                // si on ne trouve pas un utilisateur on affiche le message suivant
                echo 'Aucun compte ne correspond à ces données';
            }
        }
    } catch (PDOExeption $e) {                              //recupération des erreurs
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>


