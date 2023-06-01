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

function creationTrajet()
{

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

        if (!$departureCoordinates && !$destinationCoordinates) {
            echo "Veuillez entrer les villes de départ et d'arrivée.";
        } elseif (!$departureCoordinates) {
            echo "Impossible d'obtenir les coordonnées de départ.";
        } elseif (!$destinationCoordinates) {
            echo "Impossible d'obtenir les coordonnées d'arrivée.";
        }
    }
    ?>

    <script>

        // Leaflet has native support for raster maps, So you can create a map with a few commands only!
        window.departLongitude = <?php echo $departureCoordinates['longitude']; ?>;
        window.departLatitude = <?php echo $departureCoordinates['latitude']; ?>;

        window.arriveLatitude = <?php echo $destinationCoordinates['latitude']; ?>;
        window.arriveLongitude = <?php echo $destinationCoordinates['longitude']; ?>;

        window.moyenDeLocomation = "<?php echo $_POST["MoyenDeLocomotion"]; ?>";

        // The Leaflet map Object

        window.mapLatitude = (departLatitude + arriveLatitude) / 2;
        window.mapLongitude = (departLongitude + arriveLongitude) / 2;

        window.lieuDepart = "<?php echo $_POST["departure"]; ?>";
        window.lieuArrive = "<?php echo $_POST["destination"]; ?>";

        window.map = L.map('my-map').setView([mapLatitude, mapLongitude], 10);
    </script>
    <?php
}

?>

