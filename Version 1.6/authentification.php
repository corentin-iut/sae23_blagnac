<?php

    session_start();

    $id_bd = mysqli_connect("localhost","root","root","sae23")
        or die("Connexion impossible à la base de données");

    if(isset($_POST["connexion"])){
        if(!empty($_POST["pseudo"]) && !empty($_POST["mdp"]) && !empty($_POST["droit"])){

            $pseudo = mysqli_real_escape_string($id_bd, $_POST["pseudo"]);
            $pseudo_safe = htmlspecialchars($pseudo);
            $mdp = sha1($_POST["mdp"]);
            $statut = $_POST["droit"];

            if($statut == "admin"){
                $requete = "SELECT * FROM administration WHERE login = '$pseudo_safe' AND mdp = '$mdp'";
            } else {
                $requete = "SELECT * FROM gestionnaire WHERE login = '$pseudo_safe' AND mdp = '$mdp'";
            }

            $resultat = mysqli_query($id_bd, $requete);

            $_SESSION["droit"] = $statut; 
            $_SESSION["identifiant"] = $pseudo_safe;

            if((mysqli_num_rows($resultat) == 1) && ($statut == "gestionnaire")) { 
                header("Location: menu_gestionnaire.php"); 
                exit(); 
            } elseif((mysqli_num_rows($resultat) == 1) && ($statut == "admin")) {
                header("Location: menu_admin.php"); 
                exit();  
            } else {
                $error = "Identifiant ou mot de passe incorrect.";
            }
        }
    }

    mysqli_close($id_bd);

?>

 