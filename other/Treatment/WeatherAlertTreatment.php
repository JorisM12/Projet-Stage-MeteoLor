<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/WeatherAlertManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';

if(isset($_POST['id_weather_alert_type']) && $_POST['id_weather_alert_type'] !=0 && isset($_POST['start_date_alert']) && $_POST['start_date_alert'] != "" && isset($_POST['start_time_alert']) && $_POST['start_time_alert'] != "" && isset($_POST['end_date_alert']) && $_POST['end_time_alert'] != "" && isset($_POST['description_weather_alert']) && $_POST['description_weather_alert'] != "" && isset($_POST['token']) && $_POST['token'] === $_SESSION['token'] && isset($_POST['level_alert']) && $_POST['level_alert'] != "" )
{   
    if($_POST['start_date_alert'] > $_POST['end_date_alert'])
    {
        header("location: ../../admin/dashboardAdmin.php?error=1&description=".$_POST['description_weather_alert']);
        echo 'ok';
        exit();
    }
    if(strlen($_POST['description_weather_alert']) > 250)
    {
        header("location: ../../admin/dashboardAdmin.php?error=2&description=".$_POST['description_weather_alert']);
        echo 'trop long';
        exit();
    }
    $bd = new Connect();
    $weatherAlertManager =  new WeatherAlertManager($bd->getConnection());
    $weatherAlertManager->saveWeatherAlert(0,$_POST['id_weather_alert_type'],$_POST['start_date_alert'], $_POST['start_time_alert'], $_POST['end_date_alert'], $_POST['end_time_alert'], $_POST['description_weather_alert'], $_POST['level_alert']);
    header("location: ../../admin/dashboardAdmin.php");
}
else 
{
    header("location: ../../admin/dashboardAdmin.php?error=3");
    exit();
}
