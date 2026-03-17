<!-- Vérification des réponses du formulaire lorsqu'il appuie s'inscrire -->
<?php
    if(isset($_POST["publier"])){
        extract($_POST);
        $valid = true;

        if(empty($_POST['contenutexte']) AND !file_exists($_FILES['contenuimage']['tmp_name'])){
            echo "Vous ne pouvez pas publier du vide !";
        }
        else{
            $v_contenutexte = htmlspecialchars($_POST['contenutexte']);  //on utilise htmlspecialchar pour éviter que la personne puisse rentrer une commande 
    
            //Vérification de la photo utilisée
            if(file_exists($_FILES['contenuimage']['tmp_name'])){
                if($_FILES['contenuimage']['size'] > 10000000){
                    $er_image = ("L'image ne doit pas dépasser 10 Mo");
                    $valid = false;
                } 
                else{
                    //On sauvegarde l'image
                    $emplacement_image = "posts/".$id.$datepubli.".png";
                    move_uploaded_file($_FILES["contenuimage"]["tmp_name"],$emplacement_image);
                    $v_image = "posts/".$id.$datepubli.".png";
                }
            }

            //Verif si éphémère ou non
            if(isset($_POST['postephemere'])){
                $ephemere = $_POST['postephemere']; // = à 1
            }
            else{
                $ephemere = 0;
            }

            //Dans le cas où l'image est valide
            if($valid){
            $req_post = "INSERT INTO post (user, contenu_txt, contenu_img, date_publi, ephemere) VALUES ('$id', '$v_contenutexte', '$v_image', '$aujourdhui', '$ephemere');";
            $res_post = mysqli_query($connexion,$req_post);
            
            $nv_nbr_post = $nbr_post+1;
            $req_compte = "UPDATE user SET nbr_post = '$nv_nbr_post' WHERE identifiant = '$id';";
            $res_compte = mysqli_query($connexion,$req_compte);
            //On update dans $_SESSION les infos du compte pour l'utilisateur 
            $_SESSION["user"]["nbr_post"] = $nv_nbr_post;
           
            header("Location: http://localhost/Projet_Minari/code/profil.php?id=self");
            }
        }
        

    }
?>