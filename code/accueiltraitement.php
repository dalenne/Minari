<!-- Code pour afficher les posts sur le profil + le bouton supprimer si admin -->
<?php
    $id = $_SESSION['user']['id'];

    //Pour avoir les posts des personnes follows
    $req_post = "SELECT * FROM post WHERE user IN (SELECT followed FROM abonnement WHERE follow = '$id') ORDER BY date_publi DESC;";
    $res_post = mysqli_query($connexion,$req_post);
    $ligne_post = mysqli_fetch_assoc($res_post);

    //Pour vérifier si admin
    $admin = $_SESSION['user']['admin'];

    //Si on est sur notre profil on peut supprimer ou alors si on est admin, donc le bouton apparait
    if($admin==1){
        while($ligne_post){
            $droit_supp = true;
            include "afficherpost.php";
            $ligne_post = mysqli_fetch_assoc($res_post);
        }
        
    }
    //là le bouton n'apparait pas : on est pas admin et on regarde la page de quelqu'un d'autre
    else{
        while($ligne_post){
            include "afficherpost.php";
            $ligne_post = mysqli_fetch_assoc($res_post);
        }
    }
?>