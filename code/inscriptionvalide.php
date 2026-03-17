<?php
    //on démarre la session php
    session_start();

    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    //on vérifie que l'utilisateur vient juste de s'inscrire sinon il n'a pas le droit de voir cette page
    //il ne vient pas de s'inscrire 
    if(!isset($_SESSION["user"]["inscription"])){ 
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }
    //il a déjà vu cette page
    elseif($_SESSION["user"]["inscription"]<>1){
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }
   

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Confirmation Inscription</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="inscriptionvalidestyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <section>
    <h1> Bienvenu(e) <?php echo $_SESSION["user"]["surnom"]?> !</h1> <br>
    <p>Ton inscription a été réalisée avec succès !<br> Clique sur le pingouin pour continuer</p>
    <span id="pingouin"><a href="http://localhost/Projet_Minari/code/profil.php?id=self"><img src="images/logo7.png" width="70%" height="100%" alt="Erreur"></a></span>
    </section>

    <?php $_SESSION["user"]["inscription"]=0; //pour éviter que l'utilisateur revienne sur cette page?>
</body>

</html>