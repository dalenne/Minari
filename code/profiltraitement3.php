<!-- Code pour afficher les posts sur le profil + le bouton supprimer -->
<?php
    $req_post = "SELECT * FROM post WHERE user = '$id' ORDER BY date_publi DESC;";
    $res_post = mysqli_query($connexion,$req_post);
    $ligne_post = mysqli_fetch_assoc($res_post);
    

    //l'utilisateur a un compte privé (Si l'utilisateur en ligne est admin alors il est au dessus du système de compte privé)
    if($ligne_user['prive']==1 and $_SESSION['user']['admin']==0){
        //Si on n'est pas abonné à la personne qu'on regarde le profil et qu'on ne regarde pas notre profil alors ce message doit apparaitre
        if(!$ligne_isfollowed and $idURL!="self"){
            echo "<p class=\"compteprive\">Il s'agit d'un compte privé, vous ne pouvez pas voir les posts du compte</p>";
        }
    }

    //l'utilisateur a un compte public ou on follow la personne
    //ou on regarde notre propre profil ou l'utilisateur est admin (on l'autorise à voir les posts de comptes privés)
    if($ligne_user['prive']==0 or $ligne_isfollowed or $idURL=="self" or $_SESSION['user']['admin']==1){
        //Si on est sur notre profil on peut supprimer ou alors si on est admin, donc le bouton apparait
        if(htmlspecialchars($idURL=="self") or $admin==1){
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
    }
    
?>