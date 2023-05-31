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
<form method="post">
    <label for="departure">Départ :</label>
    <input type="text" name="departure" id="departure" placeholder="Entrer l'endroit de départ">
    <label for="destination">Arrivée :</label>
    <input type="text" name="destination" id="destination" placeholder="Entrer l'endroit d'arrivée">
    <button type="submit">Obtenir Trajet</button>
</form>
<!-- Afficher les étapes du trajet ici -->
<div id="etapes">
    <?php

    class Map
    {
        private $apiAccessKey;

        public function __construct($apiAccessKey)
        {
            $this->apiAccessKey = $apiAccessKey;
        }

        public function getCoordinates($location)
        {
            $url = "https://us1.locationiq.com/v1/search.php?key=" . $this->apiAccessKey . "&q=" . urlencode($location) . "&format=json";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                $latitude = $data[0]['lat'];
                $longitude = $data[0]['lon'];
                return array('latitude' => $latitude, 'longitude' => $longitude);
            }

            return false;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];

        // Créer une instance de la classe Map
        $map = new Map("pk.c303d9b4fee3acd0212e3133e6dde4a5");

        $departureCoordinates = null;
        $destinationCoordinates = null;

        if (!empty($departure)) {
            $departureCoordinates = $map->getCoordinates($departure);
        }

        if (!empty($destination)) {
            $destinationCoordinates = $map->getCoordinates($destination);
        }

        if ($departureCoordinates && $destinationCoordinates) {
            echo "Coordonnées de départ : latitude = " . $departureCoordinates['latitude'] . ", longitude = " . $departureCoordinates['longitude'] . "<br>";
            echo "Coordonnées d'arrivée : latitude = " . $destinationCoordinates['latitude'] . ", longitude = " . $destinationCoordinates['longitude'];
        } elseif (!$departureCoordinates && !$destinationCoordinates) {
            echo "Veuillez entrer les villes de départ et d'arrivée.";
        } elseif (!$departureCoordinates) {
            echo "Impossible d'obtenir les coordonnées de départ.";
        } else {
            echo "Impossible d'obtenir les coordonnées d'arrivée.";
        }
    }
    ?>
</div>
<!-- Autres éléments et fonctionnalités de la vue -->
</body>
</html>
