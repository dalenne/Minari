<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    $idURL = htmlspecialchars(strtolower(trim($_GET["id"])));
    $admin = $_SESSION["user"]["admin"];
   
    //On vérifie si on regarde notre profil ou celui de quelqu'un d'autre
    include "profiltraitement.php";

    //Notre id à nous
    $idsession = $_SESSION["user"]["id"];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title><?php echo $surnom." (@".$id.")"?></title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="profilstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>
    
    <?php 
        //Code pour afficher "envoyer un message"
        include "profiltraitement4.php";
        //Code pour afficher les infos sur le profil telles que le nombre de post, d'abonnement et le bouton s'abonner si le profil de quelqu'un d'autre
        include "profiltraitement2.php";
        echo "<br>";
        //Code pour afficher les posts
        include "profiltraitement3.php";
        
    ?>

    <!-- Code pour afficher l'index -->
    <?php
        include "index.php";
    ?>

</body>

</html>