<?php
/**
 Crée le 28/02/17
 Auteur : Théo Hipault 
 Nom du php : i_selection_tag 
 Rôle : récuper les tags et les affiche 
 */

$id_tag;
$nom_tag;
$description_tag;

include '../objets/o_requete.php';
$objet = new o_requete();
$objet->recupere_tag($id_tag, $nom_tag, $description_tag);


$descriptions_deja_comparees[0] = "";


for ($i = 0; $i < sizeof($id_tag); $i += 1)
{
    if (!est_dans($description_tag[$i], $descriptions_deja_comparees) )
    {
        $nom = $description_tag[$i];
        echo "<div class=\"input-field #212121 grey darken-4 orange-text col s12\" >";
        echo "<select multiple name=\"champSelect[]\" onchange=\"recupereValeur();\">";
        echo"<option value=\"\" disabled selected> $nom </option>";
    }
    for ($j = $i; $j < sizeof($id_tag); $j += 1)
    {
        if (est_dans($description_tag[$j], $descriptions_deja_comparees) )
        {
            break;
        }
        else if ($description_tag[$j] === $description_tag[$i])
        {
            $valeurId = $id_tag[$j];
            $valeurNom = $nom_tag[$j];
            echo "<option value=$valeurId>$valeurNom</option>";
        }
    }
    
    if (!est_dans($description_tag[$i], $descriptions_deja_comparees) )
    {
        echo "</select>";
        echo "</div>";
    }
    $descriptions_deja_comparees[$i + 1] = $description_tag[$i];
}
echo "</div>";

//Vérifie qu'une valeur est dans un tableau
function est_dans($valeur, $tableau)
{
    $retour = false;
    for ($i = 0; $i < sizeof($tableau); $i += 1)
    {
        if ($valeur === $tableau[$i])
        {
            $retour = true;
        }
    }
    return $retour;
}