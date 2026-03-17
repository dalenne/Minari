<!-- Code pour afficher les infos sur le profil (nbr de post, d'abonnement...) + le bouton s'abonner et son fonctionnement-->
<?php

    //Pour nous aider à savoir si la personne est déjà abonné ou a déjà fait une demande
    $abonne = false;
    $demande = false;

    //Pour chercher dans la base de donnée des follows s'il existe une ligne avec l'utilisateur en ligne qui follow l'utilisateur du profil qu'on regarde
    $req_isfollowed = "SELECT * FROM abonnement WHERE followed = '$id' AND follow ='$idsession';";
    $res_isfollowed = mysqli_query($connexion,$req_isfollowed);
    $ligne_isfollowed = mysqli_fetch_assoc($res_isfollowed);
    if($ligne_isfollowed){
        $id_following = $ligne_isfollowed['id_following'];
        $abonne = true;
    }

    //Pour chercher dans la base de donnée des demandes s'il existe une ligne avec l'utilisateur en ligne qui follow l'utilisateur du profil qu'on regarde
    $req_isdemande = "SELECT * FROM demande_abonnement WHERE followed = '$id' AND follow ='$idsession';";
    $res_isdemande = mysqli_query($connexion,$req_isdemande);
    $ligne_isdemande = mysqli_fetch_assoc($res_isdemande);
    if($ligne_isdemande){
        $demande = true;
    }

    //Pour avoir les nouveaux nombre de follower (+1 si s'abonne et -1 si se désabonne)
    $ajout_nbrfollower = $follower + 1;
    $ajout_nbrfollowing = $_SESSION['user']['following']+1;
    $ajout_nbrunfollower = $follower - 1;
    $ajout_nbrunfollowing = $_SESSION['user']['following']-1;
    

    //Fonctionnement du bouton s'abonner
    if(isset($_POST["follow"])){
        //si le compte est privé il faut faire une demande d'abonnement
        if($ligne_user['prive']==1){
            //pour insérer l'abonnement dans la table de donnée
            $req_demande = "INSERT INTO demande_abonnement (follow, followed) VALUES ('$idsession', '$id');";
            $res_demande = mysqli_query($connexion,$req_demande);
            //Mis-à-jour des infos pour l'affichage dans le profil
            $demande = true;
            //On actualise la page
            header("Location: http://localhost/Projet_Minari/code/profil.php?id=$id");

            exit;
        }
        //le compte est public donc c'est directement s'abonner ou se désabonner
        else{
            //pour insérer l'abonnement dans la table de donnée
            $req_follow = "INSERT INTO abonnement (follow, followed) VALUES ('$idsession', '$id');";
            $res_follow = mysqli_query($connexion,$req_follow);
            //pour mettre à jour le nombre d'abonnée et d'abonnement des utilisateurs concernés
            //ajout du nouvel abonné dans la table de la personne qui reçoit l'abonnement
            $req_follower = "UPDATE user SET follower = '$ajout_nbrfollower' WHERE identifiant = '$id';";
            $res_follower = mysqli_query($connexion,$req_follower);
            //ajout du nouvel abonnement pour la personne qui s'abonne
            $req_following = "UPDATE user SET follow = '$ajout_nbrfollowing' WHERE identifiant = '$idsession';";
            $res_following = mysqli_query($connexion,$req_following);
            //Mis-à-jour des infos pour l'affichage dans le profil
            $follower = $ajout_nbrfollower;
            $_SESSION['user']['following'] = $ajout_nbrfollowing;
            $abonne = true;
            //On actualise la page
            header("Location: http://localhost/Projet_Minari/code/profil.php?id=$id");

            exit;
        }
    }

    if(isset($_POST["unfollow"])){
        //pour supprimer l'abonnement dans la table de donnée
        $req_unfollow = "DELETE FROM abonnement WHERE id_following = '$id_following';";
        $res_unfollow = mysqli_query($connexion,$req_unfollow);
        //pour mettre à jour le nombre d'abonnée et d'abonnement des utilisateurs concernés
        //On retire l'abonné dans la table de la personne qui reçoit l'abonnement
        $req_unfollower = "UPDATE user SET follower = '$ajout_nbrunfollower' WHERE identifiant = '$id';";
        $res_unfollower = mysqli_query($connexion,$req_unfollower);
        //On retire l'abonnement pour la personne qui s'abonne
        $req_unfollowing = "UPDATE user SET follow = '$ajout_nbrunfollowing' WHERE identifiant = '$idsession';";
        $res_unfollowing = mysqli_query($connexion,$req_unfollowing);
        //Mis-à-jour des infos pour l'affichage dans le profil
        $follower = $ajout_nbrunfollower;
        $_SESSION['user']['following'] = $ajout_nbrunfollowing;
        $abonne = false;
        //On actualise la page
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=$id");

        exit;
    }



     //Pour afficher les infos
     echo "<div class=\"banniere\"><a href=\"afficherbanniere.php?id=$id\" target=\"_blank\" rel=\"noopener noreferrer\"><img src=\"$banniere\" alt=\"Erreur\"></a></div>"; //la bannière
     echo "<span class=\"photoprofil\"><a href=\"afficherpdp.php?id=$id\" target=\"_blank\" rel=\"noopener noreferrer\"><img src=\"$pdp\" alt=\"Erreur\"></a></span>"; //pour mettre la photo de profil
     echo "<p class=\"surnom\">".$surnom."</p>";
     if($ligne_user['prive'] == 1){
        echo "<p class=\"id\">@".$id."&#128274;</p>";
        }
     else{
        echo "<p class=\"id\">@".$id."</p>";
     }
     echo "<p class=\"bio\">".$bio."</p>
     <p class=\"followers\">".$follower." abonné(e)s </p>
     <p class=\"following\">".$following." abonnements </p>
     <p class=\"posts\"> ".$nbr_post." posts </p>";


     
    //Afficher le bouton s'abonner ou se désabonner selon la situation (n'apparait QUE sur les profils d'autres comptes que le sien d'où le if)
    if(htmlspecialchars($idURL!="self")){
        //Si le compte est privé et qu'il a déjà fait une demande
        if($demande){
            echo "
        <form method=\"POST\">
        <input type=\"button\" name=\"demande\" value=\"Demande en cours\" class=\"ec\">
        </form>";
        }
        //Si le compte est public et qu'il n'est pas encore abonné
        elseif(!$abonne){
            echo "
        <form method=\"POST\">
        <input type=\"submit\" name=\"follow\" value=\"S'abonner\" class=\"abo\">
        </form>";
        }
        //S'il est déjà abonné alors c'est le bouton désabonner qui doit apparaitre
        elseif($abonne){
            echo "
            <form method=\"POST\">
            <input type=\"submit\" name=\"unfollow\" value=\"Se désabonner\" class=\"desabo\">
            </form>";
        }
        
    }

    
    
?>