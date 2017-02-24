<?php

include ('../objets/o_requete.php');

$id_tag;
$nom_tag;
$description_tag;

$objet = creeObjetRequete();

$resultat = $objet->recupere_tag($id_tag, $nom_tag, $description_tag);

    echo '<table>';  //mise en place d'un tableau en html
    $descriptionAv = "";
    for ($i = 0; $i < count($id_tag); $i++)
    {
        $id = $id_tag[$i];
        $nom = $nom_tag[$i];
        $description = $description_tag[$i];
        if($description !== $descriptionAv) // si on ateint le bout de la ligne on change de ligne
        {
            if($descriptionAv !== "")
            {
                echo"</tr>"; // fin de la ligne
            }
            echo "<tr>";     // debut de la nouvelle ligne
        }
        echo"<td><input type=\"checkbox\" id=$id name='idTag[]' value=$id><label for=$id>$nom</label></td>"; // insertion des valeurs dans des bouttons de type checkbox
        $descriptionAv = $description;
    }
    echo '</table>';  // fin du tableau
    echo '<input type ="submit" value="envoyer" >' ;
    
    echo $objet->insere_inscription('theo', 't', 'oloul');
    echo $objet->insere_inscription('rrrrr', 'rom@rom.fr', 'lool');
    echo $objet->insere_inscription('nouveau', 'nouveau@nouv.fr', 'mdepasse');
echo 'Ceci est la fin';