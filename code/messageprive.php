<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();
    //On vérifie qu'il soit bien connecté
    include_once "verifdeconnecte.php";

    $aujourdhui = date("Y-m-d H:i:s"); // pour la date sql

    //on récup les données de l'utilisateur connecté
    $admin = $_SESSION['user']['admin'];
    $idsession = $_SESSION['user']['id'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title>Minari - Messages Privés</title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="messageprivestyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <!-- Code pour afficher l'index -->
    <?php include "index.php";?>


</body>

</html>

<?php
    //On est dans les messages privés de quelqu'un
    if(isset($_GET["idsalon"])){
        $messageprive = true;
        $idsalonURL = htmlspecialchars($_GET["idsalon"]);
        //on récupère les utilisateurs du salon
        $req_salonmp = "SELECT * FROM messageprivesalon WHERE id_salon = '$idsalonURL';";
        $res_salonmp = mysqli_query($connexion,$req_salonmp);
        $ligne_salonmp = mysqli_fetch_assoc($res_salonmp);
        //l'interlocuteur est soit user1 soit user2 donc on regarde c'est lequel
        if($ligne_salonmp){
            if($ligne_salonmp['user1']==$idsession){
                $interlocuteur = $ligne_salonmp['user2'];
            }
            else{
                $interlocuteur = $ligne_salonmp['user1'];
            }
        }
        

        //Vérification lorsque l'utilisateur à envoyer un message
        if(isset($_POST['envoyer'])){
            extract($_POST);

            $message = htmlspecialchars($_POST['msg']);
            echo $message;

            //On insert le message dans le base de donnée
            $req_mp = "INSERT INTO messageprivecontenu (id_salon, user, contenu, date_msg) VALUES ('$idsalonURL', '$idsession', '$message', '$aujourdhui');";
            $res_mp = mysqli_query($connexion,$req_mp);

            //On réactualise la page
            header("Location: http://localhost/Projet_Minari/code/messageprive.php?idsalon=$idsalonURL");

            exit;
        }


        echo "<form method=\"POST\">
            <input type=\"text\" name=\"msg\" placeholder=\"Envoyer un message &agrave; @$interlocuteur\" autocomplete=\"off\" required>
            <input type=\"submit\" name=\"envoyer\" value=\"\">
            </form>";


        //on affiche les messages précédents
        $req_post = "SELECT * FROM messageprivecontenu WHERE id_salon = '$idsalonURL' ORDER BY date_msg DESC;";
        $res_post = mysqli_query($connexion,$req_post);
        $ligne_post = mysqli_fetch_assoc($res_post);

        while($ligne_post){
            include "afficherpost.php";
            $ligne_post = mysqli_fetch_assoc($res_post);
        }
    }

    
    //On est pas encore dans le salon avec quelqu'un donc on montre tous les salons où l'utilisateur est inclus
    else{
        $req_salon = "SELECT * FROM messageprivesalon WHERE user1='$idsession' OR user2='$idsession';";
        $res_salon = mysqli_query($connexion,$req_salon);
        $ligne_salon = mysqli_fetch_assoc($res_salon);

        while($ligne_salon){
            if($ligne_salon['user1']==$idsession){
                $interlocuteur = $ligne_salon['user2'];

                $req_id = "SELECT * FROM user WHERE identifiant='$interlocuteur';";
                $res_id = mysqli_query($connexion,$req_id);
                $ligne_id = mysqli_fetch_assoc($res_id);

                echo "<div class=\"salonmp\"><img class=\"profilimage\" src=\"".$ligne_id["pdp"]."\" alt=\"Erreur\">";
                echo "<div class=\"surnom\">".$ligne_id["surnom"]."<br>";
                echo "@".$ligne_id["identifiant"];
                echo "<button class=\"voirprofil\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/messageprive.php?idsalon=".$ligne_salon["id_salon"]."&apos;\"><span>Voir les messages</span></button></div></div>";
                $ligne_salon = mysqli_fetch_assoc($res_salon);
            }
            else{
                $interlocuteur = $ligne_salon['user1'];

                $req_id = "SELECT * FROM user WHERE identifiant='$interlocuteur';";
                $res_id = mysqli_query($connexion,$req_id);
                $ligne_id = mysqli_fetch_assoc($res_id);

                echo "<div class=\"salonmp\"><img class=\"profilimage\" src=\"".$ligne_id["pdp"]."\" alt=\"Erreur\">";
                echo "<div class=\"surnom\">".$ligne_id["surnom"]."<br>";
                echo "@".$ligne_id["identifiant"];
                echo "<button class=\"voirmsg\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/messageprive.php?idsalon=".$ligne_salon["id_salon"]."&apos;\"><span>Voir les messages</span></button></div></div>";
                $ligne_salon = mysqli_fetch_assoc($res_salon);
            }
        }
    }


?>


