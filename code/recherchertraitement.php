<?php
    if(isset($_POST["valider"])){
        if(!empty($_POST["recherche"])){

            $find = htmlspecialchars($_POST["recherche"]);

            //recherche par id
            if($_POST["recherchetype"]=="id"){
                $req_id = "SELECT * FROM user WHERE identifiant LIKE '%$find%';";
                $res_id = mysqli_query($connexion,$req_id);
                $ligne_id = mysqli_fetch_assoc($res_id);

                while($ligne_id){
                    echo "<div class=\"profilimage\"><img class=\"pdp\" src=\"".$ligne_id["pdp"]."\" alt=\"Erreur\">";
                    echo "<div class=\"surnom\">".$ligne_id["surnom"]."<br>";
                    echo "@".$ligne_id["identifiant"]."</div>";
                    echo "<button class=\"voirprofil\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/profil.php?id=".$ligne_id["identifiant"]."&apos;\"><span>Voir le profil</span></button></div></div>";
                    $ligne_id = mysqli_fetch_assoc($res_id);
                }
            }


            //recherche par surnom
            if($_POST["recherchetype"]=="surnom"){
                $req_surnom = "SELECT * FROM user WHERE surnom LIKE '%$find%';";
                $res_surnom = mysqli_query($connexion,$req_surnom);
                $ligne_surnom = mysqli_fetch_assoc($res_surnom);

                while($ligne_surnom){
                    echo "<div class=\"profilimage\"><img class=\"pdp\" src=\"".$ligne_surnom["pdp"]."\" alt=\"Erreur\">";
                    echo "<div class=\"surnom\">".$ligne_surnom["surnom"]."<br>";
                    echo "@".$ligne_surnom["identifiant"]."</div>";
                    echo "<button class=\"voirprofil\" onclick=\"window.location.href = &apos;http\://localhost/Projet_Minari/code/profil.php?id=".$ligne_surnom["identifiant"]."&apos;\"><span>Voir le profil</span></button></div></div>";
                    $ligne_surnom = mysqli_fetch_assoc($res_surnom);
                }
            }

        }
    }
?>