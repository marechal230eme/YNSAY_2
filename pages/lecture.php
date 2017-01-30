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

        include('../twig/t_twig.php');

        $template = $twig->loadTemplate('t_index.twig');
            echo $template->render(array(
                'img_profil' => '../images/avatar.png',
            ));
            
    ?>
    </body>
</html>