<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
$database= new Connect();
$db = $database->getConnection();
$sql= "SELECT forcast_weather_forcast
FROM weather_forcast
WHERE id_weather_forcast = (
    SELECT MAX(id_weather_forcast)
    FROM weather_forcast
)";
$stmt = $db->prepare($sql);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$jsonData = $data["forcast_weather_forcast"];

header('Content-Type: application/json');
echo $jsonData;
