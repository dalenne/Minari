<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Accueil</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="accueilstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <h1>Fil d'actualité</h1>

    <?php 
        //Code pour afficher les posts
        include "accueiltraitement.php";
    ?>
    <!-- Code pour afficher l'index -->
    <?php
        include "index.php";
    ?>

</body>

</html>