<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Carte</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <div class="middle">
    <label class="radio-button">
        <input type="radio" id="walk" name="MoyenDeLocomotion" value="walk" checked>
        <label for="walk"><i class="fas fa-walking"></i></label>
    </label>
    <label class="radio-button">
        <input type="radio" id="drive" name="MoyenDeLocomotion" value="drive">
        <label for="drive"><i class="fas fa-car"></i></label>
    </label>
    <label class="radio-button">
        <input type="radio" id="bicycle" name="MoyenDeLocomotion" value="bicycle">
        <label for="bicycle"><i class="fas fa-bicycle"></i></label>
    </label>
    </div>
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
