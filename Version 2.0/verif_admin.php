<?php

    session_start();

    /*Role verification to access the admin page*/

    if(!isset($_SESSION["droit"]) || $_SESSION["droit"] != "admin") {
        header("Location: login.php");
        exit();
    }
    
    /*Database connection*/

    $id_bd = mysqli_connect("localhost","root","root","sae23")
        or die("Connexion impossible à la base de données");

    /*To view available handlers*/

    $resultat = mysqli_query($id_bd, "SELECT * FROM gestionnaire");

    /*Deleting a handler*/

    if(isset($_POST['suppression'])) {
        $nom_gestionnaire = $_POST["login"];
        $resultat = mysqli_query($id_bd, "DELETE FROM gestionnaire WHERE `login` = '$nom_gestionnaire';");
        header("Location: menu_admin.php");
        exit();
    }

    mysqli_close($id_bd);

?>

