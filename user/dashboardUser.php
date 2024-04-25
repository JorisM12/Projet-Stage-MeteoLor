<?php
//header("location: ../../user/buildPage.html");
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/StationManager.php';
$memberStatus =  memberVerification($_SESSION['user_member']);
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$userData = $userManager->selectOneUser($_SESSION['user_id']);
$city = $userData['city_user'];
$cityNameCP = substr($city,-5);
$data =  getWeatherDataForUser($cityNameCP);
$dataSnow = getWeatherSnowData();
$dataStationOrigin = new StationManager($db->getConnection());
$dataStation = $dataStationOrigin->selectAllDataStation(1);
$dataTab = [];
$cptHours = 0;
foreach ($dataStation as $key => $value) {
    $dataTab['hours'.$cptHours] = $value;
    //var_dump($value);
    $cptHours++;
}
$dataGrap = json_encode($dataTab);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/dashboard.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Tableau de bord</title>  
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
                        <li><?=$memberStatus['pictogramme'];?></li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><?=$memberStatus['pictogramme'];?></li>
                <li><a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <section class="container-type-1" id="weather-module">
            <h2>La météo à <?=$city;?></h2>
            <section class="container-type-2">
                <div>
                    <img src="../style/images/weather-map-icon/<?=weatherIcon($data['today-morning-wmo']);?>.png" alt="état du ciel">
                    <p>
                        <span class="temperature-style blue"> <?=$data['other'][4]["tminJ+0"];?></span>
                    </p>
                    <div class="wind-bloc">
                        <img class="picto" src="../style/images/vent.png" alt="pictogramme">
                        <p>  Rafales:<br>
                            <?=ceil($data['today-morning-gust']);?> km/h
                        </p>
                    </div>
                </div>
                <div id="rod">
                </div>
                <div>
                    <img src="../style/images/weather-map-icon/<?=weatherIcon($data['today-afternoon-wmo']);?>.png">
                    <p>
                       <span class="temperature-style red"><?=$data['other'][1]["tmaxj+0"];?> </span>
                    </p>
                    <div class="wind-bloc">
                        <img class="picto" src="../style/images/vent.png" alt="pictogramme">
                        <p> Rafales:<br>
                            <?=ceil($data['today-afternoon-gust']);?> km/h
                        </p>
                    </div>
                </div>
            </section>
            <section id="following-days" class="container-type-2">
                <div>
                    <h3>Demain</h3>
                    <div>
                        <p>
                            <span class="temperature-style blue"><?=$data['other'][5]["tminj+1"];?>°C</span>
                        </p>
                        <img src="../style/images/weather-map-icon/<?=weatherIcon($data['other']['wmoj+1']);?>.png">
                        <p>
                            <span class="temperature-style red"><?=$data['other'][2]["tmaxj+1"];?>°C</span>
                        </p>
                    </div> 
                </div>
                <div id="rod-B">
                </div>
                <div>
                    <h3>Après demain</h3>
                    <div>
                        <p>
                            <span class="temperature-style blue"><?=$data['other'][6]["tminj+2"];?>°C</span>
                        </p>
                        <img src="../style/images/weather-map-icon/<?=weatherIcon($data['other'][0]['wmoj+2']);?>.png" alt="état du ciel">
                        <p>
                            <span class="temperature-style red"><?=$data['other'][3]["tmaxj+2"];?>°C</span>
                        </p>
                    </div>
                </div>
            </section>
            <div id="btn-nav">
                <a href="#" title="jour suivant"><img src="../style/images/arrows.png" alt="flèche de navigation"></a>
                <a href="#" title="jour suivant"><img src="../style/images/arrows.png" alt="flèche de navigation"></a>

            </div>
        </section>
        <section class="container-type-1">
            <h3>Météo des neiges</h3>
            <ul>
            <h4>Hautes Vosges 1250m</h4>
                <li>Isotherme 0°C matin: <?=htmlspecialchars($dataSnow['today-morning-iso']) ;?>m</li>
                <li>Isotherme 0°C après-midi: <?=htmlspecialchars($dataSnow['today-afternoon-iso']);?>m</li>
                <li>Isotherme 0°C soirée: <?=htmlspecialchars($dataSnow['today-night-iso']);?>m</li>
                <li>Risque de chute de neige:<?=$dataSnow['today-snow'] > 0 ? 'Oui' : 'Non';?> </li>
                <li>Risque de gel: <?php 
                    if($dataSnow['today-temp-min'] > 0)
                    {
                        echo 'Non';
                    }elseif ($dataSnow['today-temp-min'] < 0) {
                        echo 'Oui - 0 à -3°C';
                    }elseif ($dataSnow['today-temp-min'] < -3) {
                    echo 'Oui | -3 à -5°C';
                    }elseif ($dataSnow['today-temp-min'] < -5) {
                        echo 'Oui | -5 à -10°C';
                    }elseif ($dataSnow['today-temp-min'] < -10) {
                        echo 'Oui | inf à -10°C';
                    }
                
                $dataSnow['today-temp-min'] < 0 ? 'Oui' : 'Non';?></li>
                <li>Cumuls de neige 24h à venir: <?=htmlspecialchars($dataSnow['today-snow']);?>cm</li>
            </ul>
        </section>
        <div id="container-aside">
            <aside class="container-type-1">
                <h4>Températures</h4>
                <img src="https://www.meteociel.fr/cartes_obs/graph/temp17.gif">
                <a href="https://www.meteociel.fr" target="_blank">©Météociel</a>
            </aside>
            <aside class="container-type-1 ">
                <h4>Vent moyen et rafales</h4>
                <img src="https://www.meteociel.fr/cartes_obs/graph/vent17.gif" alt="graphique des rafales de vent">
                <a href="https://www.meteociel.fr" target="_blank">©Météociel</a>
            </aside>
            <aside class="container-type-1 ">
                <h4>Précipitations</h4>
                <img src="https://static.meteociel.fr/cartes_obs/graphe2.php?type=16&minvalue=1&s=10min&c=eNpV0jEOwyAMQNHbdEQYEzBDDxMpR.j91aa18e.EnVhv.tf5OmU86.O6h6OYai5jzFyOHJVHgqMYOp1OpxccKY_g9BiUjtLRdJSO0tlfG51Gp6XT6DQ6LQahI3QkHaEjdCSGSqfSqelUOpVO9WGBWVDWRhaMBWL5axAMgm3BIBgE83dCmBDmFiaECSHeAWFAGFsYEAaE6JbZstqMls0y2fjPYNlr5spaGWu0ylRZaobKTplpfGOk3mjpvh1PKc3nr1LMt9uR3_z5.rv5y9Ql8.3AFfpiXv4yUjaaibJQBnr3.QYNsilQ" alt="Précipitations sur 1h">
                <a href="https://www.meteociel.fr" target="_blank">©Météociel</a>
            </aside>
        </div>
        <div id="btn-nav-mobile">
            <div>
            </div>
            <div>
            </div>
        </div>
        <div id="btn-nav-graph">
            <a href="#" title="jour suivant" id="previousGraph"><img src="../style/images/arrows.png" alt="flèche de navigation"></a>
            <a href="#" title="jour suivant" id="nextGraph"><img src="../style/images/arrows.png" alt="flèche de navigation"></a>

        </div>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script>
    const dataSS=<?=$dataGrap;?>
</script>
<script src="../script/script-burger-menu.js"></script>
<script src="../script/script-dashboard-mobile-view.js"></script>
<!-- <script src="../script/script-graph-station-1.js"></script>
<script src="../script/script-graph-station-2.js"></script>
<script src="../script/script-graph-station-3.js"></script> -->
</html>