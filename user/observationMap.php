<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/observationMap.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
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
        <aside class="none">
            <div>
            </div>
            <div>
                <img src="../style//images/storm.png" alt="risque d'orage">
                <p>
                    <span>ORAGES FORTS</span>
                </p>
                <p>
                    Un risque d'orages forts à localement violent est attendue ce soir sur la région
                </p>
            </div>
        </aside>
        <section>
            <div id="dates-orders-mobile">
                <h3>MARDI 27 JUIN</h3>
                <p>Observations depuis les 3 dernières heures </p>
            </div>
            <div id="content-map">
                <div id="map">
                    <div class="weather-obs temperature" id="obs-12">
                        <img src="../style/images/temperature.png" alt="">
                    </div>
                    <div class="weather-obs wind" id="obs-13">
                        <img src="../style/images/vent.png" alt="">
                    </div>
                    <div class="weather-obs sky" id="obs-14">
                        <img src="../style/images/tempss.png" alt="">
                    </div>
                    <div class="weather-obs temperature" id="obs-22">
                        <img src="../style/images/temperature.png" alt="">
                    </div>
                    <div class="weather-obs wind" id="obs-23">
                        <img src="../style/images/vent.png" alt="">
                    </div>
                    <div class="weather-obs sky" id="obs-24">
                        <img src="../style/images/tempss.png" alt="">
                    </div>
                </div>
            </div>
            <div id="orders">
                <div id="dates-orders">
                    <h3>OBSERVATIONS</h3>
                   <p>Observations depuis les 3 dernières heures </p>
                </div>
                <div id="other-orders">
                    <div id="hourly-order" class="box-type">
                        <p>
                            Les observations depuis...
                        </p>
                        <div>
                            <div class="button-hourly box-selected">1h</div>
                            <div class="button-hourly">3h</div>
                            <div class="button-hourly">6h</div>
                            <div class="button-hourly">12h</div>
                            <div class="button-hourly">24h</div>
                        </div>
                    </div>
                    <div id="type-obs-order" class="box-type">
                        <p>
                           Choisissez un type d'observation
                        </p>
                        <div>
                            <div class="button-hourly box-selected"></div>
                            <div class="button-hourly"></div>
                            <div class="button-hourly"></div>
                        </div>
                    </div>
                </div>
                <div id="post-obs" class="box-type">
                    <p>
                       <span>NOUVEAU !</span> Postez vos observations
                    </p>
                    <div>
                        <div class="button-hourly">CLIQUEZ ICI → </div>
                    </div>
                </div>
                <img src="../style/images/logo_bis.png" alt="logo Météolor'">
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
<script src="../script/script-observation-map.js"></script>
</html>

