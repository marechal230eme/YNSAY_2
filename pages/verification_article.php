<?php
/**
  la page créée le 19/12/2016 par Pierre Parrat
 * modifiée par : Antoine Parant
  Nom de la page : ecriture.php
  But de la page : ecriture des articles pour le site
 */
session_start();
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
        <link href="../css/verification_article.css" rel="stylesheet" type="text/css"/>
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
            
            <form method="post" action="../pages/verification_article.php">
                
                <label for="one" class="select_tags"> Sélection des tags </label>
                
                 <?php include '../includes/i_selection_tags.php'; ?>
                
                <div class = "erreurArticle">
                    <?php

                    $objet2 = new o_requete();
                    
                    $formulaireValide = true;

                    if (((strlen($_POST['titre'])) > 100)) {
                        $formulaireValide = false;
                        echo "  Titre invalide ! Vous devez renseigner un titre entre 1 et 100 caractères.<br/>";
                    }

                    if (( isset($_POST['corps']) AND empty($_POST['corps']) ) || ((strlen($_POST['corps'])) > 10000)) {
                        $formulaireValide = false;
                        echo "  Corps d'article invalide ! Vous devez écrire un article entre 1 et 10000 caractères.<br/>";
                    }

                    if ($formulaireValide == true) {
                        $titre = $_POST['titre'];
                        $corps = $_POST['corps'];
                        $idUtilisateur = $_SESSION['id'];
                        if (!isset($_POST['valeur_tags'])) {
                            $idTags = NULL;
                        } else {
                            $idTags = $_POST['valeur_tags'];
                        }

                        $retour = $objet2->insere_article($titre, $corps, $idUtilisateur, $idTags);

                        if ($retour === "ok") {
                            echo "  Votre message a bien été engeristré !";
                            header("refresh: 4 ; url = lecture.php");
                        }
                    }
                    ?>
                </div>   
                
                <p class="div_contenu">Titre de votre article <span id="contenu_couleur"> : </span>
                    <input  type="text" id="title"  name="titre" placeholder="Votre titre..." autofocus="focus" maxlength="100" required="requis">
                </p>
                <p class="div_contenu">Corps de votre article <span id="contenu_couleur"> : </span> 
                    <textarea id="corps" name="corps" rows="20" cols="5" placeholder="Votre article ..." maxlength="500"></textarea>
                </p>
                
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