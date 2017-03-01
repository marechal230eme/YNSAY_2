<?php

include '../objets/o_utilisateur.php';

$nom_utilisateur = new o_utilisateur();
 
$nom_utilisateur->recupere_pseudo();

$urlPhoto = "../images/avatar.png";

echo "<img class=\"avatar\" src=$urlPhoto alt=\"Avatar\"/>";

echo '<p class="message">Bienvenue ' . $_SESSION['pseudo'] . '</p>';

//.$nom_utilisateur->deconnexion().
echo "<button class=\"btn waves-effect waves-light orange accent-4\" onclick=\"self.location.href='../includes/i_deconnexion.php'\">Déconnexion</button>";
