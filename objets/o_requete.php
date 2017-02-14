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
    const OK = "";
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
            $resultat = $this->DBH->query($requete);
            $check = $resultat->fetch(PDO::FETCH_NUM);
            if ($check == true)
            {
                return $resultat;    
            }
            else
            {
                return self::ERR_NOTFOUND;
            }
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
        $requete = "SELECT id_tag, nom_tag, description_tag FROM tag";
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
    
    public function insere_inscription($pseudo, $email, $mdp)
    {
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
    
    
   
}