<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$id_tag;
$nom_tag;
$description_tag;
//$valeur_id;

include '../objets/o_requete.php';
$objet = new o_requete();
$objet->recupere_tag($id_tag, $nom_tag, $description_tag);


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
    if ((strnatcmp($description[$i], $traitement)) !=0 ) {   //* comparaison des 2 chaine 2 caractère pour eviter les doublons 
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

/* on peut voire le tableau qui permetra de faire le trie à la vollée des selection des tag
  echo 'valeur du tableau des case';
  var_dump($case_description);
 */

$i = 0;                                                                                       //* dans ces foreach on effectura un tri a la volée du tableau de case description                                              
foreach ($description as $case) {                                                             //** pour chaque description_tag 
    ?>
    <div class="input-field #212121 grey darken-4 orange-text col s12">                   <!--//* appel d'un select multiple de materialize               -->
        <select multiple name="valeur_tags[]  ">                                                                 
            <?php
            echo"<option value=\"\" disabled selected> $case </option>";                      //* la premiere case de selection ne peut pas etre coché et est affiché quand rien n'est cochée elle permet d'afficher la categorie qui correspond (promo , cycle , association , ect ... )  
            
            foreach ($case_description[0] as $ligne) {                                        //** pour chaque ligne du tableau 

                // strnatcmp :  la fonction retourne < 0 si str1 est inférieure à str2; 
                // > 0 si str1 est supérieure à str2, et 0 si les deux chaînes sont égales.
                
                if (((strnatcmp(($case_description[2][$i]), $case)) == 0)) {  //*             //* on regarde pour chaque tag la description_tag associé , pour voire si elle correspond au description_tag de la selection  associé
                    
                    $valeur_id = $case_description[0][$i];                                    //* valeur intermediaire qui indiquera la valeur que value (l'id du tag ) aura et qu'il deffinira a quoi l'article est associé lors de l'insertion dans la bdd          
                    
                    echo"<option   value=$valeur_id  > " . ($case_description[1][$i]) . "  </option> ";  //* case de selction des tag qui contien un name(un tableau qui devra contenir les case coché par l'utilisateur )  une value voir description ligne precedente , et me nom du tag associé 
                }
                $i++;                                                                         //* variable d'incrementation pour parcourir le tableau  
            }
            $i = 0
            ?>
        </select>
    </div>
    <?php
}

/* // utile pour le debug ou voire ce qu 'il s'y passe 
echo 'ce qu il se passe dans les foreach ';

$i = 0;
foreach ($description as $case) {

    foreach ($case_description[0] as $ligne) {
       // var_dump($ligne);
       // var_dump($i);

        if (((strnatcmp(($case_description[2][$i]), $case)) == 0)) {
            var_dump($case_description[1][$i]);
            var_dump($case_description[0][$i]);
        }
        $i++;
    }   
    $i = 0 ; 
    var_dump($i);
}

*/

