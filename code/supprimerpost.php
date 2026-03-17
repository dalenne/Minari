<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    //vérification que l'utilisateur a le droit de supprimer
    include "supprimerposttraitement.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Supprimer</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="supprimerpoststyle.css">
</head>



<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <h1>Voulez-vous vraiment supprimer cette publication ?</h1>
    
    <?php  
    //affiche le post
         include "afficherpost.php";
    ?>
    
    <section>
        <form method="POST">
            <input class="yes" type="submit" name="yes" value="Oui">
            <input class="no" type="submit" name="no" value="Non">
        </form>
    </section>

</body>




</html>
