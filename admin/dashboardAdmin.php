<?php
//header("location: ../../user/buildPage.html");
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/protectAdmin.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/WeatherAlertManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/WeatherAlert.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
$db = new Connect();
$WeatherAlertManager = new WeatherAlertManager($db->getConnection());
$token = token();
$_SESSION['token'] = $token;
$blocFormAlert = true;
$messageView = 0;
$allAlert = $WeatherAlertManager->selectAllAlertFutur();
$lastUpdate = weatherMapIsUpdate();
if(isset($_GET['error']) && ($_GET['error'] === '1' || $_GET['error'] === '2' || $_GET['error'] === '3' || $_GET['error'] === '4' || $_GET['error'] === '5'  || $_GET['error'] === '6')) 
{
    $messageView = 1;
    switch ($_GET['error']) {
        case '1':
            $error = "La date de début doit forcément être antérieur à celle de fin";
            break;
        case '2':
            $error = "Le message ne peut pas excéder 250 caractères";
            break;
        case '3':
            $error = "Erreur de saisie";
            break;
        default:
            $error = "Une erreur est survenue";
            break;
    }
}
$blocViewAlert = false; 
$weatherAlertActive = $WeatherAlertManager->weatherAlertVerify();
if($weatherAlertActive > 0 ) 
{
    $infoAlert = $WeatherAlertManager->selectOneAlert($weatherAlertActive["id_weather_alert"]);
    $currentAlert = new WeatherAlert(
        $infoAlert["id_weather_alert"],
        $infoAlert["start_date"],
        $infoAlert["end_date"],
        $infoAlert["description_weather_alert"],
        $infoAlert["id_weather_alert_type"],
        $infoAlert["archive_weather_alert"],
        $infoAlert["level_weather_alert"],
        $infoAlert["name_weather_alert_type"]

    ); 
    if($currentAlert->isArchiveAlert() === true)
    {
        $blocViewAlert = false;
    }
    else 
    {
        $blocViewAlert = true;
        $blocFormAlert = false;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/dashboardAdmin.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Tableau de bord</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="../admin/dashboardAdmin.php"><img src="../style/images/logo_mini.png" alt="logo"></a>
            <div id="burger-menu"> 
            </div>
            <div class="bloc-burger-menu">
                <nav>
                    <img src="../style/images/x.png" alt="fermer le menu" id="btn-close-menu">
                    <ul>
                        <li><a href="../admin/userList.php" title="Liste des utilisateurs">Liste des utilisateurs</a></li>
                        <li><a href="../admin/observationsList.php" title="Liste des observations">Liste des observations</a></li>
                        <li><a href="../admin/stationsList.php" title="Liste des stations">Liste des stations</a></li>
                        <li><a href="#" title="Mon compte">Mon compte</a></li>
                        <li>Vous êtes admin</li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> <img id="btn-logout" src="../style/images/login.png" alt=""></a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../admin/dashboardAdmin.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../admin/userList.php" title="Liste des utilisateurs">Liste des utilisateurs</a></li>
                <li><a href="../admin/observationsList.php" title="Liste des observations">Liste des observations</a></li>
                <li><a href="../admin/stationsList.php" title="Liste des stations">Liste des stations</a></li>
                <li><a href="#" title="Mon compte"></a>Mon compte</li>
                <li>Vous êtes admin</li>
            </ul>
            <div id="log-out">
                <a href="../other/Functions/logout.php" title="Se déconnecter"> <img src="../style/images/login.png" alt=""></a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <?php 
            if($blocViewAlert === true)
            { 
            ?>
                <div id="weather-alert-active" class="container-type-2">
                    <h3> <?=isset($currentAlert) ? $WeatherAlertManager->selectOneTypeAlert($currentAlert->getIdTypeAlert())['name_weather_alert_type'] : "";?> </h3>
                    <img src="../style/images/weather-alert-icon/<?=$currentAlert->getNameWeatherAlert();?><?=$currentAlert->getLevelAlert();?>.svg" alt="">
                    <div>
                        <p>
                            <span>Date et heure de début </span> : <?= $currentAlert->getStartDateAlert();?>
                        </p>
                        <p>
                        <span>Date et heure de fin </span> : <?= $currentAlert->getEndDateAlert();?>
                        </p>
                    </div>
                    <div>
                        <p>
                            <span>Description</span>
                        </p>
                        <p>
                            <?= $currentAlert->getDescriptionAlert();?>
                        </p>
                    </div>
                    <form action="../other/Treatment/cancelWeatherAlertTreatment.php" method ="post">
                        <input type="hidden" name="id_weather_alert" value= <?=$currentAlert->getIdAlert();?>>
                        <input type="hidden" name="token" value=<?=$token;?>>
                        <button type ="submit"> ANNULER</button>
                    </form>
                </div>
            <?php
                }
            ?>
            <?php 
                if($blocFormAlert === true)
                {
            ?>
                <div class="container-type-2">
                    <h3>Ajouter une alerte</h3>
                    <form action="../other/Treatment/WeatherAlertTreatment.php" method="POST">
                        <p>Séléctionner un phénomène:</p>
                    <div id ="select-alert-type"> 
                        <?php
                            foreach ($WeatherAlertManager->selectAllTypeAlert() as $type) { 
                            ?>
                            <div>
                                <input type="radio" id="typeAlert_<?= $type['id_weather_alert_type'];?>"
                                name="id_weather_alert_type" value=<?= $type['id_weather_alert_type'];?>>
                                <label for="typeAlert_<?= $type['id_weather_alert_type'];?>"><?= $type['name_weather_alert_type'];?></label>
                            </div>
                            <?php
                                }
                            ?>         
                    </div>
                    <p id="level-title">Séléctionner le niveau:</p>
                    <div id ="select-level-alert"> 
                        <div>
                            <input type="radio" name="level_alert" value=1>
                            <label for="level_alert">basique</label>
                        </div>
                        <div>
                            <input type="radio" name="level_alert" value=2>
                            <label for="level_alert">important</label>
                        </div>
                        <div>
                            <input type="radio" name="level_alert" value=3>
                            <label for="level_alert">très important</label>
                        </div>
                    </div>
                    <?php
                        if($messageView ===1)
                        { ?>
                        <p>
                            <?=$error;?>
                        </p>
                    <?php
                        }
                    ?>
                    <div id="form-part-2">
                        <label for="start_time_alert">Date et heure de début:</label>
                        <input type="date" name="start_date_alert" >
                        <input type="time"  name="start_time_alert" >
                        <label for="end_time_alert">Date et heure de fin:</label>
                        <input type="date" name="end_date_alert" >
                        <input type="time"  name="end_time_alert" >
                        <label for="message_alert">Message:</label>
                        <input type="text" name="description_weather_alert" placeholder="250 caractères maximum">
                    </div>
                    <input type="hidden" name="token" value=<?=$token;?>>
                    <button type="submit">ACTIVER</button>
                    </form>
                </div>
            <?php
                }
            ?>
        </section>
        <section class="container-type-3">
            <h4>Statistiques</h4>
            <ul>
                <li>Nombre d'observations cette année: 55</li>
                <li>Nombre d'observations ce mois-ci: 7</li>
                <li>Nombre d'inscrits: 15</li>
                <li>Phénomène le plus reporté: Neige</li>
                <li>....</li>
            </ul>
            <h4>Alertes à venir</h4>
            <ul>
                <?php
                    foreach ($allAlert as $alert) {
                ?>
                     <li><?=$alert['start_date'];?> <?=$alert['name_weather_alert_type'];?></li>
                <?php
                    }
                ?>
            </ul>
            <h4>Dernière mise à jour de la carte de prévisions</h4>
            <p>
                    <?=$lastUpdate['lastDate'];?>
            </p>
            <a  href='../other/Treatment/weatherMapApiManual.php' class="button-type-1">METTRE A JOUR</a>
            <h4>Carte de prévisions pour les screens</h4>
            <a  href='../user/weatherMapScreen.php' class="button-type-1">Voir</a>
        </section>  
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script src="../script/script-burger-menu.js"></script>
</html>
