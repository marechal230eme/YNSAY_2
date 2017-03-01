/**
 Crée le 28/02/17
 Auteur : Théo Hipault 
 Nom du js : selectionTag 
 Rôle : gestion de la sélection de tag en ajax 
 */


function requete(donnees_get) 
{
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            document.getElementById("ajax_article").innerHTML = xhr.responseText;
            document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };
    
    xhr.open("GET", "../ajax/a_selection_tag.php?id=" + donnees_get, true);
    xhr.send(null);
}

function recupereValeur() 
{
    var resultat = ""; 
    var selectTag = document.getElementsByTagName("select");
    var aUnTag = false;
    for (var i = 0; i< selectTag.length; i++)
    {
        var listeSelection = selectTag[i];
        for (var j = 1; j < listeSelection.length; j += 1)
        {
            if (listeSelection.options[j].selected)
            {
                if (j !== 1)
                {
                    resultat += "-";
                }
                resultat += listeSelection.options[j].value;  
                aUnTag = true;
            }
        }
    }
    if (!aUnTag)
    {
        resultat = "1"; //tag général
    }
    requete(resultat);
}
