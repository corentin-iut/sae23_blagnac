<?php

    session_start();

    if(!isset($_SESSION["droit"]) || ($_SESSION["droit"] != "admin" && $_SESSION["droit"] != "gestionnaire")) {
        header("Location: login.php");
        exit();
    }

    /*Role verification to access the manager page*/
    
    /*Database connection*/

    $id_bd = mysqli_connect("lhcp3349.webapps.net","iv5g2mc0_admin","Motdepasse31!","iv5g2mc0_sae21")
        or die("Connexion impossible à la base de données");

    /*To see the building assigned to the manager*/

    $nom_gestionnaire = $_SESSION["identifiant"];
    $batiment = mysqli_query($id_bd, "SELECT b.nom FROM batiment b JOIN gestionnaire g ON b.gestionnaire = g.id WHERE g.login = '$nom_gestionnaire';");
   

    



    /*The statistics of the values retrieved*/

    function statistique($resultat) {
        $valeur = [];
        while ($ligne = mysqli_fetch_assoc($resultat)) {
            $valeur[] = $ligne['valeur'];
        }

        $min = min($valeur);
        $max = max($valeur);
        $moyenne = array_sum($valeur) / count($valeur);

        return ['min' => $min, 'max' => $max, 'moyenne' => $moyenne];
    }   

    /*Retrieval of values*/

    if($batiment) {
        $ligne = mysqli_fetch_assoc($batiment);
        $nom_bat = $ligne['nom'];
        if($ligne) {
            $message = "Le bâtiment géré par " . $nom_gestionnaire . " est : " . $nom_bat;
            $premiere_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E001' ORDER BY m.id DESC LIMIT 20;");
            $deuxieme_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E105' ORDER BY m.id DESC LIMIT 20;");
            $troisieme_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'B202' ORDER BY m.id DESC LIMIT 20;");
            $quatrieme_salle =mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'B203' ORDER BY m.id DESC LIMIT 20;");
            $stats_premiere_salle = statistique($premiere_salle);
            $stats_deuxieme_salle = statistique($deuxieme_salle);
            $stats_troisieme_salle = statistique($troisieme_salle);
            $stats_quatrieme_salle = statistique($quatrieme_salle);
        } else {
            $message = "Aucun bâtiment n'est géré par " . $nom_gestionnaire;
        }
    }

    /*Suppression*/
    $requete = "SELECT b.etat FROM batiment b WHERE b.nom = '$nom_bat';";
    $resultatp = mysqli_query($id_bd, $requete);
    
    // Vérifier si la requête a réussi et obtenir la valeur de $etat
    if ($resultatp && mysqli_num_rows($resultatp) > 0) {
        $row = mysqli_fetch_assoc($resultatp);
        $etat = $row['etat'];
    } else {
        // Gérer l'erreur si la requête a échoué
        // Par exemple : $etat = 0;
        $etat = 0;
    }
    
    // Fermer le résultat de la requête
    mysqli_free_result($resultatp);
    
    /*Date Form*/

    if(isset($_POST['date'])) {
        $date = $_POST['date'];
        $date_premiere_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E001' AND m.date = '$date' ORDER BY m.id DESC LIMIT 20;");
        $date_deuxieme_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E105' AND m.date = '$date' ORDER BY m.id DESC LIMIT 20;");
        $date_troisieme_salle = mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'B202' AND m.date = '$date' ORDER BY m.id DESC LIMIT 20;");
        $date_quatrieme_salle =mysqli_query($id_bd,"SELECT c.nom, m.valeur, m.date, m.horaire FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'B203' AND m.date = '$date' ORDER BY m.id DESC LIMIT 20;");
    } else {
        $message2 = "Sélectionnez une date valide";
    }

    mysqli_close($id_bd);
    
?>

