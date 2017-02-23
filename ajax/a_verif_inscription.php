<?php

session_start();

/*
  Crée le 19 déc. 2016, 14:46
  Auteur : Romain Jacquiez
  Nom du php : verifInscription
  But : Vérifier si les informations envoyées sont présentes sont correctes
 */


if (( isset($_GET['pseudo']) AND empty($_GET['pseudo']) ) || ((strlen($_GET['pseudo'])) > 20)) {        // verification du champ pseudo
    echo "Veuillez saisir un pseudo";
} else if (( isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {   // verification du champ de l'adresse mail
    echo "Veuillez spécifier une adresse mail";
} else if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$/i", $_GET['email'])) == 0) {          // verification de l'adresse mail pour savoir si elle est conforme a une adresse mail
    echo "L'adresse " . $_GET['email'] . " n'est pas valide";
} else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {          // verification du champ mot de passe
    echo "Veuillez spécifier un mot de passe";
} else if (( isset($_GET['cmdp']) AND empty($_GET['cmdp']) ) || ((strlen($_GET['cmdp'])) > 50)) {       // verification de la copie de mot de passe
    echo "Veuillez spécifier une confirmaion de mot de passe";
} else if ($_GET['mdp'] != $_GET['cmdp']) {                                                             // verification pour savoir si les deux mots de passe sont identique
    echo "Votre mot de passe et sa confirmation sont différents";
}

if (isset($_GET['pseudo']) AND ! empty($_GET['pseudo'])AND                                                                           //* verification si tout les champ sont ok
        isset($_GET['mdp']) AND ! empty($_GET['mdp']) AND                                                                            //*
        isset($_GET['cmdp']) AND ! empty($_GET['cmdp']) AND                                                                          //*
        isset($_GET['email']) AND ! empty($_GET['email']) AND ( strlen($_GET['pseudo']) <= 20) AND ( strlen($_GET['mdp']) <= 50)     //*
        AND ( strlen($_GET['cmdp']) <= 50) AND ( strlen($_GET['email']) <= 100) AND ( $_GET['mdp'] == $_GET['cmdp'])) {              //*
    try {
        $pseudo = $_GET['pseudo'];  //* creation des variables pour les metre dans la bdd
        $email = $_GET['email'];    //*
        $mdp = md5($_GET['mdp']);   //*
        $erreur = false;            //*

        $dbh = new PDO('mysql:host=localhost;dbname=ynsay', 'root', '');                                            // connexion a la bdd
        $resultat = $dbh->query("SELECT id_utilisateur, pseudo, email FROM utilisateur ORDER BY id_utilisateur");   // requete sql pour savoir si on a un pseudo ou un mail déjà pris
        $check = $resultat->fetch(PDO::FETCH_NUM);
        if ($check == true) {
            foreach ($resultat as $ligne) {                 //* pour chaque ligne de la bdd
                if ($pseudo === $ligne['pseudo']) {         //* on verifie  si l'on a déjà un pseudo existant
                    $erreur = true;                         //*  alors on met l'erreur a true et on sort
                    break;
                } else if ($email === $ligne['email']) {    //* on verifie si l'on a déjà  un mail existant
                    $erreur = true;                         //* alors on met l'erreur a true et on sort
                    break;
                }
            }

            if ($erreur != true) {                                                                          // si l'on a pas d'erreur
                //On remplit une ligne dans la table utilisateur
                $stmt = $dbh->prepare("INSERT INTO utilisateur (pseudo,email,password) VALUES (?,?,?)");    //* on prepare la requete sql pour l'insertion des valeurs dans la bdd
                $stmt->bindParam(1, $pseudo);                                                               //*
                $stmt->bindParam(2, $email);                                                                //*
                $stmt->bindParam(3, $mdp);                                                                  //*
                $stmt->execute();                                                                           // on execute la commande sql
                $_SESSION['inscrit'] = true;
                echo 'OK';
            } else {                                    // sinon on affiche le message
                echo "Pseudo ou e-mail déjà utilisés";
            }
        }
    } catch (PDOExeption $e) {                          // recuperation des erreurs
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>
