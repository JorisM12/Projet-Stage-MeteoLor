<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/WeatherAlertManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';

var_dump($_POST);
if(isset($_POST['id_weather_alert']) && $_POST['id_weather_alert'] != "" && isset($_POST['token']) && $_POST['token'] === $_SESSION['token'])
{
    
    $db = new Connect();
    $sql = "UPDATE weather_alerts SET archive_weather_alert = :archive_weather_alert WHERE id_weather_alert = :id_weather_alert ";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->execute([':archive_weather_alert' => 1, ':id_weather_alert' =>$_POST['id_weather_alert']]);
}

header("location: ../../admin/dashboardAdmin.php");