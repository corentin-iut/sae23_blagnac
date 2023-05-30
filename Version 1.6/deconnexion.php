<?php
    session_start();
    $_SESSION = array();
    session_destroy(); /*suppression des données d'une session*/
    header('Location: login.php');
?>
