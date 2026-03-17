<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";
 
    //On récup le surnom et l'id de l'utilisateur connecté
    $surnom = $_SESSION['user']['surnom'];
    $id = $_SESSION['user']['id'];

    //On regarde dans la base de donnée s'il y a des demandes
    $req_demande = "SELECT * FROM demande_abonnement WHERE followed = '$id';";
    $res_demande = mysqli_query($connexion,$req_demande);
    $ligne_demande = mysqli_fetch_assoc($res_demande);


    //L'utilisateur accepte la demande
    if(isset($_POST['yes'])){
        $identifiantfollower = $_POST['idfollower'];
        
        //On récupère les données de la personne qui a fait la demande à l'utilisateur connecté
        $req_user = "SELECT * FROM user WHERE identifiant = '$identifiantfollower';";
        $res_user = mysqli_query($connexion,$req_user);
        $ligne_user = mysqli_fetch_assoc($res_user);

        //On récupère les nouveaux nombres d'abonné et d'abonnement
        $ajout_nbrfollowing = $ligne_user['follow']+1;
        $ajout_nbrfollower = $_SESSION['user']['follower']+1;

        //pour insérer l'abonnement dans la table de donnée
        $req_follow = "INSERT INTO abonnement (follow, followed) VALUES ('$identifiantfollower', '$id');";
        $res_follow = mysqli_query($connexion,$req_follow);
        //pour mettre à jour le nombre d'abonnée et d'abonnement des utilisateurs concernés
        //ajout du nouvel abonné dans la table de la personne qui reçoit l'abonnement
        $req_follower = "UPDATE user SET follower = '$ajout_nbrfollower' WHERE identifiant = '$id';";
        $res_follower = mysqli_query($connexion,$req_follower);
        //ajout du nouvel abonnement pour la personne qui s'abonne
        $req_following = "UPDATE user SET follow = '$ajout_nbrfollowing' WHERE identifiant = '$identifiantfollower';";
        $res_following = mysqli_query($connexion,$req_following);
        //supprimer la demande
        $req_delete = "DELETE FROM demande_abonnement WHERE follow = '$identifiantfollower' AND followed ='$id';";
        $res_delete = mysqli_query($connexion,$req_delete);
        //Mis-à-jour des infos dans session
        $_SESSION['user']['follower'] = $ajout_nbrfollower;
        //on actualise la page
        header("Location: http://localhost/Projet_Minari/code/demandeabonnement.php");
    }

    if(isset($_POST['no'])){
        $identifiantfollower = $_POST['idfollower'];

        //supprimer la demande
        $req_delete = "DELETE FROM demande_abonnement WHERE follow = '$identifiantfollower' AND followed ='$id';";
        $res_delete = mysqli_query($connexion,$req_delete);
        //on actualise la page
        header("Location: http://localhost/Projet_Minari/code/demandeabonnement.php");
    }


    //pour afficher les profils qui ont fait la demande ainsi que le bouton pour accepter ou non la demande
    while($ligne_demande){
        $idfollower = $ligne_demande['follow'];
        //On récupère les données de la personne qui a fait la demande à l'utilisateur connecté
        $req_user = "SELECT * FROM user WHERE identifiant = '$idfollower';";
        $res_user = mysqli_query($connexion,$req_user);
        $ligne_user = mysqli_fetch_assoc($res_user);

        //on affiche les profils + les demandes
        echo "<div class=\"post\"><a href=\"profil.php?id=".$ligne_user['identifiant']."\"><img class=\"userpdp\" src=\"".$ligne_user["pdp"]."\" alt=\"Erreur\"></a>";
        echo "<div class=\"user\">".$ligne_user["surnom"]."<br>";
        echo "@".$ligne_user["identifiant"]."</div><br>";
        echo "<form method=\"POST\">
        <input type=\"submit\" name=\"yes\" value=\"Accepter la demande\">
        <input type=\"submit\" name=\"no\" value=\"Refuser la demande\">
        <input type=\"hidden\" name=\"idfollower\" value=\"{$ligne_user['identifiant']}\">
        </form></div>";
        $ligne_demande = mysqli_fetch_assoc($res_demande);
    }

    
   
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title><?php echo $surnom." (@".$id.")"?></title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="demandeabonnementstyle.css">
</head>

<body>
    
    <!-- Code pour afficher l'index -->
    <?php
        include "index.php";
    ?>

</body>

</html>
