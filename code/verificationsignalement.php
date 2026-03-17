<?php
    //Vérification supprimer post
    if(isset($_POST['supprimer'.$ligne_post['id_post']])){
        $id_post = $ligne_post['id_post'];
        header("Location: http://localhost/Projet_Minari/code/supprimerpost.php?idpost=$id_post");

        exit;
    }

    if(isset($_POST['retirer'.$ligne_post['id_post']])){
        $id_post = $ligne_post['id_post'];
        //On supprime le signalement de la base de donnée
        $req_delete = "DELETE FROM postsignale WHERE idpost = '$id_post';";
        $res_delete = mysqli_query($connexion,$req_delete);

        //On redirige vers posts signalés
        header("Location: http://localhost/Projet_Minari/code/postssignales.php");

        exit;
    }
?>