<?php

include '../objets/o_requete.php';
$objet = new o_requete();

if (!isset($_GET['id']) || empty($_GET['id']))
{
    $ids[0] = 1; //tag général 
}
else
{
    $url = $_GET['id'];
    $ids = explode('-', $url);
}

$articles;
$retour3 = $objet->recupere_article($articles, "id", "desc", $ids);

for ($i = 0; $i < sizeof($articles); $i++)
{
    echo '<div id="articulos">'.'<p id="titulo">'.$articles[$i]['titre'].'</p>';
    echo '<p id="contenido">'.$articles[$i]['contenu'].'</p>';
    echo '<p id="autor">'.$articles[$i]['pseudo'].'</p>'.'</div>';
}
    
        
