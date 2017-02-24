<?php
include '../includes/i_verification_session.php';
/**
  la page créée le 19/12/2016 par Pierre Parrat
 * modifiée par : Antoine Parant
  Nom de la page : ecriture.php
  But de la page : ecriture des articles pour le site
 */
 
if(!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] == "") //renvoie vers la page d'accueil si l'utilisateur n'est pas connecté
{
	header('Location: accueil.php');
}
?>

<html>
    <head>

        <title>Ecriture de vos articles  </title>
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

        <fieldset class="ecriture">
            <!--<p class="titre">Exprimez-vous</p>-->
            <form method="post" action="../includes/i_verification_article.php">

                <p class="div_contenu">Titre de votre article <span id="contenu_couleur"> : </span>
                    <input  type="text" id="title"  name="titre" placeholder="Votre titre..." autofocus="focus" maxlength="100" required="requis">
                </p>
                <p class="div_contenu">Corps de votre article <span id="contenu_couleur"> : </span> 
                    <textarea id="corps" name="corps" rows="20" cols="5" placeholder="Votre article ..." maxlength="500"></textarea>
                </p>

                <label for="one" class="select_tags"> Sélection des tags </label>
                
                <?php include '../includes/i_selection_tags.php'; ?>
  
               
                <button class="btn waves-effect waves-light btn-large orange accent-4 " type="submit" name="valider">Envoyer
                    <i class="material-icons right">email</i>
                </button>


            </form>
            
        </fieldset> 

    </body>
    <script src="../js/materialize.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
    <?php include '../includes/i_footer.php'; ?>
</html>