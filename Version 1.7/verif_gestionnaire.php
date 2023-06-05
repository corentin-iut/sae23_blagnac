<?php

    session_start();

    if(!isset($_SESSION["droit"]) || ($_SESSION["droit"] != "admin" && $_SESSION["droit"] != "gestionnaire")) {
        header("Location: login.php");
        exit();
    }

    /*Role verification to access the manager page*/
    
?>

