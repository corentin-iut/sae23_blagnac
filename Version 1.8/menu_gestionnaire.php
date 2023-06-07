<?php
    require("verif_gestionnaire.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_menu.css">
    <link rel="shortcut icon" href="./img/icons8-favicon-16.png" type="image/x-icon">
    <title>Menu Gestionnaire</title>
</head>
<body>
    <header>
        <nav> <!--Scrolling menu-->
            <ul>
                <li>
                    <a href="#" class="logo">
                        <img src="./img/logo.png" alt="">
                        <span class="nav-item">Gestionnaire</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/>
                            <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/>
                        </svg>
                        <span class="nav-item">Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle> <!--https://iconsvg.xyz/-->
                        </svg>
                        <span class="nav-item">Accès au menu Admin</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                        <span class="nav-item">Consultation</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                            <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/>
                        </svg>
                        <span class="nav-item">Gestion de projet</span>
                    </a>
                </li>
                <li>
                    <a href="deconnexion.php" class="deconnexion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M13.8 12H3"/>
                        </svg>
                        <span class="nav-item">Se déconnecter</span>
                    </a>
                </li>

            </ul>
        </nav>
    </header>

    <section id="zero"> 
        <article>
        <img id="illustration_gauche" src="./img/temp.PNG" alt="Les données récupérées avec nos capteurs.">    
        </article>
        <article id="left">
            <span>Réseaux et Télécommunications | IUT de Blagnac</span>
            <h2>Bonjour <?php echo $_SESSION["identifiant"]; ?> </h2> <!--Welcome banner-->
            <p>En tant que gestionnaire, vous avez accès à des fonctionnalités avancées pour surveiller et analyser les données en temps réel.</p>
            <button id="boutton_bascule">Basculer l'affichage d'un tableau en un graphique</button>
        </article>
        <article>
            <img id="illustration_droite" src="./img/support.PNG" alt="Support">    
        </article>
    </section>

    <section id="first"> <!--Dynamically generated data-->
        <article>
            <table id="first_tab">
                <?php
                    if(isset($premiere_salle) && $nom_bat == "batiment RT") {
                        echo "<caption>Relevés de la salle E001</caption>";
                        echo "<tr><th>Température</th><th>Date</th></tr>";
                        while($ligne = mysqli_fetch_assoc($premiere_salle)) {
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_premiere_salle['min'] . "</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_premiere_salle['max'] . "</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_premiere_salle['moyenne'] . "</td></tr>";
                    } else {
                        echo "<caption>Relevés de la salle B202</caption>";
                        echo "<tr><th>Température</th><th>Date</th></tr>";
                        while($ligne = mysqli_fetch_assoc($troisieme_salle)) {
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_troisieme_salle['min'] . "</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_troisieme_salle['max'] . "</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_troisieme_salle['moyenne'] . "</td></tr>";
                    }
                ?>
            </table>
        </article>
        <article class="info_tab">
            <?php
                echo "<h4>$message</h4>";
            ?>
        </article>
        <article>
            <table id="second_tab">
                <?php
                    if(isset($deuxieme_salle) && $nom_bat == "batiment RT") {
                        echo "<caption>Relevés de la salle E105</caption>";
                        echo "<tr><th>Température</th><th>Date</th></tr>";
                        while($ligne = mysqli_fetch_assoc($deuxieme_salle)) {
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_deuxieme_salle['min'] . "</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_deuxieme_salle['max'] . "</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_deuxieme_salle['moyenne'] . "</td></tr>";
                    } else {
                        echo "<caption>Relevés de la salle B203</caption>";
                        echo "<tr><th>Température</th><th>Date</th></tr>";
                        while($ligne = mysqli_fetch_assoc($quatrieme_salle)) {
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_quatrieme_salle['min'] . "</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_quatrieme_salle['max'] . "</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_quatrieme_salle['moyenne'] . "</td></tr>";
                    }
                ?>
            </table>
        </article>
    </section>
    <section id="second"> <!--Dynamic graph-->
        <article>
            <table id="first_tab">
                <caption>Relevés de la salle E101</caption>
                <tr><th>Température</th><th>Date</th></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
            </table>
        </article>
        <article>
            <table id="second_tab">
                <caption>Relevés de la salle E102</caption>
                <tr><th>Température</th><th>Date</th></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
                <tr><td>10</td><td>Exemple</td></tr>
            </table>
        </article>
    </section>
    <script src="./script_graph.js"></script>
</body>
</html>