<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    
    $idsession = $_SESSION['user']['id'];

    //Compter le nombre de message privé non répondu
    $notif_msg = 0;
    //On selectionne d'abord toutes les personnes avec qui la personne a des messages
    $req_salonmp = "SELECT * FROM messageprivesalon WHERE user1 = '$idsession' OR user2 = '$idsession';";
    $res_salonmp = mysqli_query($connexion,$req_salonmp);
    $ligne_salonmp = mysqli_fetch_assoc($res_salonmp);
    //Maintenant pour chaque personne, on regarde si c'est son interlocuteur qui a envoyé le dernier message et dans ce cas il a un msg non répondu en +
    while($ligne_salonmp){
        $idsalon = $ligne_salonmp['id_salon'];
        $req_msg = "SELECT * FROM messageprivecontenu WHERE id_salon = '$idsalon' ORDER BY date_msg DESC;";
        $res_msg = mysqli_query($connexion,$req_msg);
        $ligne_msg = mysqli_fetch_assoc($res_msg);

        //On regarde pour chaque post s'il a un message non lu
        if($ligne_msg){
            if($ligne_msg['user']!=$idsession){
                $notif_msg++;
            }
        }

        $ligne_salonmp = mysqli_fetch_assoc($res_salonmp);
    }

    //Compter le nombre de demande d'abonnement
    //On selectionne toutes les demandes et on compte le nombre de ligne
    $req_abo = "SELECT * FROM demande_abonnement WHERE followed = '$idsession';";
    $res_abo = mysqli_query($connexion,$req_abo);
    $notif_abo = mysqli_num_rows($res_abo);

    //Compter le nombre de posts signalés
    //On selectionne toutes les demandes et on compte le nombre de ligne
    $req_signal = "SELECT * FROM postsignale;";
    $res_signal = mysqli_query($connexion,$req_signal);
    $notif_signal = mysqli_num_rows($res_signal);

?>