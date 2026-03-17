<?php
    //on regarde si l'utilisateur est déjà connecté ou non, si oui on le redirige sur son profil
    if(isset($_SESSION["user"])){
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }
?>