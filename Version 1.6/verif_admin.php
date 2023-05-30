<?php

    session_start();

    if(!isset($_SESSION["droit"]) || $_SESSION["droit"] != "admin") {
        header("Location: login.php");
        exit();
    }
    
    $id_bd = mysqli_connect("localhost","root","root","sae23")
        or die("Connexion impossible à la base de données");

    $resultat = mysqli_query($id_bd, "SELECT * FROM gestionnaire");

    if(isset($_POST['suppression'])) {
        $nom_gestionnaire = $_POST["login"];
        $resultat = mysqli_query($id_bd, "DELETE FROM gestionnaire WHERE `login` = '$nom_gestionnaire';");
        header("Location: menu_admin.php");
        exit();
    }

    mysqli_close($id_bd);

?>

