<?php
if(isset($_POST["login"])){

$v_pseudoOUmail = htmlspecialchars(strtolower($_POST["pseudoOUmail"])); //on utilise htmlspecialchars pour éviter que la personne puisse rentrer une commande 
$v_mdp = $_POST["mdp"];

//On regarde tout d'abord si l'utilisateur souhaite se connecter avec un mail ou l'identifiant
//dans ce cas-là l'utilisateur a utilisé un mail, 
if(filter_var($v_pseudoOUmail, FILTER_VALIDATE_EMAIL)){ 
    //on vérifie que le mail existe dans la base de donnée
    $req_mail = "SELECT * FROM user WHERE email = '$v_pseudoOUmail';";
    $res_mail = mysqli_query($connexion,$req_mail);
    $ligne_mail = mysqli_fetch_assoc($res_mail);

    if(!isset($ligne_mail['email'])){ 
        //le mail n'existe pas
        $erreur = "L'utilisateur et/ou le mot de passe est incorrect.";
    }
    else{
        //le mail existe, on vérifie maintenant que le mot de passe est correct
        if(!password_verify($v_mdp, $ligne_mail['mdp'])){
            //le mot de passe est incorrect
            $erreur = "L'utilisateur et/ou le mot de passe est incorrect.";
        }
        else{
            //Le mot de passe est correct, on stocke dans $_SESSION les infos du compte et on connecte l'utilisateur
           $_SESSION["user"] = [
            "id" => $ligne_mail['identifiant'],
            "surnom" => $ligne_mail['surnom'],
            "pdp" => $ligne_mail['pdp'],
            "banniere" => $ligne_mail['banniere'],
            "bio" => $ligne_mail['biographie'],
            "follower" => $ligne_mail['follower'],
            "following" => $ligne_mail['follow'],
            "nbr_post" => $ligne_mail['nbr_post'],
            "admin" => $ligne_mail['nbr_post'],
            "prive" => $ligne_mail['prive']
           ];
           
           //on ferme la connexion sql et on redirige vers son profil
           mysqli_close($connexion);
           header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");
   
           exit;
       }
    }
}

//dans ce cas-là l'utilisateur a utilisé un identifiant, 
else{ 
    //on vérifie que l'identifiant existe dans la base de donnée
    $req_id = "SELECT * FROM user WHERE identifiant = '$v_pseudoOUmail';";
    $res_id = mysqli_query($connexion,$req_id);
    $ligne_id = mysqli_fetch_assoc($res_id);

    if(!isset($ligne_id['identifiant'])){ 
        //l'identifiant n'existe pas
        $erreur = "L'utilisateur et/ou le mot de passe est incorrect.";
    }
    else{
        //l'identifiant existe, on vérifie maintenant que le mot de passe est correct
        if(!password_verify($v_mdp, $ligne_id['mdp'])){
            //le mot de passe est incorrect
            $erreur = "L'utilisateur et/ou le mot de passe est incorrect.";
        }
        else{
             //Le mot de passe est correct, on stocke dans $_SESSION les infos du compte et on connecte l'utilisateur
            $_SESSION["user"] = [
            "id" => $ligne_id['identifiant'],
            "surnom" => $ligne_id['surnom'],
            "pdp" => $ligne_id['pdp'],
            "banniere" => $ligne_id['banniere'],
            "bio" => $ligne_id['biographie'],
            "follower" => $ligne_id['follower'],
            "following" => $ligne_id['follow'],
            "nbr_post" => $ligne_id['nbr_post'],
            "admin" => $ligne_id['admin'],
            "prive" => $ligne_id['prive']
            ];

            //on ferme la connexion sql et on redirige vers son profil
            mysqli_close($connexion);
            header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");
    
            exit;
        }
    }
}

}
?>