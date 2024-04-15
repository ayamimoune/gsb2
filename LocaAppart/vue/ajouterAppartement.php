<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ajouterAppartement.css">
    <title>Ajouter un appartement</title>
</head>
<body>
    <!-- Header avec les liens Retour et Mon Profil -->
    <header>
        <h1>Ajouter un appartement</h1>
        <nav>
            <a href="../vue/tableau_de_bord_proprietaire.php">Retour</a>
            <a href="./profilProprietaire.php">Mon Profil</a>
        </nav>
    </header>

    <!-- Formulaire d'ajout d'appartement -->
    <form action="../controleur/ajouterAppart.php" method="POST">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>
        
        <label for="cp">Code Postal :</label>
        <input type="text" id="cp" name="cp" required>
        
        <label for="type_appart">Type d'appartement :</label>
        <select id="type_appart" name="type_appart" required>
            <option value="">Sélectionner un type</option>
            <option value="T1">T1</option>
            <option value="T2">T2</option>
            <option value="T3">T3</option>
        </select>
        
        <label for="num_bat">N° batiment :</label>
        <input type="number" id="num_bat" name="num_bat" min="-1" required>
        
        <label for="num_appart">N° appartement :</label>
        <input type="text" id="num_appart" name="num_appart" required>

        <label for="loyer">Loyer :</label>
        <div class="input-with-icon">
            <span class="euro-icon">€</span>
            <input type="number" id="loyer" name="loyer" min="0" required>
        </div>
    
        <label for="date_libre">Date de Disponibilité :</label>
        <input type="date" id="date_libre" name="date_libre" required>
        
        <input type="submit" value="Ajouter Location">
    </form>
</body>
</html>
