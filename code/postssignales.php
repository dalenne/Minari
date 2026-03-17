<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";
    
    $signaletraitement = true;
    //Afficher les posts signalés + supprimer post ou enlever signalement traitement

    //Pour afficher les posts signalés
    $req_post = "SELECT * FROM post WHERE id_post IN (SELECT idpost FROM postsignale) ORDER BY date_publi DESC;";
    $res_post = mysqli_query($connexion,$req_post);
    $ligne_post = mysqli_fetch_assoc($res_post);

    while($ligne_post){
        include "afficherpost.php";
        $ligne_post = mysqli_fetch_assoc($res_post);
    }
    
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Posts Signal&eacute;s</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="postssignalesstyle.css">
</head>

<body>
    <!-- Code pour afficher l'index -->
    <?php include "index.php";?>

</body>

</html>

