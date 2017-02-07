<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php

        /*include('../twig/t_twig.php');

        $template = $twig->loadTemplate('t_index.twig');
            echo $template->render(array());*/
            
    ?>
        
        <fieldset id="article" style="display: inherit;">
            <div class="infos">
                <p id="photo_profil"><img src="../images/avatar.png" alt=""/></p>
                <p><!--placer dynamiquement le pseudo du mec-->Pseudo provisoire</p>
                    <p><?php echo date("d-M-Y   H:i:s")?></p>
                    <!--provisoire, dois trouver le moyen de mettre depuis la date de publication-->
                <div id="contenu_article">
                    <p>Ci-git le contenu l'article qui devra être importer depuis la page écriture</p>
                    <!-- Fonction qui permet d'étendre l'article ? -->
                </div>
            </div>
        </fieldset>
    </body>
</html>