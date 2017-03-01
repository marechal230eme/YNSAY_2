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

/* // VOIR CE QUE L'ON A EN ENTREE
  //voir ce que  les valeurs contiennent quand on débug
  echo "id_tag";
  var_dump($id_tag);
  echo "nom_tag";
  var_dump($nom_tag);
  echo "description_tag";
  var_dump($description_tag);
*/

// POUR TRIER LE TABLEAU DESCRIPTION_TAG PROPREMENT  
$trie_description = $description_tag ; // variable pour le trier le tableau 
//natsort() implémente un algorithme de tri qui traite les chaînes alphanumériques
// du tableau array comme un être humain 
//Cette fonction retourne TRUE en cas de succès ou FALSE si une erreur survient.
$check =natsort ($trie_description );    
if($check == true)
{
    $description_tag = $trie_description ; 
}


//BOUCLE POUR EVITER LES DOUBLONS
     $i = 0;//variable d'incrémentatio,
    $description[$i] = $description_tag[$i] ; 
    foreach ($description_tag as $traitement) {                        //**pout chaque ligne de description de description tag on fait :
        // strnatcmp :  la fonction retourne < 0 si str1 est inférieure à str2; 
        // > 0 si str1 est supérieure à str2, et 0 si les deux chaînes sont égales.  
        if ((strnatcmp($description[$i], $traitement)) !=0 ) {         //* comparaison des 2 chaine 2 caractère pour eviter les doublons 
            $i++;                                                      //* incrémenttion du tableau sans doublons
            $description[$i] = $traitement;                            //* insertion des valeur qui ne sont pas en doublons 
            }          
    }


// BOUCLE POUR FAIRE UN TABLEAU DE SELECTION QUI SERT POUR LES AFFICHER    
for ( $i=0 ; $i<sizeof($id_tag) ; $i++  ) {             //** pour le nombre d'id présent on associe dans un tableau 2d : 
    $case_description[0][$i] = $id_tag[$i];             //*  l'id des tags 
    $case_description[1][$i] = $nom_tag[$i];            //*  le nom des tags 
    $case_description[2][$i] = $description_tag[$i];    //*  la description des tag 
    //$i++;                                             //** variable d'incrémentation 
}


// BOUCLE QUI PERMET D'AFFICHER LES SELECTIONS DE TAG 
$i = 0;                                                                         //* dans ce for on effectura un tri a la volée du tableau de case description                                              
for($index=1 ; $index<sizeof($description) ; $index++)                          //!!!\ on skip la premiere case car cela crée un doublon
{    ?> 
    <div class="input-field #212121 grey darken-4 orange-text col s12">     <!--//* appel d'un select multiple de materialize  -->
        <select multiple name="valeur_tags[]  ">                                                                 
            <?php
              echo"<option value=\"\" disabled selected> $description[$index] </option>";        //* permet d'afficher le titre de la selection quand rien n'est cochée (promo , cour , ...)
            
            foreach ($case_description[2] as $ligne)                            //** pour chaque ligne du tableau 
            {                                       
             
                // strnatcmp :  la fonction retourne < 0 si str1 est inférieure à str2; 
                // > 0 si str1 est supérieure à str2, et 0 si les deux chaînes sont égales.  
                if (((strnatcmp(($ligne), $description[$index])) == 0))      //* on regarde pour chaque tag , la description_tag associé , pour voire si elle correspond au description_tag de la selection 
                {   
                    $valeur_id = $case_description[0][$i];                                    //* valeur qui contiendra les id des tags 
                    
                    echo"<option   value=$valeur_id  > " . ($case_description[1][$i]) . "  </option> ";  //* création de la checkbox de selction du tag 
                }
                $i++;                                                                         //* variable d'incrementation pour parcourir le tableau  
            }
            $i = 0
            ?>
        </select>
    </div>
    <?php
}


