<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();
    //On vérifie qu'il soit bien connecté
    include_once "verifdeconnecte.php";

    $admin = $_SESSION['user']['admin'];
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Rechercher</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="rechercherstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>
    
    <section class="form">
        <form method="POST" >
            <select name="recherchetype">
            <option value="id" selected>Par id</option>
            <option value="surnom">Par surnom</option>
            </select>
            <input type="text" name="recherche" placeholder="Que voulez-vous rechercher ?" autocomplete="off">
            <input type="submit" name="valider" value="&#x1F50E;">
        </form>
    </section>

    <!-- Code pour afficher l'index -->
    <?php
        include "index.php";
    ?>

    <?php
    //la vérification pour rechercher
    include "recherchertraitement.php";
    ?>

</body>

</html>