<?php
    //Vérfication de like/unlike

    $user = $_SESSION['user']['id'];

    //fonction pour vérifier si un post est déjà liké ou non
    function isLiked($idpost,$user){
        $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
        $req_isliked = "SELECT * FROM likes WHERE postliked = '$idpost' AND likedby ='$user';";
        $res_isliked = mysqli_query($connexion,$req_isliked);
        $ligne_isliked = mysqli_fetch_assoc($res_isliked);
        if($ligne_isliked){
            return true;
        }
        else{return false;}
    }
    
    //pour compter le nombre de like
    function nbrlike($idpost){
        $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
        $req_nbrlike = "SELECT nbr_like FROM post WHERE id_post = '$idpost';";
        $res_nbrlike = mysqli_query($connexion,$req_nbrlike);
        $ligne_nbrlike = mysqli_fetch_assoc($res_nbrlike);
        return $ligne_nbrlike['nbr_like'];
    }


?>