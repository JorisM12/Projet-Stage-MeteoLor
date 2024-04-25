<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/ObservationsManager.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";

$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$data = $observationManager->selectAllObservationsOneDay();
$observationTypes = $observationManager->selectAllObservationTypes();
$jsonData = json_encode($data);
$token = token();
$_SESSION['token'] = $token;
$userManager = new UserManager($db->getConnection());
$userData = $userManager->selectOneUser($_SESSION['user_id']);
$displayError = false;
$displayConfirm = false;
$displayForm = false;
$displayMap = false;
$descriptionForm = '';
$typeObsForm = '';
$locationForm = '';

if(isset($_GET['error']) && $_GET['error']== 1)
{
    $displayError = true;
    $descriptionForm = $_GET['description_observation'];
    $typeObsForm = $_GET['type_observation'];
    $locationForm = $_GET['location_observation'];
}
if(isset($_GET['send']) && $_GET['send']== 1)
{
    $displayConfirm = true;
}
if(isset($_GET['mobile-view']) && $_GET['mobile-view']== 'form')
{
   $displayForm = true;
}
elseif(isset($_GET['mobile-view']) &&  $_GET['mobile-view']== 'map')
{
    $displayMap = true;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/receptionUserMobile.css">
    <link rel="icon" type="image/x-icon" href="../../style/images/logo_mini.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <title>Accueil</title> 
</head>
<body>
    <header>
        <div class="container-logo">
            <a href="#"><img src="../../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <img src="../../style/images/logo_mini.png" alt="logo" id="logoMobile">
        <h2>Bienvenue <?=$userData['alias_user'];?> !</h2>
        <a id="btn-exit" href="../receptionUser.php"></a>
    </header>
    <main>
        <?php
            if($displayError == true)
            {
        ?>
        <script>
            window.alert("La saisie du formulaire est incorrecte");
        </script>
        <?php
            }
        ?>
        <?php
            if($displayConfirm == true)
            {
        ?>
        <script>
            window.alert("Observation envoyée!");
        </script>
        <?php
            }
        ?>
            <section id='sectionMapJS'>
                <div id="mapJS">

                </div>
                <a href="#" class="button-type-2">Nouvelles fonctionalités à venir</a>
            </section>
        </section>
        
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
        <a href="../user/deletePageUser.php">cliquer ici pour déactiver votre compte</a>
    </footer>  
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
            link = '../../style/images/weather-obs-icon/neige.png';
            break;
            case 2:
                link =  '../../style/images/weather-obs-icon/orage.png';
            break;
            case 3:
                link =  '../../style/images/weather-obs-icon/pluie.png';
            break;
            case 12:
                link =  '../../style/images/weather-obs-icon/soleil.png';
            case 11:
                link =  '../../style/images/weather-obs-icon/broullard.png';
            break;
            case 6:
                link =  '../../style/images/weather-obs-icon/couvert.png';
            break;
            case 7:
                link =  '../../style/images/weather-obs-icon/mitige.png';
            break;
            case 8:
                link =  '../../style/images/weather-obs-icon/vent.png';
            break;
            case 9:
                link =  '../../style/images/weather-obs-icon/averse.png';
            break;
            case 10:
                link =  '../../style/images/weather-obs-icon/averseneige.png';
            break;
            default:
            link = '../../style/images/weather-map-icon/JOURCLAIRFichier16.png';
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
        iconUrl: weatherMapIcon(idIcon) , 
        iconSize: [42, 42], 
        iconAnchor: [16, 32], 
        popupAnchor: [0, -32], 
    });
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
</html>