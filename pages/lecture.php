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
	header('Location: accueil.php');
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
        <script src="../js/jquery-3.1.1.js" type="text/javascript"></script>
    </head>
    <body class="#212121 grey darken-4">

        <header>
            <!-- mettre en place le logo à droite puis mettre en place le nuage de tag et bouton "nouveau" dans le header  -->
            <?php include '../includes/i_navbar_lecture.php'; ?>
        </header>

        <fieldset class="user">
            <p class="infos_user">
              <?php include '../includes/i_sidebar_utilisateur.php'; ?>
            </p> 
        </fieldset>
        
        <fieldset class="selection">
            <form method="POST" action="lecture_articles.php">
                <label for="one" class="select_tags"> Sélection des tags </label>
                <?php include '../includes/i_selection_tags.php'?>
                
                <button id="bouton_selection" class="btn waves-effect waves-light btn-large orange accent-4" type="submit" name="valider">Valider
                        <i class="material-icons right">done</i>
                </button>
            </form>
        </fieldset>
        <fieldset class="article">
        <?php
        $objet3 = new o_requete();
                
                if (!isset($_POST['valeur_tags'])) {
                            $idTags[0] = 2; // Tag général
                        } else {
                            $idTags = $_POST['valeur_tags'];
                        }
                        
                        
                $orderBy = 'id';

                $descAsc = 'desc';
                
                $articles;

                $retour3 = $objet3->recupere_article($articles, $orderBy, $descAsc, $idTags);

                
                for ($i = 0; $i < sizeof($articles);){
                    echo '<div id="articulos">'.'<p id="titulo">'.$articles[$i]['titre'].'</p>';
                    echo '<p id="contenido">'.$articles[$i]['contenu'].'</p>';
                    echo '<p id="autor">'.$articles[$i]['pseudo'].'</p>'.'</div>';
                    $i++;
                }
        ?>
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
