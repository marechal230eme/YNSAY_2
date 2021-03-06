<?php
/**
  Crée le 30/01/17
  Auteur : Romain Jacquiez
  Nom de la page : accueil.php
  Rôle : Page d'accueil du site
 */
 
session_start();
if(isset($_SESSION['pseudo']))
{
	if($_SESSION['pseudo'] != "") //si l'utilisateur est connecté, on le redirige vers la page de lecture
	{
		header('Location: lecture.php');
	}
}
?>

<html>
    <head>
        <?php
            include '../includes/i_meta.php';
        ?>
        <link href="../css/accueil.css" rel="stylesheet" type="text/css"/>
        <script src="../js/formulaire.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>
    </head>
    
    <body class="#212121 grey darken-4">
        <img class="logo" src="../images/logo.png" alt="Logo du site"/>
        
        <div class="presentation">
            <p class="textpresentation">
                Ynsay est un site qui est proposé aux étudiants de l'Isen Toulon.
                Il permet à tout le monde de discuter librement d'un tas de chose.
                Vous pouvez vous exprimer et choisir, grâce à des filtres, à qui votre message est destiné.
                Il peut s'agir d'une classe mais aussi d'un thême en rapport avec votre message.
                Alors n'attendez plus et inscrivez-vous !
            </p>
        </div>

        <fieldset id="formC" style="display: inherit;">
                <form>
                    <p class="titre_form">Connexion<p>
                    <span id="erreur"></span>
                    <p>Pseudonyme : <input id="pseudo" type="text" name="pseudo"></p>
                    <p>Mot de passe : <input id="mdp" type="password" name="mdp"></p>
                    <span id="loader" style="display: none;"><img class="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
                </form>
                <button class="btn waves-effect waves-light orange accent-4" onclick="request(readData);">Valider</button>
                <button id="bouton2" class="btn waves-effect waves-light orange accent-4" onclick="changeform(1);reiniterreur(1);">Pas encore inscrit ?</button>
        </fieldset>
        
        <fieldset id="formI" style="display: none;">
                <form>
                    <p class="titre_form">Inscription</p>
                    <span id="erreur2"></span>
                    <p>Votre pseudo utilisateur : <input id="pseudoI" type="text" name="pseudo"></p>
                    <p>E-mail : <input id="emailI" type="text" name="email"></p>
                    <p>Votre mot de passe : <input id="mdpI" type="password" name="mdp"></p>
                    <p>Confirmation de votre mot de passe : <input id="cmdpI" type="password" name="cmdp"></p>
                    <span id="loader" style="display: none;"><img class="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
                </form>
                <button class="btn waves-effect waves-light orange accent-4" onclick="request2(readData);">Valider</button>         
                <button class="btn waves-effect waves-light orange accent-4" onclick="changeform(2);reiniterreur(2);">Me connecter</button>
        </fieldset>
        <script src="../js/materialize.js" type="text/javascript"></script>
    </body>
    
    <?php
        include"../includes/i_footer.php";
    ?>
</html>