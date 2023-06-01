
// The API Key provided is restricted to JSFiddle website
// Get your own API Key on https://myprojects.geoapify.com
const myAPIKey = "88521c329ee04b59ac7c99d53a1bbb8d";

// Retina displays require different mat tiles quality
const isRetina = L.Browser.retina;

const baseUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey={apiKey}";
const retinaUrl = "https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}@2x.png?apiKey={apiKey}";

// Add window.map tiles layer. Set 20 as the maximal zoom and provide window.map data attribution.
L.tileLayer(isRetina ? retinaUrl : baseUrl, {
    attribution: 'Powered by <a href="https://www.geoapify.com/" target="_blank">Geoapify</a> | <a href="https://openmaptiles.org/" rel="nofollow" target="_blank">© OpenMapTiles</a> <a href="https://www.openstreetmap.org/copyright" rel="nofollow" target="_blank">© OpenStreetMap</a> contributors',
    apiKey: myAPIKey,
    maxZoom: 20,
    id: 'osm-bright',
}).addTo(window.map);

// calculate and display routing:
// from 38.937165,-77.045590 (1920 Quincy Street Northwest, Washington, DC 20011, United States of America)
const fromWaypoint = [window.departLatitude, window.departLongitude]; // latutude, longitude
const fromWaypointMarker = L.marker(fromWaypoint).addTo(window.map).bindPopup();

// to 38.881152,-76.990693 (1125 G Street Southeast, Washington, DC 20003, United States of America)
const toWaypoint = [arriveLatitude, arriveLongitude]; // latitude, longitude
const toWaypointMarker = L.marker(toWaypoint).addTo(window.map).bindPopup();


const turnByTurnMarkerStyle = {
    radius: 5,
    fillColor: "#fff",
    color: "#555",
    weight: 1,
    opacity: 1,
    fillOpacity: 1
}


fetch(`https://api.geoapify.com/v1/routing?waypoints=${fromWaypoint.join(',')}|${toWaypoint.join(',')}&mode=${window.moyenDeLocomation}&apiKey=${myAPIKey}`).then(res => res.json()).then(result => {

    const distance = result.features[0].properties.distance;
    const distanceUnits = result.features[0].properties.distance_units;
    console.log(`Distance: ${distance} ${distanceUnits}`);

    const duration = Math.round((((result.features[0].properties.time)/60) * 100) / 100);
    console.log(`Durée: ${duration} minutes`);

    // Note! GeoJSON uses [longitude, latutude] format for coordinates
    L.geoJSON(result, {
        style: (feature) => {
            return {
                color: "rgba(20, 137, 255, 0.7)",
                weight: 5
            };
        }
    }).bindPopup((layer) => {
        return `${layer.feature.properties.distance} ${layer.feature.properties.distance_units}, ${layer.feature.properties.time}`
    }).addTo(window.map);

    // collect all transition positions
    const turnByTurns = [];
    result.features.forEach(feature => feature.properties.legs.forEach((leg, legIndex) => leg.steps.forEach(step => {
        const pointFeature = {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": feature.geometry.coordinates[legIndex][step.from_index]
            },
            "properties": {
                "instruction": step.instruction.text
            }
        }
        turnByTurns.push(pointFeature);
    })));

    L.geoJSON({
        type: "FeatureCollection",
        features: turnByTurns
    }, {
        pointToLayer: function(feature, latlng) {
            return L.circleMarker(latlng, turnByTurnMarkerStyle);
        }
    }).bindPopup((layer) => {
        return `${layer.feature.properties.instruction}`
    }).addTo(window.map)
        .on('routeselected', function (e) {
            this.distance = `${Math.round(control._routes[0].summary.totalDistance / 1000)} km`;
            this.temps = control._routes[0].summary.totalTime;
        }.bind(this));


}, error => console.log(err));
