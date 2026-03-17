<!-- Code pour afficher le bouton envoyer un message -->
<?php
    //On regarde s'il existe déjà une discussion avec les deux utilisateurs
    $req_mp = "SELECT * FROM messageprivesalon WHERE (user1 = '$id' AND user2 = '$idsession') OR (user1 = '$idsession' AND user2 = '$id');";
    $res_mp = mysqli_query($connexion,$req_mp);
    $ligne_mp = mysqli_fetch_assoc($res_mp);

    //Si la personne clique sur envoyer un message
    if(isset($_POST['mp'])){
        //On regarde si un salon existe déjà
        if($ligne_mp){
            $idsalon = $ligne_mp['id_salon'];
            //Un salon existe déjà on le redirige vers son salon 
            header("Location: http://localhost/Projet_Minari/code/messageprive.php?idsalon=$idsalon");

            exit;
        }
        else{
            //On crée le salon et le rentre dans la base de donnée
            $req_mp = "INSERT INTO messageprivesalon (user1, user2) VALUES ('$id', '$idsession') ;";
            $res_mp = mysqli_query($connexion,$req_mp);
            
            //On le redirige vers son salon 
            $idsalon = mysqli_insert_id($connexion);
            header("Location: http://localhost/Projet_Minari/code/messageprive.php?idsalon=$idsalon");

            exit;
        }
    }
    
    
    //l'utilisateur a un compte public ou on follow la personne (s'il est privé mais qu'on follow = pas le droit d'envoyer de msg)
    //ou l'utilisateur est admin (on l'autorise à mp tout le monde)
    if($ligne_user['prive']==0 or $ligne_isfollowed or $_SESSION['user']['admin']==1){
        //On vérifie qu'il s'agit du profil de quelqu'un d'autre pour que le bouton envoyer un message apparaisse
        if($idURL!="self"){
            echo "
            <form method=\"POST\">
            <input type=\"submit\" name=\"mp\" value=\"Envoyer un message privé\" class=\"emp\">
            </form>";
        }
    }
    
?>