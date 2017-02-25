/**
 Crée le 23/01/17
 Auteur : Romain Jacquiez 
 Nom du js : formulaire 
 Rôle : gestion des formulaires de l'accueil en ajax 
 */
function changeform(nombre) {
    if (nombre === 1)
    {
        document.getElementById("formI").style.display = "inherit";
        document.getElementById("formC").style.display = "none";
    }
    if (nombre === 2)
    {
        document.getElementById("formC").style.display = "inherit";
        document.getElementById("formI").style.display = "none";
    }
}

function request(callback) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText, 1);
            document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };

    var pseudo = encodeURIComponent(document.getElementById("pseudo").value);
    var mdp = encodeURIComponent(document.getElementById("mdp").value);

    xhr.open("GET", "../ajax/a_verif_connexion.php?pseudo=" + pseudo + "&mdp=" + mdp + "", true);
    xhr.send(null);
}

function request2(callback) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText, 2);
            document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };

    var pseudo2 = encodeURIComponent(document.getElementById("pseudoI").value);
    var email2 = encodeURIComponent(document.getElementById("emailI").value);
    var mdp2 = encodeURIComponent(document.getElementById("mdpI").value);
    var cmdp2 = encodeURIComponent(document.getElementById("cmdpI").value);

    xhr.open("GET", "../ajax/a_verif_inscription.php?pseudo=" + pseudo2 + "&email=" + email2 + "&mdp=" + mdp2 + "&cmdp=" + cmdp2 + "", true);
    xhr.send(null);
}

function readData(data, nb)
{
    if (nb === 1 && data != '42')
    {
        document.getElementById("erreur").innerHTML = data;
    }
    if (nb === 2 && data !== 'OK')
    {
        document.getElementById("erreur2").innerHTML = data;
    }



    if (data == '42' && nb === 1)   // il y a une couille ici !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    {
        document.location.href = "http://localhost/YNSAY_2/pages/lecture.php";
    }
    if (data === 'OK' && nb === 2)
    {
        changeform(2);
        location.reload();
    }
}

function reiniterreur(code)
{
    if (code === 1)
    {
        document.getElementById("erreur").innerHTML = null;
    }
    if (code === 2)
    {
        document.getElementById("erreur2").innerHTML = null;
    }
}