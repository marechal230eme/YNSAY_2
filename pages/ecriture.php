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
        <?php include '../includes/i_meta.php'; ?>
        <meta name="description" content="Page d'écriture des articles" />
        <link href="../css/ecriture.css" rel="stylesheet" type="text/css"/>
        <!--  <link href="../css/i_navbar_tags.css" rel="stylesheet" type="text/css"/>  -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
        <script src="../js/jquery-3.1.1.js" type="text/javascript"></script>

    </head>

    <body class="#212121 grey darken-4">
        <header>
            <!-- metre en place le logo a droite puis metre en place le nuage de tag dans le header  -->
            <!-- <img class="logo" src="../images/logo.png" alt="Logo du site"/> -->
            <?php include '../includes/i_navbar_tags.php'; ?>
        </header>

        <fieldset>

            <legend>Ecrivez votre article</legend>
            <form method="post" action="./verifArticle.php">
                <p>titre de votre article  <input  type="text"  name="titre"></p>
                <p>Corps de votre article : <textarea  name="corps">Votre article...</textarea></p>
                <a href="lecture.php"></a>
                <label for="one">
                </label>
            </form>
            <select multiple>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
            <label>Materialize Multiple Select</label>
        </fieldset>





        <?php include '../includes/i_footer.php'; ?>
    </body>
    <script src="../js/materialize.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</html>