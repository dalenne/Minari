<?php
    //on regarde si l'utilisateur est déjà connecté ou non, si non on le redirige sur la page connexion
    if(!isset($_SESSION["user"])){
        header("Location: http://localhost/Projet_Minari/code/connexion.php");

        exit;
    }
?>