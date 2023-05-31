<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Carte</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/maps.js"></script>
</head>
<body class="animated-background">
<div id="bubble-container"></div>
<h1>Carte</h1>
<div id="map"></div>
<form method="post" action="../Model/mapsModel.php">
    <label for="departure">Départ :</label>
    <input type="text" name="departure" id="departure" placeholder="Entrer l'endroit de départ">
    <label for="destination">Arrivée :</label>
    <input type="text" name="destination" id="destination" placeholder="Entrer l'endroit d'arrivée">
    <button type="submit">Obtenir Trajet</button>
</form>
<div id="etapes">
    <?php
    if (!file_exists("../Model/mapsModel.php")) {
        echo "Erreur : Fichier de modèle manquant.";
    }
    ?>
</div>
<script src="js/maps.js"></script>

</body>
</html>
