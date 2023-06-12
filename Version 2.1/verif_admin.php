<?php

    session_start();

    /*Role verification to access the admin page*/

    if(!isset($_SESSION["droit"]) || $_SESSION["droit"] != "admin") {
        header("Location: login.php");
        exit();
    }
    
    /*Database connection*/

    $id_bd = mysqli_connect("lhcp3349.webapps.net","iv5g2mc0_admin","Motdepasse31!","iv5g2mc0_sae21")
        or die("Connexion impossible à la base de données");

    /*To view available handlers*/

    $resultat = mysqli_query($id_bd, "SELECT * FROM gestionnaire");

    /*Deleting a handler*/

    if(isset($_POST['suppression'])) {
        $nom_gestionnaire = $_POST['login'];
        $resultat = mysqli_query($id_bd, "DELETE FROM gestionnaire WHERE `login` = '$nom_gestionnaire';");
        header("Location: menu_admin.php");
        exit();
    }
    
    if(isset($_POST['suppresr'])) {
        $resultatp = mysqli_query($id_bd, "UPDATE batiment SET etat = 0 WHERE nom='batiment RT';");
        $etat = 0;
    }

    if(isset($_POST['ajoutr'])) {
        $resultatp = mysqli_query($id_bd, "UPDATE batiment SET etat = 1 WHERE nom='batiment RT';");
        $etat = 1;
    }
    
    if(isset($_POST['suppresi'])) {
        $resultatp = mysqli_query($id_bd, "UPDATE batiment SET etat = 0 WHERE nom='batiment info';");
        $etat = 0;
    }

    if(isset($_POST['ajouti'])) {
        $resultatp = mysqli_query($id_bd, "UPDATE batiment SET etat = 1 WHERE nom='batiment info';");
        $etat = 1;
    }
    mysqli_close($id_bd);

?>

