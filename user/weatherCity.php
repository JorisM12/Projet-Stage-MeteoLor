<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
if(empty($_GET['name_city']))
{
    header("location: ../../user/dashboardUser.php"); 
}
$cityNameUser = $_GET['name_city'];
$cityNameCP = substr($cityNameUser,-5);
$apiUrl = 'https://geo.api.gouv.fr/communes?codePostal='.$cityNameCP.'&fields=code,nom,centre';
$lat ='';
$lon ='';
$response = file_get_contents($apiUrl);
if ($response != false) {
    $data = json_decode($response, true);
    if ($data != null) {
        $filteredData = array(); 
        foreach ($data as $objet) {
            if (1 == 1) {
                $filteredData[] = $objet; 
                $lon = $filteredData[0]['centre']['coordinates'][0];
                $lat = $filteredData[0]['centre']['coordinates'][1];
                $apiWeatherUrl = 'https://api.open-meteo.com/v1/meteofrance?latitude='.$lat.'&longitude='.$lon.'&hourly=temperature_2m,weathercode,relativehumidity_2m,precipitation,weathercode,pressure_msl,winddirection_10m,windgusts_10m';
                $getData = file_get_contents($apiWeatherUrl);
                if ($getData === false) {
                    die('Erreur lors de la récupération des données.');
                }
                $resultData = json_decode($getData, true);
            }
        }
    } else {
        header("location: ../../user/error.html");
    }
} else {
    header("location: ../../user/error.html");
}
$tabWeather = [];
foreach ($resultData['hourly']['time'] as $key =>$step) {
    $tabWeather[$step] = ['temp' => $resultData['hourly']['temperature_2m'][$key], 'weet' => $resultData['hourly']['relativehumidity_2m'][$key], 'prec' => $resultData['hourly']['precipitation'][$key],'weathercode' => $resultData['hourly']['weathercode'][$key], 'press' => $resultData['hourly']['pressure_msl'][$key], 'wdir' => $resultData['hourly']['winddirection_10m'][$key], 'gust' => $resultData['hourly']['windgusts_10m'][$key]];  
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/weatherCity.css">
    <title>Prévision détaillée</title>
</head>
<body>
    <header>
        <h1 class="title-type-1" >Prévisions à 4 jours pour <?=$cityNameUser;?> </h1>
    </header>
    <main>
        <div id="formCity">
            <form action="weatherCity.php" method="get">
                <input class="input-type-1" type="text" placeholder="Nom de ville et le code postal" name="name_city" id="cityName">
                <button class="button-type-2" type="submit">Rechercher</button>
            </form>
            <div id="suggestions"></div>
        </div>
        <section>
            <table>
                <thead>
                    <th>
                        Heure
                    </th>
                    <th>
                        Ciel
                    </th>
                    <th>
                        Températures
                    </th>
                    <th>
                        Humidité
                    </th>
                    <th>
                        Vent en rafales (km/h)
                    </th>
                    <th>
                        Direction du vent
                    </th>
                    <th>
                        Précipitation sur 1h (mm)
                    </th>
                    <th>
                        Pression atmosphérique (hPa)
                    </th>
                </thead>
                <tbody>
                    <?php
                        $dateSave = formatDateToFrench(date('Y-m-d'));
                        foreach ($tabWeather as $key => $value) { 
                    ?>
                    <?php
                        if($dateSave != formatDateToFrench($key))
                        {
                            $dateSave = formatDateToFrench($key);
                    ?>
                        <tr>
                            <td colspan="8" class="date-save">
                                <?= $dateSave ;?>
                            </td>
                        </tr>
                    <?php
                        }   
                    ?>
                    <tr>
                        <td>
                            <?=substr($key,11,16) ;?>
                        </td>
                        <td>
                            <?php
                                $iconValue = weatherIcon($value['weathercode']);
                                $iconValue = isNight(substr($key,11,16),$iconValue);
                            ?>
                            <img src="../style/images/weather-map-icon/<?=$iconValue;?>.png" alt="">
                        </td>
                        <td class='case-tmp'>
                            <div class='tmp-color' style="background-color:rgb(<?=tempColor(ceil($value['temp']));?>) ;"></div>
                            <?=$value['temp'];?>
                        </td>
                        <td>
                            <?=$value['weet'];?>
                        </td>
                        <td>
                            <?=$value['gust'];?>
                        </td>
                        <td>
                            <img class='wind-img' src="../style/images/weather-map-icon/wind/<?=windDir($value['wdir']) ;?>" alt="direction du vent">
                        </td>
                        <td style="color:<?=precipitationColor($value['prec']);?>">
                            <?=$value['prec'];?>
                        </td>
                        <td>
                            <?=$value['press'];?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
<script>
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
</script>
</html>
