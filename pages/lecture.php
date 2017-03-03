<?php
/*
  la page crée le 19/12/2016 par pierre parrat
 * modifié par : Antoine Parant
  Nom de la page : ecriture.php
  But de la page : ecriture des articles
 */
session_start();
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] == "") { //renvoie vers la page d'accueil si l'utilisateur n'est pas connecté
    header('Location: accueil.php');
}
?>

<html>
    <head>
        <title>Ynsay</title>
        <?php include '../includes/i_meta.php'; ?>
        <meta name="description" content="Page de lecture  des articles" >
        <link href="../css/lecture.css" rel="stylesheet" type="text/css">
        <link href="../css/materialize.css" rel="stylesheet" type="text/css">
        
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="../js/jquery-3.1.1.js" type="text/javascript"></script>
        
        <script src="../js/selection_tags.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>
    </head>

    <body class="#212121 grey darken-4">

        <header>
            <!-- mettre en place le logo à droite puis mettre en place le nuage de tag et bouton "nouveau" dans le header  -->
            <?php include '../includes/i_navbar_lecture.php'; ?>
        </header>

        <div class="divasideG">
            <fieldset class="user">
                <?php include '../includes/i_sidebar_utilisateur.php'; ?>
            </fieldset>
        </div>

        <div class="article">
            <div id="ajax_article">
            </div>
            <span id="loader" style="display: none;">
                <img class="img_loader" src="../images/loader.gif" alt="Chargement" />
            </span>
        </div>

        <div class="divasideD">
            <fieldset class="selection">
                    <label for="one" class="select_tags"> Sélection des tags </label>
                    <?php include '../includes/i_selection_tags.php' ?>
            </fieldset>
        </div>
    </body>

    <script src="../js/materialize.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>

    <?php /*include '../includes/i_footer.php';*/ ?>
</html>
