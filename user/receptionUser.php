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
    if(isset($_GET['description_observation']) && isset($_GET['type_observation']) && isset($_GET['location_observation']))
    {
        $descriptionForm = $_GET['description_observation'];
        $typeObsForm = $_GET['type_observation'];
        $locationForm = $_GET['location_observation'];
    }
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

if($userData['member_user'] != NULL)
{
    $imgObs = "";
}
else
{
    $imgObs = "img-obs-hidden";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/receptionUser.css">
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
    <header>
        <div class="container-logo">
            <a href="#"><img src="../style/images/logo.png" alt="logo Météolor"></a>
        </div>
        <img src="../style/images/logo_mini.png" alt="logo" id="logoMobile">
        <h2>Bienvenue <?=$userData['alias_user'];?> !</h2>
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
        <div id="log-out">
            <a href="../other/Functions/logout.php" title="Se déconnecter">Se déconnecter</a>
        </div>
        <section id="mobile-view-choice" class="">
            <p>
                Choissez une action à effectuer:
            </p>

            <a href="./receptionUser-mobile-view/formObsMobileView.php" class="button-type-1">PUBLIER UNE OBSERVATION</a>
            <a href="./receptionUser-mobile-view/observationMapMobileView.php" class="button-type-1">VOIR LA CARTE D'OBSERVATIONS</a>
            <div>
                <p>
                    Adherer à l'association pour avoir accès à l'ensemble des fonctionalités de l'interface
                </p>
                <a href="#" class="button-type-2">Prochainement disponible</a>
            </div>
        </section>
        <section id="desktop-view-choice">
            <section class="container-type-1">
                <h3>Poster une observation</h3>
                <form action="../other/Treatment/observationTreatment.php" method="post" enctype="multipart/form-data">
                    <div id="liste-mobile-view">
                        <select class="input-type-1" name="type_observation" id="type_observation">
                        <option value="" selected>Choisir un phénomène</option>
                            <?php
                                foreach ($observationTypes as $type ) {   
                            ?>
                            <option value=<?= $type['id_type_observation'];?> <?=$typeObsForm != '' ? 'selected':'';?>><?=$type['name_observation_type'];?></option>
                            <?php
                                }
                            ?>
                        </select>                               
                    </div>
                    <div>
                        <label for="description_observation">Description:</label>
                        <input class="input-type-1" type="text" name="description_observation" value=<?=$descriptionForm;?>>
                        <label for="location_observation">Localisation: (ville et code postal)</label>
                        <input class="input-type-1"  id='cityName' type="text" name="location_observation" value=<?=$locationForm;?>>
                        <div id="suggestions"></div>
                        <label for="image_observation" class=<?=$imgObs;?>>Joindre une image:</label>
                        <input class="input-type-1 <?=$imgObs;?>" type="file" name="image_observation">
                    </div>
                    <input type="hidden" name="token" value=<?=$token;?>>
                    <input type="hidden" name="id_user" value=<?=$_SESSION['user_id'];?>>
                    <button class="button-type-1" type="submit">ENVOYER</button>
                </form>
                <a href="../other/Treatment/deleteLastObservation.php" id="delete-obs" class="button-type-2">Supprimer ma dernière observation</a>
                <div id="close-form-mobile">

                </div>
            </section>
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
<script src="../script/script-receptionUserPage.js"></script>
<script src="../script/script-city-suggestion.js"></script>
</html>
