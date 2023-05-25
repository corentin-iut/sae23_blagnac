<?php
    require("authentification.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style_login.css">
    <title>NavBar</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="#" class="logo">Suivez les variations de température grâce à nos capteurs</a>
            <div class="nav-links">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li class="actif"><a href="authentification.php">Connectez-vous</a></li>
                    <li><a href="#">Consultation</a></li>
                    <li><a href="#">Gestion de projet</a></li>
                    <li><a href="#">Mentions Légales</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section>
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
        </form>
    </section>
</body>
</html>