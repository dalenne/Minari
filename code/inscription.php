<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();
    //Si un utilisateur est déjà connecté il sera redirigé vers sa page de profil
    include_once "verifconnecte.php";

    //Pour autoriser l'utilisateur à avoir un anniversaire entre le jour qu'il est et -100 ans à ce jour
    $aujourdhui = date("Y-m-d");
    $datemin = new \DateTime();
    $datemin->modify("-100 years");
    $datemin = $datemin->format('Y-m-d');

    //Vérification d'inscription
    include "inscriptiontraitement.php";

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Inscription</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="inscriptionstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <section>
        <form method="POST" enctype="multipart/form-data">
            <label for="surnom">Surnom:</label>
            <input type="text" name="surnom" required placeholder="Comment voulez-vous qu'on vous appelle ?" autocomplete="off" minlength="1" maxlength="20" value="<?php if(isset($v_surnom)){echo $v_surnom;}?>">
            
            <label for="identifiant">Identifiant:</label>
            <input type="text" name="identifiant" required placeholder="<?php if(isset($er_id)){echo $er_id;}else{echo "Unique, il nous permettra de vous retrouver";}?>" autocomplete="off" minlength="3" maxlength="20" value="<?php if(!isset($er_id) and isset($v_id)){echo $v_id;}?>">
            
            <label for="email">Adresse email:</label>
            <input type="email" name="email" required placeholder="<?php if(isset($er_email)){echo $er_email;}else{echo "Exemple: Minari@exemple.com";}?>" autocomplete="off" value="<?php if(!isset($er_email) and isset($v_email)){echo $v_email;}?>">
            
            <label for="anniv">Anniversaire:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($er_anniv)){echo $er_anniv;}?></label>
            <input type="date" name="anniv" required placeholder="Votre date de naissance" autocomplete="off" value="<?php if(!isset($er_anniv) and isset($v_anniv)){echo $v_anniv;}?>" max="<?php echo $aujourdhui;?>" min="<?php echo $datemin;?>">
            
            <label for="mdp">Mot de passe:</label>
            <input type="password" name="mdp" required placeholder="<?php if(isset($er_mdp)){echo $er_mdp;}else{echo "Veuillez entrer un mot de passe";}?>" autocomplete="off" minlength="3">
            
            <label for="mdp2">Confirmation mot de passe:</label>
            <input type="password" name="mdp2" required placeholder="<?php if(isset($er_mdp)){echo $er_mdp;}else{echo "Veuillez entrer le même mot de passe";}?>" autocomplete="off" minlength="3">
            
            <label for="pdp" classe="fichier">Photo de profil (non obligatoire):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($er_pdp)){echo $er_pdp;}?></label>
            <input type="file" name="pdp" accept=".jpg, .jpeg, .png"> 
            
            <input type="submit" name ="register" value="S'inscrire">
        </form>
    </section>
</body>

</html>

