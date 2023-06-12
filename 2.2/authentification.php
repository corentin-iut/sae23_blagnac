<?php

    session_start();

    /*Database connection*/

    $id_bd = mysqli_connect("lhcp3349.webapps.net","iv5g2mc0_admin","Motdepasse31!","iv5g2mc0_sae21")
        or die("Connexion impossible à la base de données");

    if(isset($_POST["connexion"])){
        if(!empty($_POST["pseudo"]) && !empty($_POST["mdp"]) && !empty($_POST["droit"])){

            /*Avoiding SQL and XSS injections*/

            $pseudo = mysqli_real_escape_string($id_bd, $_POST["pseudo"]);
            $pseudo_safe = htmlspecialchars($pseudo);
            $mdp = sha1($_POST["mdp"]);
            $statut = $_POST["droit"];

            /*Verification of login and password*/
            /*Checking permissions status*/

            if($statut == "admin"){
                $requete = "SELECT * FROM administration WHERE login = '$pseudo_safe' AND mdp = '$mdp'";
            } else { 
                $resultat_permission = mysqli_query($id_bd, "SELECT permission FROM gestionnaire WHERE login='$pseudo_safe'");
                $ligne_permission = mysqli_fetch_assoc($resultat_permission);
                if ($ligne_permission['permission'] == 1) {
                    $requete = "SELECT * FROM gestionnaire WHERE login = '$pseudo_safe' AND mdp = '$mdp'";
                } else {
                    header("Location: menu_admin.php");
                    exit();
                }
            }

            $resultat = mysqli_query($id_bd, $requete);

            /*Save role and name across sessions*/

            $_SESSION["droit"] = $statut; 
            $_SESSION["identifiant"] = $pseudo_safe;

            /*Redirection to corresponding pages*/

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

 