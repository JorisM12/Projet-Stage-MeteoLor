<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/WeatherAlertManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
$database = new Connect();
$db = $database->getConnection();
$alertManager = new WeatherAlertManager($db);
if($alertManager->weatherAlertVerify())
{
    $infoAlert = $alertManager->selectOneAlert($alertManager->weatherAlertVerify()['id_weather_alert']);
    if($infoAlert['archive_weather_alert'] === 0)
    {
        $notifActive = 1;
        $typeOfAlert = $alertManager->selectOneTypeAlert($infoAlert['id_weather_alert_type']);
        $titleAlert = $typeOfAlert['name_weather_alert_type'];
        $descriptionAlert = <<<EOD
        <ul>
            <li>Date et heure de début : {$infoAlert['start_date']}</li>
            <li>Date et heure de fin : {$infoAlert['end_date']}</li>
        </ul>   
        
        <p>
            <span>Informations: </span>  <br>
            {$infoAlert['description_weather_alert']}
        </p>
        EOD;
        $linkToTypeAlertLogo = "../style/images/weather-alert-icon/{$infoAlert['name_weather_alert_type']}{$infoAlert['level_weather_alert']}.svg";
    }
    else
    {
        $notifActive = 0;
        $titleAlert = "--";
        $descriptionAlert = <<<EOD
        Aucune alerte en cours
        EOD;
        $linkToTypeAlertLogo = "../style/images/info.png";
    }
}
else
{
    $titleAlert = "--";
    $descriptionAlert = <<<EOD
        Aucune alerte en cours
    EOD;
    $linkToTypeAlertLogo = "../style/images/info.png";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/wheatherMapWp.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Prévisions</title>  
</head>
<body>
    <main>
        <aside class="none">
            <div>
            </div>
            <div>
                <img src="<?=$linkToTypeAlertLogo;?>" alt="logo type alerte">
                <p>
                    <span><?=$titleAlert;?></span>
                </p>
                <div>
                   
                    
                    <?=$descriptionAlert;?>
                </div> 
            </div>
        </aside>
        <section>
            <div id="dates-orders-mobile">
                <div class="bloc-control-day">
                    <div></div>
                    <div></div>
                </div>
                <h3>MARDI 27 JUIN</h3>
                <div class="button-period-mobile"></div>
            </div>
            <div id="content-map">
                <div id="map">
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none"src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                    <div>
                        <img class="weather-icon" src="../style/images/tempss.png" alt="mitigé"> <img class="temperature-icon none" src="../style/images/temperature.png" alt="temperature"> <img class="wind-icon none" src="../style/images/vent.png" alt="vent"><p class="none"><span>17</span></p><p class="wind-value none"></p> 
                    </div>
                </div>
            </div>
            <div id="orders">
                <div id="dates-orders">
                    <h3>MARDI 27 JUIN</h3>
                    <ul>
                        <li>Matin</li>
                        <li class="selected-period">Après-midi</li>
                        <li>Soir</li>
                        <li>Nuit</li>
                    </ul>
                    <div class="bloc-control-day">
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div id="city-orders">
                    <div id="btn-weather">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <form action="./weatherCity.php" method="get" target="_blank">
                        <label for="name_city"> <span>NOUVEAU!</span> La météo dans votre ville !</label>
                        <input type="text" placeholder="Nom de ville et le code postal" name="name_city" id="cityName">
                        <div id="suggestions">
                        </div>
                        <input type="submit" value='' id='btn-search-city'>
                    </form>
                </div>
                <img src="../style/images/logo_bis.png" alt="logo Météolor'">
            </div>
                <div id="weather-notification" class="weather-notification-alert <?= $notifActive === 1 ? 'active' : '' ;?>">
            </div>
        </section>
    </main>  
</body>
<script>
        const btnPeriodMorning = document.querySelector('main section #orders  ul li:nth-child(1)');
        const btnPeriodAfternoon = document.querySelector('main section #orders  ul li:nth-child(2)');
        const btnPeriodEvening = document.querySelector('main section #orders  ul li:nth-child(3)');
        const btnPeriodNight = document.querySelector('main section #orders  ul li:nth-child(4)');
        const btnWeatherView = document.querySelector('main section #city-orders #btn-weather div:nth-child(1)');
        const btnTemperatureView = document.querySelector('main section #city-orders #btn-weather div:nth-child(2)');
        const btnWindView = document.querySelector('main section #city-orders #btn-weather div:nth-child(3)');
        const btnNextDay = document.querySelectorAll('.bloc-control-day div:last-child');
        const btnPreviousDay = document.querySelectorAll('.bloc-control-day div:first-child');
        const btnNotifMap = document.querySelector('#weather-notification');
        const btnCloseNotifMap = document.querySelector('aside div:nth-child(1)');
        const dateWeatherMap = document.querySelector('#dates-orders h3');
        const dateWeatherMapMobile = document.querySelector('#dates-orders-mobile h3');
        const btnPeriodMobile = document.querySelector('.button-period-mobile');

        const cityWeatherPlaceElem = document.querySelectorAll('main section #map div');
        const cityWeatherElem = document.querySelectorAll('main section #map div img.weather-icon');
        const cityTemperatureElem = document.querySelectorAll('main section #map div img.temperature-icon');
        const cityTemperatureTextElem = document.querySelectorAll('main section #map div p');
        const cityWindTextElem = document.querySelectorAll('body main section #map div p.wind-value');

        let listElement = [];
        let listTempElement = [];
        let listWindElement = [];
        let listWindValueElement = [];
        let listWindDirElement = [];
        const NordMeuseElem = document.querySelector('main section #map div:nth-child(1) img');
        const EtainElem = document.querySelector('main section #map div:nth-child(2) img');
        const SudVerdunElem = document.querySelector('main section #map div:nth-child(3) img');
        const SudMeuseElem = document.querySelector('main section #map div:nth-child(4) img');
        const NancyElem = document.querySelector('main section #map div:nth-child(5) img');
        const SudNeufchateauElem = document.querySelector('main section #map div:nth-child(6) img');
        const NordEpinalElem = document.querySelector('main section #map div:nth-child(7) img');
        const SudEpinalElem = document.querySelector('main section #map div:nth-child(8) img');
        const StDieElem = document.querySelector('main section #map div:nth-child(9) img');
        const EstLunevilleElem = document.querySelector('main section #map div:nth-child(10) img');
        const NordSarrebourgElem = document.querySelector('main section #map div:nth-child(11) img');
        const DieuzeElem = document.querySelector('main section #map div:nth-child(12) img');
        const MetzElem = document.querySelector('main section #map div:nth-child(13) img');
        const ThionvilleElem = document.querySelector('main section #map div:nth-child(14) img');
        const SarreguemineElem = document.querySelector('main section #map div:nth-child(15) img');
        const JarnyElem = document.querySelector('main section #map div:nth-child(16) img');
        const BitcheElem = document.querySelector('main section #map div:nth-child(17) img');
        const BussangElem = document.querySelector('main section #map div:nth-child(18) img');
        for (let index = 1; index < 19; index++) {
            listTempElement.push(document.querySelector(`main section #map div:nth-child(${index}) p span`));
        }
        for (let index = 1; index < 19; index++) {
            listWindElement.push(document.querySelector(`main section #map div:nth-child(${index}) .wind-icon`));
        }
        for (let index = 1; index < 19; index++) {
            listWindValueElement.push(document.querySelector(`main section #map div:nth-child(${index}) p.wind-value`));
        }
        for (let index = 1; index < 19; index++) {
            listWindDirElement.push(document.querySelector(`main section #map div:nth-child(${index}) img.wind-icon`));
        }

        listElement.push(NordMeuseElem,EtainElem,SudVerdunElem,SudMeuseElem,NancyElem,SudNeufchateauElem,NordEpinalElem,SudEpinalElem,StDieElem,EstLunevilleElem,NordSarrebourgElem,DieuzeElem,MetzElem,ThionvilleElem,SarreguemineElem,JarnyElem,BitcheElem,BussangElem);



    function weatherIcon(idIcon) {
        let result = 100;
        switch (idIcon) {
            case 0:
                result = 'JOURCLAIRFichier16';
                break;
            case 01:
            result = 'PEUNUAGEUXFichier4';
            break;
            case 02:
            result = 'PEUNUAGEUXFichier4';
            break;
            case 03:
            result = 'NUAGEUXFichier3';
            break;
            case 05:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 06:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 07:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 10:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 10:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 17:
            result = 'PEUORAGEUXFichier11';
            break;
            case 18:
            result = 'ORAGEFichier12';
            break;
            case 20:
            result = 'pluiefaibleFichier21';
            break;
            case 21:
            result = 'pluiefaibleFichier21';
            break;
            case 22:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 23:
            result = 'NEIGEPLUIEFichier9';
            break;
            case 24:
            result = 'verglas';  // Pluie verglaçante
            break;
            case 25:
            result = 'aversesFichier23';
            break;
            case 26:
            result = 'aversesFichier23';
            break;
            case 27:
            result = 'aversesFichier23';
            break;
            case 28:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 29:
            result = 'ORAGEFichier12';
            break;
            case 36:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 37:
            result = 'neigeForte';
            break;
            case 38:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 39:
            result = 'neigeForte';
            break;
            case 40:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 41:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 42:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 43:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 44:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 45:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 46:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 47:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 48:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 49:
            result = 'LEGERBROUILLARDFichier5';
            break;
            case 50:
            result = 'pluiefaibleFichier21';
            break;
            case 51:
            result = 'pluiefaibleFichier21';
            break;
            case 52:
            result = 'pluiefaibleFichier21';
            break;
            case 53:
            result = 'pluiefaibleFichier21';
            break;
            case 54:
            result = 'pluiefaibleFichier21';
            break;
            case 55:
            result = 'pluiefaibleFichier21';
            break;
            case 56:
            result = 'verglas';
            break;
            case 57:
            result = 'verglas';
            break;
            case 59:
            result = 'pluiefaibleFichier21';
            break;
            case 59:
            result = 'pluieFichier22';
            break;
            case 60:
            result = 'pluieFichier22';
            break;
            case 61:
            result = 'pluieFichier22';
            break;
            case 62:
            result = 'pluieFichier22';
            break;
            case 63:
            result = 'pluieFichier22';
            break;
            case 64:
            result = 'pluieFichier22';
            break;
            case 65:
            result = 'pluieFichier22';
            break;
            case 66:
            result = 'verglas';
            break;
            case 67:
            result = 'verglas';
            break;
            case 68:
            result = 'NEIGEPLUIEFichier9';
            break;
            case 69:
            result = 'NEIGEPLUIEFichier9';
            break;
            case 70:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 71:
            result = 'neigeForte';
            break;
            case 72:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 73:
            result = 'neigeForte';
            break;
            case 74:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 75:
            result = 'neigeForte';
            break;
            case 76:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 77:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 78:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 79:
            result = 'NEIGEFAIBLEFichier6';
            break;
            case 80:
            result = 'aversesFichier23'; // Averses de pluie
            break;
            case 81:
            result = 'aversesFichier23'; // Averses de pluie
            break;
            case 82:
            result = 'aversesFichier23'; // Averses de pluie
            break;
            case 83:
            result = 'aversesFichier23'; // Averses de pluie
            break;
            case 84:
            result = 'aversesFichier23'; // Averses de pluie
            break;
            case 85:
            result = 'NEIGEFAIBLEFichier6'; // Averses de neige
            break;
            case 86:
            result = 'NEIGEMODEREEFichier7'; // Averses de neige modérée
            break;
            case 87:
            result = 'aversesFichier23'; // Averses de grésil
            break;
            case 88:
            result = 'aversesFichier23'; // Averses de grésil
            break;
            case 89:
            result = 'aversesFichier23'; // Averses de grele
            break;
            case 90:
            result = 'aversesFichier23'; // Averses de grele
            break;
            case 91:
            result = 'ORAGEFichier12'; 
            break;
            case 92:
            result = 'ORAGEFichier12'; 
            break;
            case 93:
            result = 'ORAGEFichier12'; 
            break;
            case 94:
            result = 'ORAGEFichier12'; 
            break;
            case 95:
            result = 'ORAGEUXFichier10'; // Averses orageuses
            break;
            case 96:
            result = 'ORAGEFORTFichier13'; 
            break;
            case 97:
            result = 'ORAGEFORTFichier13'; 
            break;
            case 98:
            result = 'ORAGEFichier12'; 
            break;
            case 99:
            result = 'ORAGEFORTFichier13'; 
            break;
            default:
                break;
        }
        return result; 
    }

    function isNight(period,value){
        let result;
        if(period === 'evening' || period === 'night'){
            switch (value) {
            case 'JOURCLAIRFichier16':
            result = 'NUITCLAIREFichier15';
            break;
            case 'PEUNUAGEUXFichier4':
            result = 'nuitnuageuxFichier17';
            break;
            case 'LEGERBROUILLARDFichier5':
            result = 'nuitnuageuxFichier17';
            break;
            case 'NUAGEUXFichier3':
            result = 'nuitnuageuxFichier17';
            break;
            case 'ORAGEUXFichier10':
            result = 'nuitorageFichier19';
            break;
            case 'aversesFichier23':
            result = 'nuitaverseFichier18';
            break;
            default:
                result = value;
                break;
            }
        }else{
            result = value;
        }
    return result;
}


function tempColor(value) {
let result;
switch (value) {
    case -15:
        result = '147,69,255';
        break;
    case -14:
        result = '0,0,255';
        break;
    case -13:
        result = '0,19,255';
        break;
    case -12:
        result = '0,39,255';
        break;
    case -11:
        result = '0,59,255';
        break;
    case -10:
        result = '0,78,255';
        break;
    case -9:
        result = '0,98,255';
        break;
    case -8:
        result = '0,118,255';
        break;
    case -7:
        result = '0,137,255';
        break;
    case -6:
        result = '0,157,255';
        break;
    case -5:
        result = '0,177,255';
        break;
    case -4:
        result = '0,196,255';
        break;
    case -3:
        result = '0,216,255';
        break;
    case -2:
        result = '0,236,255';
        break;
    case -1:
        result = '0,255,255';
        break;
    case 0:
        result = '19,255,236';
        break;
    case 1:
        result = '39,255,216';
        break;
    case 2:
        result = '59,255,196';
        break;
    case 3:
        result = '78,255,177';
        break;
    case 4:
        result = '98,255,157';
        break;
    case 5:
        result = '118,255,137';
        break;
    case 6:
        result = '137,255,118';
        break;
    case 7:
        result = '157,255,98';
        break;
    case 8:
        result = '177,255,78';
        break;
    case 9:
        result = '196,255,59';
        break;
    case 10:
        result = '216,255,39';
        break;
    case 11:
        result = '236,255,19';
        break;
    case 12:
        result = '255,255,0';
        break;
    case 13:
        result = '255,236,0';
        break;
    case 14:
        result = '255,216,0';
        break;
    case 15:
        result = '255,196,0';
        break;
    case 16:
        result = '255,177,0';
        break;
    case 17:
        result = '255,157,0';
        break;
    case 18:
        result = '255,137,0';
        break;
    case 19:
        result = '255,118,0';
        break;
    case 20:
        result = '255,98,0';
        break;
    case 21:
        result = '255,78,0';
        break;
    case 22:
        result = '255,59,0';
        break;
    case 23:
        result = '255,39,0';
        break;
    case 24:
        result = '255,19,0';
        break;
    case 25:
        result = '237,0,3';
        break;
    case 26:
        result = '225,0,3';
        break;
    case 27:
        result = '202,0,3';
        break;
    case 28:
        result = '187,0,3';
        break;
    case 29:
        result = '164,0,2';
        break;
    case 30:
        result = '133,0,2';
        break;
    case 31:
        result = '124,0,2';
        break;
    case 32:
        result = '128,0,128';
        break;
    case 34:
        result = '148,0,188';
        break;
    case 35:
        result = '171,0,238';
        break;
    case 36:
        result = '255,0,255';
        break;
    case 37:
        result = '226,0,226';
        break;
    case 38:
        result = '171,0,171';
        break;
    case 39:
        result = '124,0,124';
        break;
    case 40:
        result = '86,0,86';
        break;
    case 41:
        result = '151,39,199';
        break;
    case 42:
        result = '189,0,189';
        break;
    case 43:
        result = '255,0,255';
        break;
    default:
        result = '213,0,255';
        break;
}
return result;
}

function windDir(value) {
    let result;
    if(value <= 292 && value >= 247){
        result = 'ouest.png';
    }
    else if (value > 292 && value <= 338){
        result = 'nord-ouest.png';
    }
    else if (value > 338){
        result = 'nord.png';
    }
    else if (value >= 0 && value <= 22){
        result = 'nord.png';
    }
    else if (value > 22 && value <= 68){
        result = 'nord-est.png';
    }
    else if (value > 68 && value <= 113){
        result = 'est.png';
    }
    else if (value > 113 && value <= 158){
        result = 'sud-est.png';
    }
    else if (value > 158 && value <= 203){
        result = 'sud.png';
    }
    else if (value > 203 && value < 247){
        result = 'sud-ouest.png';
    }
    else {
        result = 'ok';
    }
    return result;
}
    
function todayDate(nextDay = 0) {
    const options = { weekday: 'long', month: 'long', day: 'numeric' };
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + nextDay);
    const finalDate = currentDate.toLocaleDateString('fr-FR', options);
    return finalDate;
};
function mapController(data,id) {  
    switch (id) {
        case 0:
            data = data.J1;
            break;
        
        case 1:
            data = data.J2;
            break;
        
        case 2:
            data = data.J3;
            break;
    
        default:
            data = data.J1;
            break;
    }
    function firstView() {
        todayDate(id);
        dateWeatherMap.innerHTML = todayDate(id);
        dateWeatherMapMobile.innerHTML = todayDate(id);
        iconWeather(data,'morning');
        iconTemperatures(data,'morning');
        iconWindValue(data,'morning');
        iconWindDir(data,'morning');
        cityWeatherElem.forEach(Element => {
            Element.classList.remove('none');
        })
        cityTemperatureElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityTemperatureTextElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityWindElem.forEach(Element => {
            Element.classList.add('none');
        })
        btnPeriodMorning.classList.add('selected-period');
        btnPeriodAfternoon.classList.remove('selected-period');
        btnPeriodEvening.classList.remove('selected-period');
        btnPeriodNight.classList.remove('selected-period');
        btnWeatherView.classList.add('btn-weather-selected');
        btnTemperatureView.classList.remove('btn-weather-selected');
        btnWindView.classList.remove('btn-weather-selected');
    };
    firstView();
    function iconWeatherMorning(){
        let index = 0;
        listElement.forEach(element => {
        let keyIndex = Object.keys(data.morning)[index];
        let iconIndex = data.morning[keyIndex][0];
        index+=1;
        let icon = weatherIcon(iconIndex);
        element.setAttribute('src', `../style/images/weather-map-icon/${icon}.png`);
        });
    }
    function iconTemperaturesMorning(){
        let index = 0;
        listTempElement.forEach(element => {
        let keyIndex = Object.keys(data.morning)[index];
        let iconIndex = data.morning[keyIndex][1];
        index+=1;
        element.textContent = Math.ceil(iconIndex);
        });
    }
    function iconWindValueMorning(){
        let index = 0;
        listWindValueElement.forEach(element => {
        let keyIndex = Object.keys(data.morning)[index];
        let iconIndex = data.morning[keyIndex][2];
        index+=1;
        element.textContent =  Math.ceil(iconIndex);
        });
    }
    function iconWeatherAfternoon(){
        let index = 0;
        listElement.forEach(element => {
        let keyIndex = Object.keys(data.afternoon)[index];
        let iconIndex = data.afternoon[keyIndex][0];
        index+=1;
        element.setAttribute('src', `../style/images/weather-map-icon/${iconIndex}.png`);
        });
    }
    function iconTemperaturesAfternoon(){
        let index = 0;
        listTempElement.forEach(element => {
        let keyIndex = Object.keys(data.afternoon)[index];
        let iconIndex = data.afternoon[keyIndex][1];
        index+=1;
        element.textContent = Math.ceil(iconIndex);
        element.setProperty('background-color','blue');
        });
    }
    function iconWindValueAfternoon(){
        let index = 0;
        listWindValueElement.forEach(element => {
        let keyIndex = Object.keys(data.afternoon)[index];
        let iconIndex = data.afternoon[keyIndex][2];
        index+=1;
        element.textContent =  Math.ceil(iconIndex);
        });
    }
    function iconWeatherEvening(){
        let index = 0;
        listElement.forEach(element => {
        let keyIndex = Object.keys(data.evening)[index];
        let iconIndex = data.evening[keyIndex][0];
        index+=1;
        element.setAttribute('src', `../style/images/weather-map-icon/${iconIndex}.png`);
        });
    }
    function iconTemperaturesEvening(){
        let index = 0;
        listTempElement.forEach(element => {
        let keyIndex = Object.keys(data.evening)[index];
        let iconIndex = data.evening[keyIndex][1];
        index+=1;
        element.textContent = Math.ceil(iconIndex);
        });
    }
    function iconWindValueEvening(){
        let index = 0;
        listWindValueElement.forEach(element => {
        let keyIndex = Object.keys(data.evening)[index];
        let iconIndex = data.evening[keyIndex][2];
        index+=1;
        element.textContent =  Math.ceil(iconIndex);
        });
    }
    function iconWeatherNight(){
        let index = 0;
        listElement.forEach(element => {
        let keyIndex = Object.keys(data.night)[index];
        let iconIndex = data.night[keyIndex][0];
        index+=1;
        element.setAttribute('src', `../style/images/weather-map-icon/${iconIndex}.png`);
        });
    }
    function iconTemperaturesNight(){
        let index = 0;
        listTempElement.forEach(element => {
        let keyIndex = Object.keys(data.night)[index];
        let iconIndex = data.night[keyIndex][1];
        index+=1;
        element.textContent = Math.ceil(iconIndex);
        });
    }
    function iconWindValueNight(){
        let index = 0;
        listWindValueElement.forEach(element => {
        let keyIndex = Object.keys(data.night)[index];
        let iconIndex = data.night[keyIndex][2];
        index+=1;
        element.textContent =  Math.ceil(iconIndex);
        })
    };
function iconWeather(day, timeOfDay) {
let index = 0;
    listElement.forEach(element => {
        let keyIndex = Object.keys(day[timeOfDay])[index];
        let iconIndex = day[timeOfDay][keyIndex][0];
        index += 1;
        let icon = weatherIcon(iconIndex);
        let iconView = isNight(timeOfDay,icon);
        element.setAttribute('src', `../style/images/weather-map-icon/${iconView}.png`);
    });
}
function iconTemperatures(day, timeOfDay) {
    let index = 0;
    listTempElement.forEach(element => {
        let keyIndex = Object.keys(day[timeOfDay])[index];
        let iconIndex = day[timeOfDay][keyIndex][1];
        index += 1;
        element.textContent = Math.ceil(iconIndex);
        let color = tempColor(Math.ceil(iconIndex));
        element.style.backgroundColor =`rgb(${color})`;

    });
}
function convWindValue(value) {
    if(value.length === 1) {
        return value; 
    }
    let newValue = value.substr(-1);
    let lastValue = value.slice(0, -1);  
    let newValueInt = parseInt(newValue);
    let lastValueInt =  parseInt(lastValue);
    if(newValueInt >= 0 && newValueInt < 5 ) {
        newValueInt = 0;
    }else if (newValueInt >= 5 && newValueInt < 10 ) {
        newValueInt = 5;
        lastValue ++;
    }
    newValue = String(newValueInt);
    lastValue = String(lastValueInt);
    let valueFinal = lastValue + newValue;
    console.log(valueFinal);
    return valueFinal;
}
function iconWindValue(day, timeOfDay) {
    let index = 0;
    listWindValueElement.forEach(element => {
        let keyIndex = Object.keys(day[timeOfDay])[index];
        let iconIndex = day[timeOfDay][keyIndex][2];
        index += 1;
        let windValue = String(Math.ceil(iconIndex));
        element.textContent = convWindValue(windValue);
    });
}   
function iconWindDir(day, timeOfDay) {
    let index = 0;
    listWindDirElement.forEach(element => {
        let keyIndex = Object.keys(day[timeOfDay])[index];
        let iconIndex = day[timeOfDay][keyIndex][3];
        index += 1;
        let windDirValue = windDir(iconIndex);
        element.setAttribute('src', `../style/images/weather-map-icon/wind/${windDirValue}`);
    });
}      
    const windowNotifElem =  document.querySelector('aside');
    btnWeatherView.addEventListener('click',()=>{
        cityWeatherElem.forEach(Element => {
            Element.classList.remove('none');
        })
        cityTemperatureElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityTemperatureTextElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityWindElem.forEach(Element => {
            Element.classList.add('none');
        })
        btnWeatherView.classList.add('btn-weather-selected');
        btnTemperatureView.classList.remove('btn-weather-selected');
        btnWindView.classList.remove('btn-weather-selected');
    })
    btnTemperatureView.addEventListener('click',()=>{
        cityWeatherElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityTemperatureElem.forEach(Element => {
            Element.classList.remove('none');
        })
        cityTemperatureTextElem.forEach(Element => {
            Element.classList.remove('none');
        })
        cityWindElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityWindTextElem.forEach(Element => {
            Element.classList.add('none');
        })
        btnWeatherView.classList.remove('btn-weather-selected');
        btnTemperatureView.classList.add('btn-weather-selected');
        btnWindView.classList.remove('btn-weather-selected');
    })
    btnWindView.addEventListener('click',()=>{
        cityWeatherElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityTemperatureElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityTemperatureTextElem.forEach(Element => {
            Element.classList.add('none');
        })
        cityWindTextElem.forEach(Element => {
            Element.classList.remove('none');
        })
        cityWindElem.forEach(Element => {
            Element.classList.remove('none');
        })
        btnWeatherView.classList.remove('btn-weather-selected');
        btnTemperatureView.classList.remove('btn-weather-selected');
        btnWindView.classList.add('btn-weather-selected');
    }) 
    btnPeriodMobile.textContent = 'matin';
    let cptView = 0;
    btnPeriodMobile.addEventListener('click',()=>{
        
        cptView++;
        switch (cptView) {
            case 0:
                iconWeather(data,'morning');
                iconTemperatures(data,'morning');
                iconWindValue(data,'morning');
                iconWindDir(data,'morning');
                btnPeriodMorning.classList.add('selected-period');
                btnPeriodAfternoon.classList.remove('selected-period');
                btnPeriodEvening.classList.remove('selected-period');
                btnPeriodNight.classList.remove('selected-period');
                btnPeriodMobile.textContent='doc';
                btnPeriodMobile.textContent = 'matin';
                break;
            case 1:
                iconWeather(data,'afternoon');
                iconTemperatures(data,'afternoon');
                iconWindValue(data,'afternoon');
                iconWindDir(data,'afternoon');
                btnPeriodMorning.classList.remove('selected-period');
                btnPeriodAfternoon.classList.add('selected-period');
                btnPeriodEvening.classList.remove('selected-period');
                btnPeriodNight.classList.remove('selected-period');
                btnPeriodMobile.textContent = 'après-midi';
            break
            case 2:
                iconWeather(data,'evening');
                iconTemperatures(data,'evening');
                iconWindValue(data,'evening');
                iconWindDir(data,'evening');
                btnPeriodMorning.classList.remove('selected-period');
                btnPeriodAfternoon.classList.remove('selected-period');
                btnPeriodEvening.classList.add('selected-period');
                btnPeriodNight.classList.remove('selected-period');
                btnPeriodMobile.textContent = 'soirée';
            break
            case 3:
                iconWeather(data,'night');
                iconTemperatures(data,'night');
                iconWindValue(data,'night');
                iconWindDir(data,'night');
                btnPeriodMorning.classList.remove('selected-period');
                btnPeriodAfternoon.classList.remove('selected-period');
                btnPeriodEvening.classList.remove('selected-period');
                btnPeriodNight.classList.add('selected-period');
                btnPeriodMobile.textContent = 'nuit';
            break
            default:
                iconWeather(data,'morning');
                iconTemperatures(data,'morning');
                iconWindValue(data,'morning');
                iconWindDir(data,'morning');
                btnPeriodMorning.classList.add('selected-period');
                btnPeriodAfternoon.classList.remove('selected-period');
                btnPeriodEvening.classList.remove('selected-period');
                btnPeriodNight.classList.remove('selected-period');
                btnPeriodMobile.textContent = 'matin';
            break;
        }

        if(cptView === 4)
        {
            cptView = 0;
        }
    })
    btnPeriodMorning.addEventListener('click',()=>{
        iconWeather(data,'morning');
        iconTemperatures(data,'morning');
        iconWindValue(data,'morning');
        iconWindDir(data,'morning');
        btnPeriodMorning.classList.add('selected-period');
        btnPeriodAfternoon.classList.remove('selected-period');
        btnPeriodEvening.classList.remove('selected-period');
        btnPeriodNight.classList.remove('selected-period');
    })

    btnPeriodAfternoon.addEventListener('click',()=>{
        iconWeather(data,'afternoon');
        iconTemperatures(data,'afternoon');
        iconWindValue(data,'afternoon');
        iconWindDir(data,'afternoon');
        btnPeriodMorning.classList.remove('selected-period');
        btnPeriodAfternoon.classList.add('selected-period');
        btnPeriodEvening.classList.remove('selected-period');
        btnPeriodNight.classList.remove('selected-period');
    })
    btnPeriodEvening.addEventListener('click',()=>{
        iconWeather(data,'evening');
        iconTemperatures(data,'evening');
        iconWindValue(data,'evening');
        iconWindDir(data,'evening');
        btnPeriodMorning.classList.remove('selected-period');
        btnPeriodAfternoon.classList.remove('selected-period');
        btnPeriodEvening.classList.add('selected-period');
        btnPeriodNight.classList.remove('selected-period');
    })
    btnPeriodNight.addEventListener('click',()=>{
        iconWeather(data,'night');
        iconTemperatures(data,'night');
        iconWindValue(data,'night');
        iconWindDir(data,'night');
        btnPeriodMorning.classList.remove('selected-period');
        btnPeriodAfternoon.classList.remove('selected-period');
        btnPeriodEvening.classList.remove('selected-period');
        btnPeriodNight.classList.add('selected-period');
    })

    btnNotifMap.addEventListener('click',()=>{
        windowNotifElem.classList.remove('none');
    })
    btnCloseNotifMap.addEventListener('click',()=>{
        windowNotifElem.classList.add('none');
    })


    const apiUrl = 'https://geo.api.gouv.fr/communes?nom=';
    const cityInput = document.querySelector('#cityName');
    const suggestionsCity = document.querySelector('#suggestions');

    cityInput.addEventListener('input', () => {
    const inputValue = cityInput.value.trim();
    if (inputValue.length >= 2) {
      fetch(apiUrl + inputValue + '&fields=codesPostaux,mairie&boost=population&limit=5')
        .then(response => response.json())
        .then(data => {
          displaySuggestions(data);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    } else {
      suggestionsCity.innerHTML = '';
    }
  });
  function displaySuggestions(suggestions) {
    suggestionsCity.innerHTML = '';
    suggestions.forEach(suggestion => {
      const suggestionCity = document.createElement('div');
      suggestionCity.className = 'autocomplete-suggestion';
      suggestionCity.textContent = suggestion.nom+' '+suggestion.codesPostaux;
      suggestionCity.addEventListener('click', () => {
        let codePostale = suggestion.codesPostaux;
        cityInput.value = suggestion.nom + ' ' + codePostale[0];
        suggestionsCity.innerHTML = '';
      });
      suggestionsCity.appendChild(suggestionCity);
    });
  }
}
    let weatherData;
    let id = 0;
    fetch('https://perso.meteolor.fr/other/Treatment/weatherMapApiData.php')
    .then(response => response.json())
    .then(data => {
        weatherData = data;
        mapController(weatherData, id); 
        btnNextDay.forEach(btn => {
        btn.addEventListener('click', () => {
        id = id+1; 
        id > 2 ? id = 2 : id=id;
        mapController(weatherData, id); 
        });
        btnPreviousDay.forEach(btn => {
            btn.addEventListener('click', () => {
                id = id-1; 
                id < 0 ? id = 0 : id=id;
            mapController(weatherData, id); 
            });
        }); 
    });
  });
</script>
</html>
