<!-- Code pour vérifier si on regarde notre profil ou celui de quelqu'un d'autre -->
<?php
//Si on a mis dans l'url notre propre id, on la change automatiquement par self
if($idURL==$_SESSION["user"]["id"]){
        header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");

        exit;
    }

    //on regarde notre propre profil
    if(htmlspecialchars($idURL=="self")){
        $pdp = $_SESSION["user"]["pdp"];
        $id = $_SESSION["user"]["id"];
        $surnom = $_SESSION["user"]["surnom"];
        $banniere = $_SESSION["user"]['banniere'];
        $bio = $_SESSION["user"]['bio'];
        $follower = $_SESSION["user"]['follower'];
        $following = $_SESSION["user"]['following'];
        $nbr_post = $_SESSION["user"]['nbr_post'];

        $req_user = "SELECT * FROM user WHERE identifiant = '$id';";
        $res_user = mysqli_query($connexion,$req_user);
        $ligne_user = mysqli_fetch_assoc($res_user);
    }
    
    //on regarde le profil de quelqu'un d'autre, on doit faire des vérifications
    else{
        //on vérifie que l'identifiant existe dans la base de donnée
        $req_user = "SELECT * FROM user WHERE identifiant = '$idURL';";
        $res_user = mysqli_query($connexion,$req_user);
        $ligne_user = mysqli_fetch_assoc($res_user);
        if(!isset($ligne_user['identifiant'])){
            //il n'y a pas d'utilisateur avec cet identifiant
            //on ferme la connexion sql et on redirige
            mysqli_close($connexion);
            header("Location: http://localhost/Projet_Minari/code/introuvable.php");

            exit;
        }
        else{
            //il y a un utilisateur avec cet identifiant
            $pdp = $ligne_user['pdp'];
            $id = $ligne_user['identifiant'];
            $surnom = $ligne_user['surnom'];
            $banniere = $ligne_user['banniere'];
            $bio = $ligne_user['biographie'];
            $follower = $ligne_user['follower'];
            $following = $ligne_user['follow'];
            $nbr_post = $ligne_user['nbr_post'];
        }
    }
?>