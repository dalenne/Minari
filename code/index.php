<?php   
    //On récup les données de l'utilisateur connecté : s'il a un compte privé ou admin
    $prive = $_SESSION['user']['prive'];
    $admin = $_SESSION['user']['admin'];

    //Pour avoir les notifications du nombre de message non lu, du nombre de demande d'abonnement et du nombre de posts signalés à traiter
    include "notification.php";

    //Code pour afficher l'index 
    echo "<section class=\"index\">
    <button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/accueil.php';\" class=\"accueil\"><span>Accueil</span></button>
    <button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/rechercher.php';\" class=\"recherche\"><span>Rechercher</span></button>
    <button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/messageprive.php';\" class=\"mp\"><span>Messages privés ";
    if($notif_msg>0){echo "(".$notif_msg.")";}
    echo "</span></button>";
    echo "<button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/profil.php?id=self';\"class=\"profil\"><span>Profil</span></button>";
    
    if(isset($idURL)){
        //Il n'apparait que si on regarde notre profil
        if(htmlspecialchars($idURL=="self")){
            echo "<button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/parametreprofil.php';\" class=\"prpr\"><span>Paramètre profil</span></button>"; 
        }
    }

    //Si l'utilisateur connecté a un compte privé alors il a accès à la page des demandes d'abonnements
    if($prive==1 and !isset($signaletraitement) and !isset($publier)){
        echo "<button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/demandeabonnement.php';\" class=\"da\"><span>Demande d'abonnement ";
        if($notif_abo>0){echo "(".$notif_abo.")";}
        echo "</span></button>";
    }

    echo "<button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/publier.php';\" class=\"publier\"><span>Publier</span></button>";
    
    //Si l'utilisateur connecté est admin alors il a accès à la page des posts signalés à traiter
    if($admin==1 and !isset($publier)){
        echo "<button onclick=\"window.location.href = 'http\://localhost/Projet_Minari/code/postssignales.php';\" class=\"ps\"><span>Posts signal&eacute;s ";
        if($notif_signal>0){echo "(".$notif_signal.")";}
        echo "</span></button>";
    }
    
    echo "<a href=\"http://localhost/Projet_Minari/code/deconnexion.php\" class=\"deconnexion\">Déconnexion</a>
    </section>";
?>