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
                        <span class="nav-item">Portail Administrateur</span>
                    </a>
                </li>
                <li>
                    <a href="gestion.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                        <span class="nav-item">Gestion de projet</span>
                    </a>
                </li>
                <li>
                    <a href="mentions.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                            <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/>
                        </svg>
                        <span class="nav-item">Les mentions légales</span>
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
            <?php
               // echo "Valeur de \$etat : " . $etat;
                if($etat == 1) { echo '<button id="boutton_bascule">Basculer affichage du tableau en un graphique</button>';
                }
            ?>
        </article>
        <article>
            <img id="illustration_droite" src="./img/support.PNG" alt="Support">    
        </article>
    </section>

    <section id="first"> <!--Dynamically generated data-->
        <article id="gauche">
            <table id="first_tab">
                <?php
                if($etat == 1) {
                    if(isset($premiere_salle) && $nom_bat == "batiment RT") {
                        echo "<caption>Relevés de la salle E001</caption>";
                        echo "<tr><th>Température</th><th>Date</th><th>Horaire</th></tr>";
                        foreach($premiere_salle as $ligne){
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_premiere_salle['min'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_premiere_salle['max'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_premiere_salle['moyenne'] . "</td><td>Échantillon actuel</td></tr>";
                    } else {
                        echo "<caption>Relevés de la salle B202</caption>";
                        echo "<tr><th>Température</th><th>Date</th><th>Horaire</th></tr>";
                        foreach($troisieme_salle as $ligne){
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_troisieme_salle['min'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_troisieme_salle['max'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_troisieme_salle['moyenne'] . "</td><td>Échantillon actuel</td></tr>";
                    }}
                ?>
            </table>
        </article>
        <article class="info_tab">
            <?php
                if($etat == 1) {
                    echo "<h4>$message</h4>";
                } else { echo "<h4> Ce bâtiment n'est pas disponible </h4>";
                }
            ?>
        </article>
        <article>
            <table id="second_tab">
                <?php
                if($etat == 1) {
                    if(isset($deuxieme_salle) && $nom_bat == "batiment RT") {
                        echo "<caption>Relevés de la salle E105</caption>";
                        echo "<tr><th>Température</th><th>Date</th><th>Horaire</th></tr>";
                        foreach($deuxieme_salle as $ligne){
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_deuxieme_salle['min'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_deuxieme_salle['max'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_deuxieme_salle['moyenne'] . "</td><td>Échantillon actuel</td></tr>";
                    } else {
                        echo "<caption>Relevés de la salle B203</caption>";
                        echo "<tr><th>Température</th><th>Date</th><th>Horaire</th></tr>";
                        foreach($quatrieme_salle as $ligne){
                            echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['date'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                        }
                        echo "<tr><td> Minimum </td><td>" . $stats_quatrieme_salle['min'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Maximum </td><td>" . $stats_quatrieme_salle['max'] . "</td><td>Échantillon actuel</td></tr>";
                        echo "<tr><td> Moyenne </td><td>" . $stats_quatrieme_salle['moyenne'] . "</td><td>Échantillon actuel</td></tr>";
                    }}
                ?>
            </table>
        </article>
    </section>
    <section id="second"> <!--Dynamic graph-->
        <article>
            <canvas id="chart1"></canvas>
            <canvas id="chart2"></canvas>
        </article>
    </section>
    <?php
        if($etat == 1) { echo '
            <section id="form">
               <form class="container" name="filtre_date" action="" method="post">
                    <p class="saisir_date">Saisissez une date</p>
                    <input type="text" name="date" placeholder="Date de la forme DD/MM/YYYY" required><br>
                    <input type="submit" name="connexion" value="Validez"><br>
                </form>
            </section>';}
    ?>
    <section id="first"> <!--Precise date-->
        <article id="gauche">
            <table id="first_tab">
                <?php
                    if(isset($date)){
                        if(isset($date_premiere_salle) && $nom_bat == "batiment RT") {
                            echo "<caption>Relevés de la salle E001</caption>";
                            echo "<tr><th>Température</th><th>Horaire</th></tr>";
                            foreach($date_premiere_salle as $ligne){
                                echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                            }
                        } elseif(isset($date_troisieme_salle) && $nom_bat == "batiment info") {
                            echo "<caption>Relevés de la salle B202</caption>";
                            echo "<tr><th>Température</th><th>Horaire</th></tr>";
                            foreach($date_troisieme_salle as $ligne){
                                echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                            }
                        }
                    }
                ?>
            </table>
        </article>
        <article class="info_tab">
            <?php
                if(isset($date)){
                    echo "<h4>$message2</h4>";
                }
            ?>
        </article>
        <article>
            <table id="second_tab">
                <?php
                    if(isset($date)){
                        if(isset($date_deuxieme_salle) && $nom_bat == "batiment RT") {
                            echo "<caption>Relevés de la salle E105</caption>";
                            echo "<tr><th>Température</th><th>Horaire</th></tr>";
                            foreach($date_deuxieme_salle as $ligne){
                                echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                            }
                        } elseif(isset($date_quatrieme_salle) && $nom_bat == "batiment info") {
                            echo "<caption>Relevés de la salle B203</caption>";
                            echo "<tr><th>Température</th><th>Horaire</th></tr>";
                            foreach($date_quatrieme_salle as $ligne){
                                echo "<tr><td>" . $ligne['valeur'] . "</td><td>" . $ligne['horaire'] . "</td></tr>";
                            }
                        }
                    }
                ?>
            </table>
        </article>
    </section>
    <script src="./script_graph.js"></script>
    <script>
        var ctx1 = document.getElementById('chart1').getContext('2d');

        var dates_premiere_salle = <?php echo json_encode($dates_premiere_salle); ?>;
        var valeurs_premiere_salle = <?php echo json_encode($valeurs_premiere_salle); ?>;

        var dates_deuxieme_salle = <?php echo json_encode($dates_deuxieme_salle); ?>;
        var valeurs_deuxieme_salle = <?php echo json_encode($valeurs_deuxieme_salle); ?>;

        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: dates_premiere_salle.concat(dates_deuxieme_salle),
                datasets: [{
                    label: 'Première Salle',
                    data: valeurs_premiere_salle,
                    borderColor: 'rgba(255, 99, 132, 1)'
                },
                {
                    label: 'Deuxième Salle',
                    data: valeurs_deuxieme_salle,
                    borderColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: chartOptions
        });
    </script>
    <script>
        var ctx2 = document.getElementById('chart2').getContext('2d');

        var dates_troisieme_salle = <?php echo json_encode($dates_troisieme_salle); ?>;
        var valeurs_troisieme_salle = <?php echo json_encode($valeurs_troisieme_salle); ?>;

        var dates_quatrieme_salle = <?php echo json_encode($dates_quatrieme_salle); ?>;
        var valeurs_quatrieme_salle = <?php echo json_encode($valeurs_quatrieme_salle); ?>;

        var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: dates_troisieme_salle.concat(dates_quatrieme_salle),
                datasets: [{
                    label: 'Troisième Salle',
                    data: valeurs_troisieme_salle,
                    borderColor: 'rgba(153, 102, 255, 1)'
                },
                {
                    label: 'Quatrième Salle',
                    data: valeurs_quatrieme_salle,
                    borderColor: 'rgba(255, 159, 64, 1)'
                }]
            },
            options: chartOptions
        });
    </script>
    <script>
        var chartOptions = {
            responsive: true, // Rend le graphique responsive
            title: {
                display: true, // Affiche le titre du graphique
                text: 'Capteur Mesures par Salle' // Texte du titre
            },
            scales: {
                xAxes: [{
                    type: 'time', // Type de l'axe X (temps)
                    time: {
                        unit: 'day' // Unité de temps (jour)
                    },
                    scaleLabel: {
                        display: true, // Affiche le label de l'axe X
                        labelString: 'Date' // Texte du label de l'axe X
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true, // Affiche le label de l'axe Y
                        labelString: 'Valeur' // Texte du label de l'axe Y
                    }
                }]
            }
        };
    </script>


</body>
</html>