<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    $idpost = htmlspecialchars(strtolower(trim($_GET["idpost"])));
    $signalement = true;
    
    //on vérifie que l'utilisateur a le droit de signaler ce post
    //On récupère les données du post et de l'auteur
    $req_post = "SELECT * FROM post WHERE id_post = '$idpost';";
    $res_post = mysqli_query($connexion,$req_post);
    $ligne_post = mysqli_fetch_assoc($res_post);

    $id = $ligne_post["user"];
    $idactuel = $_SESSION['user']['id'];

    $req_user = "SELECT * FROM user WHERE identifiant = '$id';";
    $res_user = mysqli_query($connexion,$req_user);
    $ligne_user = mysqli_fetch_assoc($res_user);

    $req_signalementverif = "SELECT * FROM postsignale WHERE user = '$idactuel' AND idpost ='$idpost';";
    $res_signalementverif = mysqli_query($connexion,$req_signalementverif);
    $ligne_signalementverif = mysqli_fetch_assoc($res_signalementverif);

    if($ligne_signalementverif){
        echo "<script>alert(\"Vous avez déjà signalé ce post!\")</script>";  
    }


    //vérification du signalement
    //s'il a cliqué non au final
    if(isset($_POST["no"])){
        //il ne veut pas signalerr le post donc on le redirige vers son profil
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }

    if(isset($_POST["yes"])){
        $raison = $_POST['raison'];
        
        //On insert le signalement dans la base de donnée
        $req_signalement = "INSERT INTO postsignale (idpost, user, raison) VALUES ('$idpost', '$idactuel', '$raison');";
        $res_signalement = mysqli_query($connexion,$req_signalement);

        //On le redirige vers son profil
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Signalement</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="signalerpoststyle.css">
</head>



<body>
    <h1>Pourquoi voulez-vous signaler ce post</h1>

    
    <?php  
    //affiche le post
         include "afficherpost.php";
    ?>

    <section>
        <form method="POST">
            <label for="s1">Contenu ind&eacute;sirable</label>
            <input type="radio" id="s1" name="raison" value="Contenu ind&eacute;sirable" checked><br>
            <label for="s2">Nudit&eacute; et activit&eacute;s sexuelles</label>
            <input type="radio" id="s2" name="raison" value="Nudit&eacute; et activit&eacute;s sexuelles"><br>
            <label for="s3">Discours ou symboles haineux</label>
            <input type="radio" id="s3" name="raison" value="Discours ou symboles haineux"><br>
            <label for="s4">Violence ou organisations dangereuses</label>
            <input type="radio" id="s4" name="raison" value="Violence ou organisations dangereuses"><br>
            <label for="s5">Intimidation ou harc&egrave;lement</label>
            <input type="radio" id="s5" name="raison" value="Intimidation ou harc&egrave;lement"><br>
            <label for="s6">Vente de biens ill&eacute;gaux ou r&eacute;glement&eacute;s</label>
            <input type="radio" id="s6" name="raison" value="Vente de biens ill&eacute;gaux ou r&eacute;glement&eacute;s"><br>
            <label for="s7">Atteintes aux droits de propri&eacute;t&eacute; intellectuelle</label>
            <input type="radio" id="s7" name="raison" value="Atteintes aux droits de propri&eacute;t&eacute; intellectuelle"><br>
            <label for="s8">Suicide ou automutilation</label>
            <input type="radio" id="s8" name="raison" value="Suicide ou automutilation"><br>
            <label for="s9">Troubles de l&rsquo;alimentation</label>
            <input type="radio" id="s9" name="raison" value="Troubles de l&rsquo;alimentation"><br>
            <label for="s10">Arnaques ou fraude</label>
            <input type="radio" id="s10" name="raison" value="Arnaques ou fraude"><br>
            <label for="s11">Fausses informations</label>
            <input type="radio" id="s11" name="raison" value="Fausses informations"><br>
            <label for="s12">Autre</label>
            <input type="radio" id="s12" name="raison" value="Autre"><br>
        
            <input type="submit" name="yes" value="Signaler">
            <input type="submit" name="no" value="Annuler">
        </form>
    </section>
</body>




</html>
