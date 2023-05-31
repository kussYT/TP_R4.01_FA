<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Carte</title>
    <!-- Inclure les feuilles de style et les scripts nécessaires -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/maps.js"></script>
</head>
<body>
<h1>Carte</h1>
<!-- Afficher la carte ici -->
<div id="map"></div>
<!-- Formulaire pour entrer l'endroit de départ et d'arrivée -->
<form method="post" action="../Model/mapsModel.php">
    <label for="departure">Départ :</label>
    <input type="text" name="departure" id="departure" placeholder="Entrer l'endroit de départ">
    <label for="destination">Arrivée :</label>
    <input type="text" name="destination" id="destination" placeholder="Entrer l'endroit d'arrivée">
    <button type="submit">Obtenir Trajet</button>
</form>
<!-- Afficher les étapes du trajet ici -->
<div id="etapes">
    <?php
    // Vérification de l'existence du fichier mapsModel.php
    if (!file_exists("../Model/mapsModel.php")) {
        echo "Erreur : Fichier de modèle manquant.";
    }
    ?>
</div>
<!-- Autres éléments et fonctionnalités de la vue -->
</body>
</html>
