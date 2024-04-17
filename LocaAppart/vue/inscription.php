<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../inscription.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Inscription</h1>
        <form action="../controleur/inscription.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="telephone">Téléphone :</label>
            <input type="telephone" id="telephone" name="telephone" required><br><br>

            <label for="login">Login :</label>
            <input type="login" id="login" name="login" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="role">Je suis :</label>
            <select id="role" name="role" required>
                <option value="proprietaire">Propriétaire</option>
                <option value="locataire">Locataire</option>
            </select><br><br>

            <input type="submit" value="S'inscrire">
        </form>
    </div>
</body>
</html>
