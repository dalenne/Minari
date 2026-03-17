<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root", "root", "projetminari");
    $idURL = htmlspecialchars(strtolower(trim($_GET["id"])));
    $req_id = "SELECT * FROM user WHERE identifiant = '$idURL';";
    $res_id = mysqli_query($connexion,$req_id);
    $ligne_id = mysqli_fetch_assoc($res_id);

    //Si un utilisateur n'est pas connecté il sera redirigé vers la page connexion
    include_once "verifdeconnecte.php";

    $surnom = $ligne_id['surnom'];
    $pdp = $ligne_id['pdp'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1, shrink-to-fit=no">
    <title><?php echo $surnom." (@".$idURL.")"?></title>
    <link rel="icon" href="images/logo9.png" type="image/png">
    <link rel="stylesheet" href="afficherpdpstyle.css">
</head>

<body>
    <?php 
    echo "<img src=\"$pdp\" alt=\"Erreur\">";
    ?>
</body>

</html>