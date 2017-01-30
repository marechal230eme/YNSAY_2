<?php
/**
Crée le 23/01/17
Auteur : Pierre Parrat 
Nom de l'objet : o_requete
Rôle : gère les méthodes associées aux requêtes  
*/


class o_requete 
{
    private $DBH;
    private $ERR_CONNEXION;
    private $ERR_NOTFOUND;
    
    
    public function __construct() 
    {
        $this->ERR_CONNEXION = "OK";
        $this->ERR_NOTFOUND = "Not found";
        try 
        {
            $this->DBH = new PDO('mysql:host=localhost;dbname=ynsay', 'root', '');
        } 
        catch (PDOExeption $e)
        { 
            $this->ERR_CONNEXION = "Erreur !: " . $e->getMessage();
        }
    }
    
    /* Accesseur de la connexion à la base de données
     * Retour :
     * $DBH : PDO d'accès à la BDD
     */
    private function getDbh()
    {
        $this->ERR_CONNEXION = "OK";
        return $this->DBH;
    }
    
    /* Effectue la requête à la base de données
     * Paramètres : $requete : requête à effectuer
     * Retour :
     * $resultat : résultat de la requête
     * ERR_CONNEXION : si la connexion a échoué
     * ERR_NOTFOUND : si la requête n'a rien retourné
     */
    private function exe_requete($requete)
    {
        try
        {
            $resultat = $this->getDbh()->query($requete);
            $check = $resultat->fetch(PDO::FETCH_NUM);
            if ($check == true)
            {
                return $resultat;    
            }
            else
            {
                return $this->ERR_NOTFOUND;
            }
        } catch (PDOExeption $e) 
        {
            $this->ERR_CONNEXION = "Erreur !: " . $e->getMessage();
        }
        return $this->ERR_CONNEXION;
    }
    


    public function Tag(&$id_tag, &$nom_tag, &$description_tag)
    {
        $requete = "SELECT id_tag, nom_tag, description_tag FROM tag";
        $resultat = $this->exe_requete($requete);
        
        if($resultat === $this->ERR_CONNEXION || $resultat === $this->ERR_NOTFOUND)
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
    }

}