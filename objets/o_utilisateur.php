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
    const ERR_DOESNOTEXIST = "ce que vous recherchez n'existe pas.";
	
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
}
