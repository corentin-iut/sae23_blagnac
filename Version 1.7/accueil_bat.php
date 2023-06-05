<?php    

    /*Database connection*/

    $id_bd = mysqli_connect("localhost","root","root","sae23")
        or die("Connexion impossible à la base de données");

    /*To retrieve building names*/

    $resultat = mysqli_query($id_bd, "SELECT nom FROM batiment");

    /*To find the most recent values based on the id*/

    $capteur1 = mysqli_query($id_bd, "SELECT c.nom, m.valeur, m.date FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E101' ORDER BY m.id DESC LIMIT 1;");
    $capteur2 = mysqli_query($id_bd, "SELECT c.nom, m.valeur, m.date FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E102' ORDER BY m.id DESC LIMIT 1;");
    $capteur3 = mysqli_query($id_bd, "SELECT c.nom, m.valeur, m.date FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E103' ORDER BY m.id DESC LIMIT 1;");
    $capteur4 = mysqli_query($id_bd, "SELECT c.nom, m.valeur, m.date FROM capteur c JOIN mesure m ON c.id = m.capteur WHERE c.nom = 'E104' ORDER BY m.id DESC LIMIT 1;");
    $liste = [$capteur1, $capteur2, $capteur3, $capteur4];

    mysqli_close($id_bd);

?>
