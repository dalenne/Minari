<?php
    session_start();
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    unset($_SESSION["user"]);
    header("Location: http://localhost/Projet_Minari/code/connexion.php");

    exit;
?>