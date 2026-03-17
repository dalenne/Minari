<?php
    //On démarre la session php 
    session_start();
    //Si un utilisateur est déjà connecté il sera redirigé vers sa page de profil
    include_once "verifconnecte.php";

    
    //dans l'autre cas sur connexion
    header("Location: http://localhost/Projet_Minari/code/connexion.php");

    exit;

?>