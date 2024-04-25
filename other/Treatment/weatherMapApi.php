<?php
try {
	$host = 'meteolorinterfac.mysql.db';
    $dbname = 'meteolorinterfac';
    $username = 'meteolorinterfac';
    $userpdw = '798nhnbJambonSOLEILmet3453AN';

$db = new PDO ("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$username,$userpdw);
} catch (exception $e){
    die ($e ->getMessage());
}
$citys = ['Nord-Meuse'=>[49.416,5.340],'Sud-Verdun'=>[49.110,5.406],'Sud-Meuse'=>[48.603,5.495],'Neufchateau'=>[48.2544,5.854],'Nord-Epinal'=>[48.319,6.214],'Epinal' => [48.172, 6.449],'St-Die'=>[48.323,7.021],'Est-Luneville'=>[48.547,6.906],'Nord-Sarrebourg'=>[48.805,7.092],'Sarreguemine'=>[49.097,7.101],'Dieuze'=>[48.835,6.753],'Metz' => [49.133, 6.166],'Thionville'=>[49.375,6.251],'Etain'=>[49.216,5.695],'Nancy' => [48.692, 6.200], 'Sud-Jarny' =>[49.055,5.531],'Bicthe' =>[49.039,7.253],'Bussang'=>[47.492,6.504]];

function dataApi(float $lon, float $lat, int $codeHours)
{
    $response = file_get_contents("https://api.open-meteo.com/v1/meteofrance?latitude=".$lat."&longitude=".$lon."&hourly=temperature_2m,weathercode,windgusts_10m,winddirection_10m&timezone=auto");
    if ($response === false) {
        die('Erreur lors de la récupération des données.');
    }
    $data = json_decode($response, true);
    if ($data === null) {
        die('Erreur lors de la conversion des données JSON.');
    }
    $hourlyWeatherCode = $data['hourly']['weathercode'];
    return [$data['hourly']['weathercode'][$codeHours],$data['hourly']['temperature_2m'][$codeHours],$data['hourly']['windgusts_10m'][$codeHours],$data['hourly']['winddirection_10m'][$codeHours]];
}
$codeHours = [6, 13, 19, 23];
$dataForMapMorning = [];
$dataForMapAfternoon = [];
$dataForMapEvening = [];
$dataForMapNight = [];
$dataForMapMorningJ2 = [];
$dataForMapAfternoonJ2 = [];
$dataForMapEveningJ2 = [];
$dataForMapNightJ2 = [];
$dataForMapMorningJ3 = [];
$dataForMapAfternoonJ3 = [];
$dataForMapEveningJ3 = [];
$dataForMapNightJ3 = [];
foreach ($citys as $city => $value) {
    $dataForMapMorning[$city] = dataApi($value[1], $value[0], 8);
    $dataForMapMorningJ2[$city] = dataApi($value[1], $value[0], 32);
    $dataForMapMorningJ3[$city] = dataApi($value[1], $value[0], 56);
    
}
foreach ($citys as $city => $value) {
    $dataForMapAfternoon[$city] = dataApi($value[1], $value[0], 15);
    $dataForMapAfternoonJ2[$city] = dataApi($value[1], $value[0], 39);
    $dataForMapAfternoonJ3[$city] = dataApi($value[1], $value[0], 63);
}
foreach ($citys as $city => $value) {
    $dataForMapEvening[$city] = dataApi($value[1], $value[0], 21);
    $dataForMapEveningJ2[$city] = dataApi($value[1], $value[0], 45);
    $dataForMapEveningJ3[$city] = dataApi($value[1], $value[0], 69);
}
foreach ($citys as $city => $value) {
    $dataForMapNight[$city] = dataApi($value[1], $value[0], 25);
    $dataForMapNightJ2[$city] = dataApi($value[1], $value[0], 49);
    $dataForMapNightJ3[$city] = dataApi($value[1], $value[0], 73);
}
$sendData = [];
$sendData['J1']['morning'] = $dataForMapMorning;
$sendData['J1']['afternoon'] = $dataForMapAfternoon;
$sendData['J1']['evening'] = $dataForMapEvening;
$sendData['J1']['night'] = $dataForMapNight;
$sendData['J2']['morning'] = $dataForMapMorningJ2;
$sendData['J2']['afternoon'] = $dataForMapAfternoonJ2;
$sendData['J2']['evening'] = $dataForMapEveningJ2;
$sendData['J2']['night'] = $dataForMapNightJ2;
$sendData['J3']['morning'] = $dataForMapMorningJ3;
$sendData['J3']['afternoon'] = $dataForMapAfternoonJ3;
$sendData['J3']['evening'] = $dataForMapEveningJ3;
$sendData['J3']['night'] = $dataForMapNightJ3;
$jsonData = json_encode($sendData);
$sql= "INSERT INTO weather_forcast (date_weather_forcast,forcast_weather_forcast) VALUES (NOW(),:dataForcast)";
$stmt = $db->prepare($sql);
$stmt->execute([':dataForcast' => $jsonData]);
