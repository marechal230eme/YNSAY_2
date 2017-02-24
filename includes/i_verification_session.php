<?php

/**
 * Created by PhpStorm.
 * User: Marechal230eme
 * Date: 22/12/2016
 * Time: 12:50
 */
session_start(); // verification si c'est toujours le bon utilisateur
if (!isset($_SESSION['connecte'])) {
    $_SESSION ['connecte'] = false;
    $_SESSION['pseudo'] = "";
}
if (!isset($_SESSION['pseudo'])) {
    $_SESSION['pseudo'] = "";
}

