<?php

/**
Crée le 23/01/17
Auteur : Pierre Parrat 
Nom de l'objet : o_utilisateur
Rôle : gère les méthodes associées aux utilisateurs
*/

if (session_status() == PHP_SESSION_NONE) //on démarre une session si ce n'est pas déjà le cas
{
	session_start();
}

class o_utilisateur {
	const OK = "ok";
    const ERR_DOESNOTEXIST = "Ce que vous recherchez n'existe pas.";
	
	public function recupere_pseudo() //fonction qui retourne le pseudo de l'utilisateur connecté, ou ERR_DOESNOTEXIST si il n'est pas connecté.
	{
		if (!isset($_SESSION['pseudo']))
		{
			return self::ERR_DOESNOTEXIST;
		}
		else
		{
			$pseudo_utilisateur = $_SESSION['pseudo'];
			return $pseudo_utilisateur;
		}
	}
	
	public function deconnexion() //supprime toutes les variables de session et arrête la session
	{
		$_SESSION = array(); //on vire les variables de session
		session_destroy(); //on arrête la session
<<<<<<< HEAD
                header('Location: accueil.php');
=======
                header('Location: ../pages/accueil.php');
>>>>>>> refs/remotes/origin/master
		return self::OK;
	}
}
