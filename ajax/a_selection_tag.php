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

if(sizeof($articles) <= 0)
{
    echo '<p class="aucunA">Désolé, aucun article ne correspond à votre recherche</p>';
}
else
{
    for ($i = 0; $i < sizeof($articles); $i++)
    {
        echo '<div id="articulos">'.'<p id="titulo">'.$articles[$i]['titre'].'</p>';
        echo '<div id="indication"><span id="autor">'.$articles[$i]['pseudo'].'</span><span id="poste"> a posté : </span></div>';
        echo '<fieldset id="contenido">'.$articles[$i]['contenu'].'</fieldset>'.'</div>';
    }
}
    
        
