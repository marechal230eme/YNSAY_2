<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$id_tag;
$nom_tag;
$description_tag;

include '../objets/o_requete.php';

$objet = new o_requete();

$objet->Tag($id_tag, $nom_tag, $description_tag);

/*
//voir ce que  les valeurs contiennent quand on débug 
echo "id_tag";
var_dump($id_tag);
echo "nom_tag";
var_dump($nom_tag);
echo "description_tag";
var_dump($description_tag);
*/

$i = 0;                                                                                                           //variable d'incrémentation
$description[$i] = $description_tag[0];                                                                           // initialisation de la variable desription qui contiendra une descripton_de_tag par tag






foreach ($description_tag as $traitement) {                                                                       //**pout chaque ligne de description de description tag on fait :
    if (((strnatcmp($description[$i], $traitement)) < 0) || ((strnatcmp($description[$i], $traitement)) > 0)) {   //* comparaison des 2 chaine 2 caractère pour eviter les doublons 
        $i++;                                                                                                     //* incrémenttion du tableau sans doublons
        $description[$i] = $traitement;                                                                           //* insertion des valeur qui ne sont pas en doublons 
    }                                                                                                             //**  
}

/*
echo 'description_tag apres traitement : ';
var_dump($description);
*/
$i = 0;                                                 // valeur remise à 0 pour l'incrémentation   

foreach ($id_tag as $construction) {                    //** pour le nombre d'id présent on associe dans un tableau 2d : 
    $case_description[0][$i] = $id_tag[$i];             //*  l'id des tags 
    $case_description[1][$i] = $nom_tag[$i];            //*  le nom des tags 
    $case_description[2][$i] = $description_tag[$i];    //*  la description des tag 
    $i++;                                               //** variable d'incrémentation 
}

/*
echo 'valeur du tableau des case';
var_dump($case_description);
*/



$i = 0;
foreach ($description as $case) {
    ?>
    <div class="input-field #212121 grey darken-4 orange-text col s12">
        <select multiple>
            <?php
            echo"<option value=\"\" disabled selected> $case </option>";



            foreach ($case_description[0] as $ligne) {

                if (((strnatcmp(($case_description[2][$i]), $case)) == 0)) {
                    echo"<option name='idTag[]' value=$case_description[0][$i] > " . ($case_description[1][$i]) . "  </option> ";
                }
                $i++;
            }
            $i=0; 
            ?>
        </select>     
    </div>
    <?php
}


/*
echo 'ce qu il se passe dans les foreach ';

$i = 0;
foreach ($description as $case) {

    foreach ($case_description[0] as $ligne) {
        var_dump($ligne);
        var_dump($i);

        if (((strnatcmp(($case_description[2][$i]), $case)) == 0)) {
            var_dump($case_description[1][$i]);
        }
        $i++;
    }   
    $i = 0 ; 
    var_dump($i);
}

*/