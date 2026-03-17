<!-- Vérification des réponses du formulaire lorsqu'il appuie s'inscrire -->
<?php
    if(isset($_POST["register"])){
        extract($_POST);
        $valid = true;

        $v_surnom = htmlspecialchars(trim($_POST["surnom"])); //on utilise htmlspecialchar pour éviter que la personne puisse rentrer une commande 
        $v_id = htmlspecialchars(strtolower(trim($_POST["identifiant"])));
        $v_email = htmlspecialchars(strtolower($_POST["email"]));
        $v_anniv = $_POST["anniv"];
        $v_mdp = htmlspecialchars($_POST["mdp"]);
        $v_mdp2 = htmlspecialchars($_POST["mdp2"]);

        //Vérification id
        //On autorise pas tous les caractères
        if(!preg_match("/^[a-z0-9_.]*$/",$v_id)) {
            $er_id = ("Caractères acceptés : a à z, 0 à 9, _ et .");
            $valid = false;
        }
        //On regarde si l'id est déjà pris ou non
        else{   
            $req_id = "SELECT identifiant FROM user WHERE identifiant = '$v_id';";
            $res_id = mysqli_query($connexion,$req_id);
            $ligne_id = mysqli_fetch_assoc($res_id);

            if(isset($ligne_id['identifiant'])){
                $er_id = ("Cet identifiant est déjà utilisé !");
                $valid = false;
            }
        }
        
        //Vérification mail
        //On regarde si le mail est valide
        if(!filter_var($v_email, FILTER_VALIDATE_EMAIL)){
            $er_email = ("Email invalide");
            $valid = false;
        }
        //On regarde si le mail est déjà pris ou non
        else{   
            $req_email = "SELECT email FROM user WHERE email = '$v_email';";
            $res_email = mysqli_query($connexion,$req_email);
            $ligne_email = mysqli_fetch_assoc($res_email);

            if(isset($ligne_email['email'])){
                $er_email = ("Ce mail est déjà utilisé !");
                $valid = false;
            }
        }

        //Vérification anniv
        //On regarde si l'utilisateur a bien + de 13 ans
        $age = date_diff(date_create($v_anniv),date_create($aujourdhui));
        if($age->format('%y')<13){
            $er_anniv = ("Il faut avoir minimum 13 ans pour s'inscrire");
            $valid = false;
        }

        //Vérification mdp
        //On regarde si les deux mdp sont les mêmes
        if($v_mdp != $v_mdp2){
            $er_mdp = ("Les deux mots de passe ne correspondent pas");
            $valid = false;
        }

        //Vérification de la photo de profil
        if(file_exists($_FILES['pdp']['tmp_name'])){
            //$info = new SplFileInfo($_FILES['pdp']['name']);
            //$extension_upload = $info->getExtension();
            //$extensions_autorisees = array('jpg', 'jpeg', 'png');
            if($_FILES['pdp']['size'] > 1000000){
                $er_pdp = ("L'image ne doit pas dépasser 1 Mo");
                $valid = false;
            }
            //elseif(!in_array($extension_upload, $extensions_autorisees)){  //une autre solution a été trouvé pour éviter des fichiers d'autres extensions
                //$er_pdp = ("Extensions acceptées : jpg, jpeg, png");
                //$valid = false;
           //}
        }
        

        //Dans le cas où tout est bon
        if($valid){
            if(!file_exists($_FILES['pdp']['tmp_name'])){ // si la personne ne met pas de photo de profil, on attribut un automatiquement
                $v_pdp = ("profils/sanspdp.png"); 
            }
            else{ //on sauvegarde la photo de profil s'il en a donné une
                $emplacement = "profils/".$v_id.".png";
                move_uploaded_file($_FILES["pdp"]["tmp_name"],$emplacement);
                $v_pdp = "profils/".$v_id.".png";
            }
        $v_mdp = password_hash($v_mdp2, PASSWORD_ARGON2ID); //on hashe le mot de passe pour + de sécurité
        //On rajoute l'utilisateur dans la base de donnée
        $req_compte = "INSERT INTO user (identifiant, mdp, surnom, email, anniversaire, pdp, creation) VALUES ('$v_id', '$v_mdp', '$v_surnom', '$v_email', '$v_anniv', '$v_pdp', '$aujourdhui');";
        $res_compte = mysqli_query($connexion,$req_compte);
        //On stocke dans $_SESSION les infos du compte pour que l'utilisateur n'a pas à se connecter juste après l'inscription
        $_SESSION["user"] = [
            "id" => $v_id,
            "surnom" => $v_surnom,
            "pdp" => $v_pdp,
            "inscription" => 1,
            //pour la suite on peut directement taper ces valeurs car ce sont des valeurs par défaut lorsqu'on s'inscrit
            "banniere" => "bannieres/sansbanniere.jpg",
            "bio" => "A compléter...",
            "follower" => 0,
            "following" => 0,
            "nbr_post" => 0,
            "admin" => 0,
            "prive" => 0
        ];
        
        //on ferme la connexion sql et on redirige 
        mysqli_close($connexion);
        header("Location: http://localhost/Projet_Minari/code/inscriptionvalide.php");
        
        exit;
        }

    }
?>