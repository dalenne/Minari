<?php
    //S'il n'a jamais liké
    if(isset($_POST['like'.$ligne_post['id_post']])){
        $id_post = $ligne_post['id_post'];
        //pour insérer le like dans la table de donnée
        $req_like = "INSERT INTO likes (postliked, likedby) VALUES ('$id_post', '$user');";
        $res_like = mysqli_query($connexion,$req_like);
        //Update le nombre de like du post dans la base de donnée
        $nbrlike = nbrlike($id_post);
        $ajoutlike = $nbrlike+1;
        $req_nbrlike = "UPDATE post SET nbr_like = '$ajoutlike' WHERE id_post = '$id_post';";
        $res_nbrlike = mysqli_query($connexion,$req_nbrlike);
    }

    //S'il a déjà liké
    if(isset($_POST['unlike'.$ligne_post['id_post']])){
        $id_post = $ligne_post['id_post'];
        //pour insérer le like dans la table de donnée
        $req_unlike = "DELETE FROM likes WHERE postliked = '$id_post' AND likedby = '$user';";
        $res_unlike = mysqli_query($connexion,$req_unlike);
        //Update le nombre de like du post dans la base de donnée
        $nbrlike = nbrlike($id_post);
        $ajoutunlike = $nbrlike-1;
        $req_nbrunlike = "UPDATE post SET nbr_like = '$ajoutunlike' WHERE id_post = '$id_post';";
        $res_nbrunlike = mysqli_query($connexion,$req_nbrunlike);
    }
?>