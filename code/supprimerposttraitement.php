<?php
    $idpost = htmlspecialchars(strtolower(trim($_GET["idpost"])));
    $admin  = $_SESSION["user"]["admin"];

    //Pour pouvoir se situer dans afficherpost.php
    $supprimerpost = true;
    
    //on récupère les données du post + de son auteur
    $req_post = "SELECT * FROM post WHERE id_post = '$idpost';";
    $res_post = mysqli_query($connexion,$req_post);
    $ligne_post = mysqli_fetch_assoc($res_post);

    $id = $ligne_post["user"];

    $req_user = "SELECT * FROM user WHERE identifiant = '$id';";
    $res_user = mysqli_query($connexion,$req_user);
    $ligne_user = mysqli_fetch_assoc($res_user);

    //On compte l'eventuel nouveau nombre de post de l'auteur
    $nbr_post = $ligne_user['nbr_post'];
    $nv_nbr_post = $nbr_post-1;


    //On regarde si l'utilisateur connecté a le droit de supprimer le post ou si le post existe même
    if(!isset($ligne_post['id_post'])){
         //il n'y a pas de post avec cet id
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }
    else{
        //il y a bien un post existant, on vérifie si l'utilisateur a le droit de le supprimer maintenant
        if($id!=$_SESSION["user"]["id"] and $admin!=1){
            //il n'a pas le droit donc on le redirige vers son profil
            header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

            exit;
        }
    }
    
    //s'il a passé les vérifications, alors il a le droit de supprimer le post

    //s'il a cliqué non au final
    if(isset($_POST["no"])){
        //il ne veut pas supprimer le post donc on le redirige vers son profil
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }

    //s'il veut supprimer le post
    if(isset($_POST["yes"])){
        //faire -1 au nombre de post de l'utilisateur (+ si c'est le post de l'utilisateur connecté mettre à jour $_SESSION)
        if($id==$_SESSION["user"]["id"]){
            $_SESSION["user"]["nbr_post"] = $nv_nbr_post;
        }
        $req_compte = "UPDATE user SET nbr_post = '$nv_nbr_post' WHERE identifiant = '$id';";
        $res_compte = mysqli_query($connexion,$req_compte);

        //supprimer s'il y a une image dans le dossier
        if($ligne_post['contenu_img'] != ""){
            unlink($ligne_post['contenu_img']); //on supprime l'ancienne photo de bannière sauf si c'était la photo de base
        }
        
        //supprimer de la table post
        $req_delete = "DELETE FROM post WHERE id_post = '$idpost';";
        $res_delete = mysqli_query($connexion,$req_delete);

        //on a supprimé le post donc on le redirige vers son profil maintenant
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }
?>