<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/ObservationsManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$data = $observationManager->selectAllObservations();
$jsonData = json_encode($data);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/observationMap.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <title>Carte des observations</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo_mini.png" alt="logo"></a>
            <div id="burger-menu">     
            </div>
            <div class="bloc-burger-menu">
                <nav>
                    <img src="../style/images/x.png" alt="fermer le menu" id="btn-close-menu">
                    <ul>
                        <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                        <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                        <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                        <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                         <li><img src=<?=$memberStatus['pictogramme'];?> alt="statut adhérent" title=<?=$memberStatus['member title'];?> class="picto"></li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> <img id="btn-logout" src="../style/images/login.png" alt=""></a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><img src="../style/images/g.png" alt="statut adhérent" title="Adhérent"></li>
            </ul>
            <div id="log-out">
                <a href="../other/Functions/logout.php" title="Se déconnecter"> <img src="../style/images/login.png" alt=""></a>
            </div>
        </nav>
        <h2 class="title-type-1">Carte des observations</h2>
    </header>
    <aside>
        <img src="../style/images/triangles.svg" alt="">
        <div>
            <p id="city-name">
                VILLE A
            </p>
            <p>
                Journée agréable
            </p>
            <hr>
            <p id="user-name">
                Jean57 le 27/06/2023 à 11h10
            </p>
        </div>
    </aside>
    <main>
        <section>
            <div id="mapJS">

            </div>
            
        </section>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script src="../script/script-burger-menu.js"></script>
<script>
    const data = <?=$jsonData;?>
</script>
<script>
    function weatherMapIcon(id) {
        id = parseInt(id);
        let link = '';
        switch (id) {
            case 1:
            link = '../style/images/weather-map-icon/JOURCLAIRFichier16.png';
            break;
            case 2:
                link = '../style/images/weather-map-icon/NEIGE FAIBLEFichier6.png';
            break;
            case 3:
            link = '../style/images/weather-map-icon/LEGERBROUILLARDFichier5.png';
            break;
            case 4:
            link = '../style/images/weather-map-icon/aversesFichier23.png';
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
    let markerLocation = new L.LatLng(marker.lat_observation, marker.lon_observation);
    let idIcon = marker.id_type_observation;
    let customIcon = L.icon({
        iconUrl: weatherMapIcon(idIcon) , 
        iconSize: [32, 32], 
        iconAnchor: [16, 32], 
        popupAnchor: [0, -32], 
    });
    let newMarker = L.marker(markerLocation, { icon: customIcon }).addTo(map)
        .bindPopup("<h2>"+marker.name_observation_type+"</h2> <br> <p>"+marker.description_observation+"</p> <br> <p>par: <span class='user'>"+marker.alias_user+"</span></p>");
});
</script>
</html>

