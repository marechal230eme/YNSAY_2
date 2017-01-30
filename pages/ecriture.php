<?php

/**
  la page crée le 19/12/2016 par pierre parrat
  Nom de la page : ecriture.php
  But de la page : ecriture des articles pour le site 
 */

?>

<html>
    <head>
        <title>ecriture de vos article  </title>
        <?php include '../includes/i_meta.php';  ?>
        <meta name="description" content="Page d'écriture des articles" />
        <link href="../css/ecriture.css" rel="stylesheet" type="text/css"/>
       
    </head>

    <body class="#212121 grey darken-4">
		<header>
			<!-- metre en place le logo a droite puis metre en place le nuage de tag dans le header  -->
			<img class="logo" src="../images/logo.png" alt="Logo du site"/>
		</header>
        
        <fieldset>
            <legend>Ecrivez votre article</legend>
            <form method="post" action="./verifArticle.php">
               
                <p>titre de votre article  <input  type="text"  name="titre"></p>
                <p>Corps de votre article : <textarea  name="corps">Votre article...</textarea></p>
                <input class="btn waves-effect waves-light orange accent-4" type="submit" value="Valider">
                <a href="lecture.php"></a>
            </form>
        </fieldset>

    </body>
</html>