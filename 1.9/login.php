<?php
    require("authentification.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_login.css">
    <link rel="stylesheet" href="./style/style_consult.css">
    <link rel="shortcut icon" href="./img/icons8-favicon-16.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <header>
        <nav class="navbar"> <!--Navigation bar-->
            <a href="#" class="logo">Suivez les variations de température grâce à nos capteurs</a>
            <div class="nav-links">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li class="actif"><a href="login.php">Connectez-vous</a></li>
                    <li><a href="#">Consultation</a></li>
                    <li><a href="#">Gestion de projet</a></li>
                    <li><a href="#">Mentions Légales</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section> <!--Login window in glass morphism-->
        <form class="container" name="identification" action="" method="post">
            <p class="accueil">Bienvenue</p>
            <input type="text" name="pseudo" placeholder="Pseudonyme" required><br>
            <input type="password" name="mdp" placeholder="Mot de passe" required><br>
            <label for="droit">Connectez-vous en tant que :</label>
            <select name="droit">
                <option value="gestionnaire">Gestionnaire</option>
                <option value="admin">Administrateur</option>
            </select><br>
            <input type="submit" name="connexion" value="Connexion"><br>
            <?php
                if(!empty($error)){
                    echo "<p class='erreur'>$error</p>";
                }
            ?>
        </form> <!--If the identification is incorrect, an error message appears-->
    </section>
    <div id="tempBanner" class="banner"> <!--Dynamic Banner-->
        <h2>Consultation des dernières températures</h2>
        <?php
            foreach($liste as $capteur) {
                if($ligne = mysqli_fetch_assoc($capteur)) {
                    echo "<p>Capteur : " . $ligne['nom'] . " Valeur : " . $ligne['valeur'] . " Date : " . $ligne['date'] . "</p>";      
                }
            }
        ?>
    </div>
    <script src="script_accueil.js"></script>
</body>
</html>