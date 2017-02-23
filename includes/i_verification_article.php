<?php

session_start();

var_dump($_POST);

$formulaireValide = true;

if ($_SESSION['connecte'] != true) {
    $formulaireValide = false;
    echo "Tu n'es pas connecté espèce de trash!";
}
if (( isset($_POST['titre']) AND empty($_POST['titre']) ) || ((strlen($_POST['titre'])) > 100)) {
    $formulaireValide = false;
    echo "Titre invalide! Vous devez renseigner un titre entre 1 et 100 caractères.<br />";
}

if (( isset($_POST['corps']) AND empty($_POST['corps']) ) || ((strlen($_POST['corps'])) > 10000)) {
    $formulaireValide = false;
    echo "Corps d'article invalide! Vous devez écrire un article entre 1 et 10000 caractères.<br />";
}

if ($formulaireValide == true) {
    $dbh = new PDO('mysql:host=localhost;dbname=ynsay', 'root', '');
    $stmt = $dbh->prepare("INSERT INTO article (id_article, titre, contenu, id_utilisateur)
		VALUES (NULL, :titre, :contenu, :id_utilisateur)");
    $titre = $_POST['titre']; //On récupère le titre
    $corps = $_POST['corps']; //On récupère le corps de l'article
    $idUtilisateur = $_SESSION['id']; //On récupère l'ID de l'utilisateur pour le mettre comme auteur dans la base de données.
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':contenu', $corps);
    $stmt->bindValue(':id_utilisateur', $idUtilisateur);
    $stmt->execute(); //On insère l'article dans la base
    $idArticle = $dbh->lastInsertId(); //On récupère l'id de l'article, qui est actuellement le dernier rentré
    if (!isset($_POST['idTag'])) { //Si aucun tag sélectionné (note : dans la version finale du site, ceci sera une condition d'erreur car il devrait forcémment y avoir au moins un tag coché. On gère ce cas pour le moment pour les tests)
        echo "patate";
        var_dump($id_tags);

        $stmt = $dbh->prepare("INSERT INTO a_pour_tag (id_article, id_tag) 
			VALUES (:id_article, 999)"); //le tag general a pour id 2.
        $stmt->bindValue(':id_article', $idArticle);
        $stmt->execute(); //On applique le tag général
    } else { //Sinon
        echo "OUIIIIIIIIIII";
        $id_tags = $_POST['idTag']; //Le tableau de tags est copié dans une variable
        var_dump($id_tags);
        $nbTags = count($id_tags); //On récupère le nombre de tags choisis
        for ($i = 0; $i < $nbTags; $i++) { //On applique tous les tags
            $stmt = $dbh->prepare("INSERT INTO a_pour_tag (id_article, id_tag)
			  VALUES (:id_article, :id_tag)");
            $stmt->bindValue(':id_article', $idArticle);
            $stmt->bindValue(':id_tag', $id_tags[$i]);
            $stmt->execute();
        }
    }
    $dbh = null;
    // Maintenant, on affiche l'article pour montrer que l'opération a réussi
    echo "<h1>" . $titre . "</h1>";
    echo "<p>" . $corps . "</p>";
}
?>
