<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();

    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    $id = $_SESSION["user"]["id"];
    $surnom = $_SESSION["user"]["surnom"];
    $nbr_post = $_SESSION["user"]["nbr_post"];
    $aujourdhui = date("Y-m-d H:i:s"); // pour la date sql
    $datepubli = date("YmdHis"); //pour le nom de l'image du post s'il y en a un
    $publier = true;

    //vérification publication
    include "publiertraitement.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title><?php echo $surnom." (@".$id.")"?></title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="publierstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>
    
    <h1>Que voulez-vous partager au monde <?php echo $surnom." ?"?><h1>
    <section class="form">
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="contenutexte" placeholder="Quelque chose à nous raconter ?" autocomplete="off" maxlength="300" value="<?php if(isset($contenu_txt)){echo $contenu_txt;};?>">
           
            <label for="image" classe="fichier"><?php if(isset($er_image)){echo $er_image;}?></label>
            <input type="file" name="contenuimage" accept=".jpg, .jpeg, .png"> 

            
            <input type="checkbox" name="postephemere" value="1">
            <label for="postephemere">Post éphémère ? (disparait au bout de 5 mins)</label>

            <input type="submit" name ="publier" value="Publier">
        </form>
    </section>

    <!-- Code pour afficher l'index -->
    <?php
        include "index.php";
    ?>


</body>

</html>
