<?php

include ('../objets/o_requete.php');

$id_tag;
$nom_tag;
$description_tag;

$objet = creeObjetRequete();

$articles;
$objet->recupere_article($articles, "titre", "asc");



foreach ($articles as $article)
{
    echo $article['id_article'] . "</br>" . $article['titre'] . "</br>" . $article['contenu'] . "</br>" . $article['pseudo'] . "</br>";
}
echo 'Ceci est la fiiiiin';