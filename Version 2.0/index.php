<?php
    require("accueil_bat.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Accueil - SAÉ23">
    <link rel="stylesheet" href="./style/style_accueil.css">
    <link rel="stylesheet" href="./style/style_consult.css">
    <link rel="shortcut icon" href="./img/icons8-favicon-16.png" type="image/x-icon">
    <title>Accueil</title>
</head>

<body>
    <header>
        <nav class="navbar"> <!--Navigation bar-->
            <a href="#" class="logo">Suivez les variations de température grâce à nos capteurs</a>
            <div class="nav-links">
                <ul>
                    <li class="actif"><a href="index.php">Accueil</a></li>
                    <li><a href="login.php">Connectez-vous</a></li>
                    <li><a href="#">Consultation</a></li>
                    <li><a href="#">Gestion de projet</a></li>
                    <li><a href="#">Mentions Légales</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <section id="intro"> <!--Introduction-->
        <p>
            Bienvenue sur le site de la SAÉ23 ! Ce projet vise à utiliser les données issues de capteurs installés dans
            les bâtiments de l'IUT de Blagnac pour une gestion efficace et optimisée de ces espaces. Grâce à notre site
            web dynamique, nous vous proposons une interface conviviale et intuitive permettant aux gestionnaires et aux
            administrateurs d'accéder facilement à ces données et de prendre des décisions éclairées basées sur des
            informations réelles et actualisées constamment.
        </p>
    </section>
    <section id="zero">
        <div class="grid"> <!--Implementation of HTML grid for the aesthetics of the page-->
            <div class="bloc">
                <h3>Objectif du projet</h3>
                <ul>
                    <li>&#8250; Mise en place d'une interface de visualisation de données</li>
                    <li>&#8250; Conception d'un site web dynamique hébergé sur un serveur lampp.</li>
                    <li>&#8250; Création et gestion de la base de données MySQL</li>
                    <li>&#8250; Administration de compte avec différents profils</li>
                </ul>
            </div>
            <div class="bloc">
                <h3>Fonctionnalités du Projet</h3>
                <ul>
                    <li>&#8250; Chaque bâtiment est doté de deux capteurs, géré par un gestionnaire via un compte
                        sécurisé</li>
                    <li>&#8250; Présentation claire et détaillée des données issues des capteurs</li>
                    <li>&#8250; Gestion sécurisée et efficiente des données à travers MySQL</li>
                </ul>
            </div>
            <div class="bloc">
                <h3>Contraintes techniques</h3>
                <ul>
                    <li>&#8250; Environnement : machine virtuelle Lubuntu</li>
                    <li>&#8250; Langages autorisés : HTML5, CSS3, PHP, JavaScript, Bash, C et Python</li>
                    <li>&#8250; Code documentés en anglais</li>
                    <li>&#8250; Gestion de version via Git et Github</li>
                </ul>
            </div> <!--Building Condition Status-->
            <?php foreach($resultat as $batiment){ ?>
            <div class="bloc-reduit">
                <span>
                    <?php echo $batiment["nom"]; ?>
                <span>
            </div>
            <?php } ?>
        </div>
    </section>
    <div id="tempBanner" class="banner"> <!--Dynamic Banner-->
        <h2>Consultation des dernières températures</h2>
        <?php
            foreach($liste as $capteur) {
                if($ligne = mysqli_fetch_assoc($capteur)) {
                    echo "<p>Capteur : " . $ligne['nom'] . " Valeur : " . $ligne['valeur'] . "° Date : " . $ligne['date'] . "</p>";      
                }
            }
        ?>
    </div>
    <script src="script_accueil.js"></script>
</body>

</html>