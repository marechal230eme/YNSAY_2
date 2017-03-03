<?php
/**
Crée le 23/01/17
Auteur : Théo Hipault 
Nom de l'objet : o_requete
Rôle : gère les méthodes associées aux requêtes  
*/

class DBYnsayException extends Exception { }

function creeObjetRequete()
{
    try 
    {
        $objet = new o_requete();
    } 
    catch (DBYnsayException $ex) 
    {
        echo $ex->getMessage();
        return null;
    }
    return $objet;
}


class o_requete 
{
    private $DBH; //Variable PDO
    private $ERR_MESSAGE;
    const OK = "ok";
    const ERR_CONNECTION = "Une erreur est survenue, impossible de se connecter à la base de données";
    const ERR_NOTFOUND = "Aucun résultat trouvé";
    const USER_ALREADY_EXISTS = "Pseudo ou e-mail déjà utilisés";
    
    //Constructeur
    public function __construct() 
    {
        $this->DBH = $this->getDbh();
        if ($this->DBH === null)
        {
            throw new DBYnsayException(self::ERR_CONNECTION);
        }
    }
    
    /* Accesseur de la connexion à la base de données
     * Retour : 
     * $pdo : PDO d'accès à la BDD
     * null : en cas d'erreur
     */
    private function getDbh()
    {
        try 
        {
            $pdo = new PDO('mysql:host=localhost;dbname=ynsay', 'root', '');
        } 
        catch (PDOExeption $e)
        {
            $this->ERR_MESSAGE = $e->getMessage();
            return null;
        }
        return $pdo;
    }
    
    /* Effectue la requête à la base de données
     * Paramètres : $requete : requête à effectuer
     * Retour :
     * $resultat : résultat de la requête
     * (string)ERR_CONNEXION : si la connexion a échoué
     * (string)ERR_NOTFOUND : si la requête n'a rien retourné
     */
    private function exe_requete($requete)
    {
        try
        {
            $prepare = $this->DBH->prepare($requete);
            $prepare->execute();
            $resultat = $prepare->fetchAll();       
            return $resultat;    
        } catch (PDOExeption $e) 
        {
            $this->ERR_MESSAGE = $e->getMessage();
            return self::ERR_CONNECTION;
        }
    }
   
    /* Parcours un résultat pour vérifier pseudo et email
     * Paramètres : 
     * $resultat : tableau à parcourir
     * $pseudo : pseudo à comparer
     * $email : email à comparer
     * Retour :
     * (bool) true : si l'utilisateur est dans le tableau
     * (bool) false : si l'utilisateur n'est pas dans le tableau
     * WARNING : ne fonctionne que sur un résultat contenant les champs pseudo et email
     */
    private function utilisateur_existe($resultat, $pseudo, $email)
    {
        foreach ($resultat as $ligne) 
        {
            if ($pseudo === $ligne['pseudo'] || $email === $ligne['email']) 
            {    
                return true;                         
            }
        }
        return false;
    }
    
    
    public function recupere_tag(&$id_tag, &$nom_tag, &$description_tag)
    {
        $requete = "SELECT id_tag, nom_tag, description_tag FROM tag ORDER BY id_tag";
        $resultat = $this->exe_requete($requete);
        
        if($resultat === self::ERR_CONNECTION || $resultat === self::ERR_NOTFOUND)
        {
            return $resultat;
        }
        $i = 0;
        foreach ($resultat as $ligne)
        {
            $id_tag[$i] = $ligne['id_tag'];
            $nom_tag[$i] = $ligne['nom_tag'];
            $description_tag[$i] = $ligne['description_tag'];
            $i++;             
        }
        return self::OK;
    }
    
    public function recupere_connexion($pseudoOuMail, $motDePasse)
    {
        $mdp = md5($motDePasse);
        $requete = "SELECT id_utilisateur, pseudo, email, password FROM utilisateur ORDER BY id_utilisateur";
        $resultat = $this->exe_requete($requete);
        if($resultat === self::ERR_CONNECTION || $resultat === self::ERR_NOTFOUND)
        {
            return $resultat;
        }
        foreach ($resultat as $ligne) 
        {
            if (($pseudoOuMail === $ligne['pseudo'] || $pseudoOuMail === $ligne['email'] ) AND ( $mdp === $ligne['password'])) 
            {  
                $_SESSION['pseudo'] = $ligne['pseudo'];
                $_SESSION['id'] = $ligne['id_utilisateur'];
                return self::OK;
            }
        }
        return self::ERR_NOTFOUND;
    }
    
    /* Récupère les articles dans le tableau $articles passé en paramètre
     * Chaque case de $articles est un tableau contenant les cases 
     * ['id_article']['titre']['contenu']['pseudo']
     * $orderby : mode de tri par 'id' 'titre' ou 'auteur'
     * $descAsc : mode de tri 'asc' ou 'desc'
     * Tout autre valeur de paramètre est ignorée
     */
    public function recupere_article(&$articles, $orderBy, $descAsc, $ids)
    {
        $taille = sizeof($ids);
        $requete = "SELECT DISTINCT article.id_article, titre, contenu, pseudo FROM article "
                . "INNER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur"
                . " INNER JOIN a_pour_tag ON article.id_article = a_pour_tag.id_article";
        
        if ($ids[0] !== 2)
        {
            $requete = $requete . " WHERE a_pour_tag.id_tag IN (";
        
            for ($i = 0; $i < $taille; $i++)
            {
                $requete = $requete . $ids[$i];
                if ($i < $taille - 1)
                {
                    $requete = $requete . ",";
                }
            }
        }
        $requete = $requete . ") GROUP BY a_pour_tag.id_article HAVING count(*) >= $taille";
        if ($orderBy === 'id')
        {
            $requete = $requete . " ORDER BY id_article";
        }
        else if ($orderBy === 'titre' )  
        {
            $requete = $requete . " ORDER BY titre";
        }
        else if ($orderBy === 'auteur' )
        {
            $requete = $requete . " ORDER BY pseudo";                
        }
        else 
        {
            $descAsc = 'none';
        }
        if ($descAsc === 'desc')
        {
            $requete = $requete . " DESC";
        }
        if ($descAsc === 'asc')
        {
            $requete = $requete . " ASC";
        }
        $requete = $requete . " LIMIT 100";
        $resultat = $this->exe_requete($requete);
        
        if($resultat === self::ERR_CONNECTION || $resultat === self::ERR_NOTFOUND)
        {
            return $resultat;
        }
        $i = 0;
        foreach ($resultat as $article)
        {
            $articles[$i] = $article;
            $i++;     
        }
        return self::OK;
    }
    
    public function insere_inscription($pseudo, $email, $motDePasse)
    {
        $mdp = md5($motDePasse);
        //Récupère les données des eutres utilisateurs
        $requete = "SELECT id_utilisateur, pseudo, email FROM utilisateur ORDER BY id_utilisateur";
        $resultat = $this->exe_requete($requete);
        //Erreur lors de la requête
        if($resultat === self::ERR_CONNECTION || $resultat === self::ERR_NOTFOUND) {
            return $resultat;
        }
        //Vérifie si l'utilisateur existe déjà
        if ($this->utilisateur_existe($resultat, $pseudo, $email)) {
            return self::USER_ALREADY_EXISTS;
        }
        //Si l'utilisateur n'est pas dans la BDD, insère ses données
        try {
            $stmt = $this->DBH->prepare("INSERT INTO utilisateur (pseudo, email, password) VALUES (?,?,?)");
            $stmt->bindParam(1, $pseudo);                                                               
            $stmt->bindParam(2, $email);                                                                
            $stmt->bindParam(3, $mdp);                                                                  
            $stmt->execute();          
        } catch (PDOExeption $e) {
            $this->ERR_MESSAGE = $e->getMessage();
            return self::ERR_CONNECTION;
        }
        return self::OK;
    }
    

    // WARNING : $idTags doit être un tableau de la forme $idTags[int]
    public function insere_article($titre, $corps, $idUtilisateur, $idTags)
    {
        try {
            $stmt = $this->DBH->prepare("INSERT INTO article (titre, contenu, id_utilisateur) VALUES (?,?,?)");
            $stmt->bindValue(1, $titre);
            $stmt->bindValue(2, $corps);
            $stmt->bindValue(3, $idUtilisateur);
            $stmt->execute();
        } catch (PDOExeption $e) {
            $this->ERR_MESSAGE = $e->getMessage();
            return self::ERR_CONNECTION;
        }
        $idArticle = $this->DBH->lastInsertId();
        if($idTags == NULL) {
            $stmt = $this->DBH->prepare("INSERT INTO a_pour_tag (id_article, id_tag) VALUES (:id_article, :id_tag)");
            $stmt->bindValue(':id_article', $idArticle);
            $stmt->bindValue(':id_tag', "1");
            $stmt->execute();
	}
	else {
            $nbTags = count($idTags);
            for($i=0; $i < $nbTags; $i++) {
                $stmt = $this->DBH->prepare("INSERT INTO a_pour_tag (id_article, id_tag) VALUES (:id_article, :id_tag)");
		$stmt->bindValue(':id_article', $idArticle);
		$stmt->bindValue(':id_tag', $idTags[$i]);
		$stmt->execute(); 
            }
	}
        return self::OK;
    }
    
    
   
}