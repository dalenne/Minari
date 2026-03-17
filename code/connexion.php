<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();
    //Si un utilisateur est déjà connecté il sera redirigé vers sa page de profil
    include_once "verifconnecte.php";
    
    //la vérification pour se connecter
    include "connexiontraitement.php"
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Connexion</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="connexionstyle.css">
</head>

<body>
    <section>
        <form method="POST">
            <input type="text" name="pseudoOUmail" required placeholder="<?php if(isset($erreur)){echo $erreur;}else{echo "Adresse e-mail ou Pseudo.";}?>" autocomplete="off">
            <input type="password" name="mdp" required placeholder="<?php if(isset($erreur)){echo $erreur;}else{echo "Mot de passe.";}?>" autocomplete="off">
            <input type="submit" name="login" value="Se connecter">
        </form>
        <hr> <br>
        <em>Vous n'avez pas de compte ?&nbsp;<a href="http://localhost/Projet_Minari/code/inscription.php">S'inscrire</a></em>
    </section>
    <div class="un">
        <img class="pingouin" src="images/logo7.png" width="29%" alt="Erreur">
    </div>
    <span>
        <img class="minari" src="images/logo8.png" width="22%" alt="Erreur">
    </span>
</body>

</html>