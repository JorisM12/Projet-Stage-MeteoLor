<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/ObservationsManager.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$data = $observationManager->selectAllObservationsOneDay();
$observationTypes = $observationManager->selectAllObservationTypes();
$jsonData = json_encode($data);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/weatherObsWp.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <title>Accueil</title> 
</head>
<body>
    <main>
        <section id="desktop-view-choice">
            <section id='sectionMapJS'>
                <div id="mapJS">
                </div>
                <div id="hours-circles">
                    <div class="circle-legend"></div>
                    <p>
                        0 - 3h
                    </p>
                    <div class="circle-legend"></div>
                    <p>
                        3h - 6h
                    </p>
                    <div class="circle-legend"></div>
                    <p>
                        6h - 9h
                    </p>
                </div>
            </section>
        </section>
    </main> 
</body>
<script>
    const data = <?=$jsonData;?>
</script>
<script>
    function weatherMapIcon(id) {
        id = parseInt(id);
        let link = '';
        switch (id) {
            case 1:
            link = '../style/images/weather-obs-icon/neige.png';
            break;
            case 2:
                link =  '../style/images/weather-obs-icon/orage.png';
            break;
            case 3:
                link =  '../style/images/weather-obs-icon/pluie.png';
            break;
            case 4:
                link =  '../style/images/weather-obs-icon/soleil.png';
            case 5:
                link =  '../style/images/weather-obs-icon/broullard.png';
            break;
            case 6:
                link =  '../style/images/weather-obs-icon/couvert.png';
            break;
            case 7:
                link =  '../style/images/weather-obs-icon/mitige.png';
            break;
            case 8:
                link =  '../style/images/weather-obs-icon/vent.png';
            break;
            case 9:
                link =  '../style/images/weather-obs-icon/averse.png';
            break;
            case 10:
                link =  '../style/images/weather-obs-icon/averseneige.png';
            break;
            default:
            link = '../style/images/weather-map-icon/JOURCLAIRFichier16.png';
            break;
        }
        return link;
    }
    let map = L.map('mapJS').setView([49.133, 6.166], 8);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    data.forEach(function(marker) {
    let link_img = marker.link_picture_observation;
    if (!link_img) {
        link_img = ''
    }
    let markerLocation = new L.LatLng(marker.lat_observation, marker.lon_observation);
    let idIcon = marker.id_type_observation;
    let customIcon = L.icon({
        iconUrl: weatherMapIcon(idIcon) , // URL de l'icône personnalisée
        iconSize: [42, 42], // Taille de l'icône
        iconAnchor: [16, 32], // Point d'ancrage de l'icône
        popupAnchor: [0, -32], // Point d'ancrage du popup
    });
    // Ajout du marqueur personalisé
    let hourObsColor = "circle-hour green";
    const date = new Date();
    const hourLive = date.getHours();
    let hourObs = marker.hour;
    let hourObsTrue = parseInt(hourObs.substring(0, 2));
    if(hourObsTrue >= hourLive -3) {
        hourObsColor = "green";
    }
    else if(hourObsTrue >= hourLive-6){
        hourObsColor = "orange";
    }
    else{
        hourObsColor = "red";
    }
    let newMarker = L.marker(markerLocation, { icon: customIcon }).addTo(map)
        .bindPopup("<div class='head-obs'><div class='circle-hour "+hourObsColor+"'></div><h2 class='title-card'>"+marker.name_observation_type+"</h2></div> <br> <p class='obs-card'>Lieu: "+marker.location_observation+"</p><br> <p>Heure: "+marker.hour+"</p> <br> <p>Info: "+marker.description_observation+"</p><br> <img class='img-card' src="+link_img+"> <br> <p>par: <span class='user'>"+marker.alias_user+"</span></p>");
});
</script>
<script src="../script/script-receptionUserPage.js"></script>
</html>