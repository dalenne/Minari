<?php
    //On récupère les données du post et de l'auteur du post
    $id = $ligne_post['user'];
    $idconnecte = $_SESSION['user']['id'];
    $req_user = "SELECT * FROM user WHERE identifiant = '$id';";
    $res_user = mysqli_query($connexion,$req_user);
    $ligne_user = mysqli_fetch_assoc($res_user);
    
    //Si on est pas dans supprimerpost, signalement ou en mp
    if(!isset($supprimerpost) and !isset($signaletraitement) and !isset($messageprive)){
        //On regarde s'il s'agit d'un post éphémère ou non
        if($ligne_post['ephemere']==1){
            //On regarde si le temps du post à dépasser 5 mins
            $date1 = $ligne_post['date_publi'];
            $date2 = date("Y-m-d H:i:s");
    
            $timedebut = strtotime($date1); 
            $timefin = strtotime($date2); 
            $diff_minutes = round(abs($timedebut - $timefin) / 60,2);
            ////On supprime le post s'il dépasse 5 mins
            if($diff_minutes >= 5){
                $nbr_post = $ligne_user['nbr_post'];
                $nv_nbr_post = $nbr_post-1;
                $id_post = $ligne_post['id_post'];
                
                if($id==$_SESSION["user"]["id"]){
                    $_SESSION["user"]["nbr_post"] = $nv_nbr_post;
                }
    
                $req_compte = "UPDATE user SET nbr_post = '$nv_nbr_post' WHERE identifiant = '$id';";
                $res_compte = mysqli_query($connexion,$req_compte);
                
                //supprimer de la table post
                $req_delete = "DELETE FROM post WHERE id_post = '$id_post';";
                $res_delete = mysqli_query($connexion,$req_delete);
                
                $ligne_post = mysqli_fetch_assoc($res_post);
            }
        }
    }
    
    //On affiche l'auteur du post
    echo "<div class=\"post\"><a href=\"profil.php?id=".$ligne_user['identifiant']."\"><img class=\"userpdp\" src=\"".$ligne_user["pdp"]."\" alt=\"Erreur\"></a>";
    echo "<div class=\"user\">".$ligne_user["surnom"]."<br>";
    echo "@".$ligne_user["identifiant"]."</div><br>";

    //Si on affiche un message prive alors ce n'est pas le même fonctionnement
    if(isset($messageprive)){
        //on affiche le contenu du message privé
        echo $ligne_post["contenu"]."<br>";
        echo $ligne_post["date_msg"];
    }
    else{
        //On affiche le contenu du post
        echo $ligne_post["contenu_txt"]."<br>";
        if($ligne_post["contenu_img"] != ""){
            echo "<img class=\"postimage\" src=\"".$ligne_post["contenu_img"]."\" alt=\"Erreur\"><br>";
        }
        echo $ligne_post["date_publi"]."<br>&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    
    //On affiche un post et pas un message prive
    if(!isset($messageprive)){
        //On affiche le bouton like (il n'apparait pas quand on supprime un post ou quand on traite un signalement ou quand on regarde notre propre post)
        include_once "like.php";
        include "liketraitement.php";
        include "verificationsignalement.php";
        $nbrlike = nbrlike($ligne_post['id_post']);
        //On n'affiche pas de like si on regarde son propre post
        if($id != $idconnecte){
            //Afficher le bouton like ou unlike
            //S'il n'a pas encore liké
            if(!isLiked($ligne_post['id_post'],$_SESSION['user']['id']) and !isset($supprimerpost) and !isset($signaletraitement) and !isset($signalement)){
                echo "
            <form method=\"POST\">
            <input type=\"submit\" name=\"like{$ligne_post['id_post']}\" value=\"$nbrlike &#x2764;&#xFE0F | Ajouter un like\">
            </form>";
            }
            //S'il a déjà liké alors c'est le bouton unlike qui doit apparaitre
            elseif(isLiked($ligne_post['id_post'],$_SESSION['user']['id']) and !isset($supprimerpost) and !isset($signaletraitement) and !isset($signalement)){
                echo "
                <form method=\"POST\">
                <input type=\"submit\" name=\"unlike{$ligne_post['id_post']}\" value=\"$nbrlike &#x2764;&#xFE0F | Enlever votre like\">
                </form>";
            }
        }
        //On regarde notre propre post ou on est en train de supprimer un post ou on traite un signalement
        else{
            echo $nbrlike."&#x2764;&#xFE0F";
        }
    }
    
    //Si on est en suppresion d'un post ou dans un message privé on ne rajoute pas + d'info
    if(isset($supprimerpost) or isset($messageprive) or isset($signalement)){
        echo "</div>";
    }
    //Si on est dans un signalement on affiche les raisons du signalement + les boutons supprimer post ou retirer le signalement
    elseif(isset($signaletraitement)){
        $id_post = $ligne_post["id_post"];
        $req_raison = "SELECT * FROM postsignale WHERE idpost = '$id_post';";
        $res_raison = mysqli_query($connexion,$req_raison);
        $ligne_raison = mysqli_fetch_assoc($res_raison);
        echo "<hr><br>";
        while($ligne_raison){
            echo "@".$ligne_raison["user"]." a signal&eacute; ce post pour : ".$ligne_raison["raison"]."<br>";
            $ligne_raison = mysqli_fetch_assoc($res_raison);
        }
        echo "<form method=\"POST\">
        <input type=\"submit\" name=\"supprimer{$ligne_post['id_post']}\" value=\"Supprimer le Post\">
        <input type=\"submit\" name=\"retirer{$ligne_post['id_post']}\" value=\"Retirer le Signalement\">
        </form></div>";
    }
    //On regardre notre post ou on est admin, on a le droit au bouton supprimer post
    elseif(isset($droit_supp)){
        echo "<button class=\"supprimer\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/supprimerpost.php?idpost=".$ligne_post["id_post"]."&apos;;\"><span>Supprimer</span></button></div>";
    }
    //On regarde le post de quelqu'un d'autre, on a le droit au bouton signalement
    else{
        echo "<button class=\"supprimer\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/signalerpost.php?idpost=".$ligne_post["id_post"]."&apos;;\"><span>Signaler</span></button></div>";
    }
    
?>

