<?php
/*
  la page crée le 19/12/2016 par pierre parrat
 * modifié par : Antoine Parant
  Nom de la page : ecriture.php
  But de la page : ecriture des articles
 */
session_start();
if(!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] == "") //renvoie vers la page d'accueil si l'utilisateur n'est pas connecté
{
	header('Location: lecture.php');
}
?>

<html>
    <head>
        <title>Ynsay</title>
        <?php include '../includes/i_meta.php'; ?>
        <meta name="description" content="Page de lecture  des articles" />
        <link href="../css/lecture.css" rel="stylesheet" type="text/css"/>
        <link href="../css/materialize.css" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class="#212121 grey darken-4">

        <header>
            <!-- mettre en place le logo à droite puis mettre en place le nuage de tag et bouton "nouveau" dans le header  -->
            <?php include '../includes/i_navbar_lecture.php'; ?>
        </header>

        <fieldset class="user">
            <p class="infos_user">
                <img id="wip" src="../images/work_in_progress.jpg" alt=""/>
            </p> 
        </fieldset>
        <fieldset class="article">
            Fieldset à dégager, sample d'article.
        </fieldset>
    </body>
    <script src="../js/materialize.js" type="text/javascript"></script>
</html>
