<!-- Connexion avec la base de donnée -->
<?php
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    //On démarre la session php 
    session_start();

    $id = $_SESSION["user"]["id"];
    $surnom = $_SESSION["user"]["surnom"];
    $follower = $_SESSION["user"]["follower"];
    $following = $_SESSION["user"]["following"];
    $nbr_post = $_SESSION["user"]["nbr_post"];
    $admin = $_SESSION['user']['admin'];

    $req_id = "SELECT * FROM user WHERE identifiant = '$id';";
    $res_id = mysqli_query($connexion,$req_id);
    $ligne_id = mysqli_fetch_assoc($res_id);
?>

<!-- Vérification des réponses du formulaire lorsqu'il appuie pour valider les modification -->
<?php
    if(isset($_POST["modifier"])){
        extract($_POST);
        $valid = true;

        $v_surnom = htmlspecialchars(trim($_POST["surnom"])); //on utilise htmlspecialchar pour éviter que la personne puisse rentrer une commande 
        $v_bio = htmlspecialchars($_POST["bio"]);
        

        //Vérification de la photo de profil
        if(file_exists($_FILES['pdp']['tmp_name'])){
            if($_FILES['pdp']['size'] > 1000000){
                $er_pdp = ("L'image ne doit pas dépasser 1 Mo");
                $valid = false;
            }
        }
        
        //Vérification de la photo de bannière
        if(file_exists($_FILES['banniere']['tmp_name'])){
            if($_FILES['banniere']['size'] > 5000000){
                $er_banniere = ("L'image ne doit pas dépasser 5 Mo");
                $valid = false;
            } 
        }

        //Vérification si l'utilisateur veut un compte privé ou public
        if($_POST["publicouprive"]=="public"){
            //Ici il veut un compte public
            $pp = 0;
        }
        else{
            //dans ce cas là l'utilisateur veut un compte privé
            $pp = 1;
        }

        //Dans le cas où tout est bon
        if($valid){
            //il ne change pas de photo de profil
            if(!file_exists($_FILES['pdp']['tmp_name'])){ 
                $v_pdp = $ligne_id['pdp'];
            }
            //on sauvegarde la photo de profil s'il en a donné une
            else{ 
                if($ligne_id['pdp'] != "profils/sanspdp.png"){
                    unlink($ligne_id['pdp']); //on supprime l'ancienne photo de profil sauf si c'était la photo de base
                }
                $emplacement_pdp = "profils/".$id.".png";
                move_uploaded_file($_FILES["pdp"]["tmp_name"],$emplacement_pdp);
                $v_pdp = "profils/".$id.".png";
            }

            //il ne change pas de photo de bannière
            if(!file_exists($_FILES['banniere']['tmp_name'])){ 
                $v_banniere = $ligne_id['banniere'];
            }
            //on sauvegarde la photo de bannière s'il en a donné une
            else{ 
                if($ligne_id['banniere'] != "bannieres/sansbanniere.jpg"){
                    unlink($ligne_id['banniere']); //on supprime l'ancienne photo de bannière sauf si c'était la photo de base
                }
                $emplacement_banniere = "bannieres/".$id.".png";
                move_uploaded_file($_FILES["banniere"]["tmp_name"],$emplacement_banniere);
                $v_banniere = "bannieres/".$id.".png";
            }

        $req_compte = "UPDATE user SET surnom = '$v_surnom', pdp = '$v_pdp', banniere = '$v_banniere', biographie = '$v_bio', prive = '$pp' WHERE identifiant = '$id';";
        $res_compte = mysqli_query($connexion,$req_compte);
        //On update dans $_SESSION les infos du compte pour l'utilisateur 
        $_SESSION["user"]["surnom"] = $v_surnom;
        $_SESSION["user"]["pdp"] = $v_pdp;
        $_SESSION["user"]["banniere"] = $v_banniere;
        $_SESSION["user"]["bio"] = $v_bio;
        header("Location: http://localhost/Projet_Minari/code/parametreprofil.php");

        exit;
        }

    }
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title><?php echo $surnom." (@".$id.")"?></title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="parametreprofilstyle.css">
</head>

<body>
    <!-- Code pour afficher la bannière tout en haut de la page -->
    <?php include "banner.php";?>

    <section class ="form">
    <h1>Réécrivez par dessus si vous souhaitez modifier quelque chose<h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="surnom">Surnom:</label>
            <input type="text" name="surnom" placeholder="Comment voulez-vous qu'on vous appelle ?" autocomplete="off" minlength="1" maxlength="20" value="<?php if(!isset($v_surnom)){echo $ligne_id['surnom'];}else{echo $v_surnom;};?>">
           
            <label for="pdp" classe="fichier">Photo de profil:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($er_pdp)){echo $er_pdp;}?></label>
            <input type="file" name="pdp" accept=".jpg, .jpeg, .png"> 

            <label for="banniere" classe="fichier">Photo de bannière:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($er_banniere)){echo $er_banniere;}?></label>
            <input type="file" name="banniere" accept=".jpg, .jpeg, .png"> 

            <label for="bio">Biographie:</label>
            <input type="text" name="bio" maxlength="300" autocomplete="off" value="<?php if(!isset($v_bio)){echo $ligne_id['biographie'];}else{echo $v_bio;};?>">
            
            <br>
            <label for="public">Compte Public</label>
            <input type="radio" id="public" name="publicouprive" value="public" <?php if($ligne_id['prive']==0){echo "checked";}?>>
            <br>
            <label for="prive">Compte Privé</label>
            <input type="radio" id="prive" name="publicouprive" value="prive" <?php if($ligne_id['prive']==1){echo "checked";}?>>
            <br>

            <input type="submit" name ="modifier" value="Confirmer les modifications">
        </form>
    </section>



    <!-- Code pour afficher l'index -->
    <?php include "index.php";?>

    

</body>

</html>

