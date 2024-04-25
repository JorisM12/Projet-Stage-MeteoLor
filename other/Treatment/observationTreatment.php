<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/ObservationsManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$observationManager = new ObservationsManager($db->getConnection());
if($_GET['delete'] == true)
{
    $observationManager->archiveObservation($_GET['id']);
    header("location: ../../admin/observationsList.php");
    exit();
}
if (
    isset($_POST['type_observation']) && !empty($_POST['type_observation']) &&
    isset($_POST['description_observation']) && !empty($_POST['description_observation']) &&
    isset($_POST['location_observation']) && !empty($_POST['location_observation']) &&
    isset($_POST['token']) && $_POST['token'] === $_SESSION['token'] &&
    isset($_POST['id_user']) && !empty($_POST['id_user'])) 
{
    $cityNameCP = substr($_POST['location_observation'],-5);
    $apiUrl = 'https://geo.api.gouv.fr/communes?codePostal='.$cityNameCP.'&fields=code,nom,centre';
    $lat ='';
    $lon ='';

    file_get_contents("https://geo.api.gouv.fr/communes?codePostal=57000&fields=code,nom,centre");

    $response = file_get_contents($apiUrl);
    if($response === false)
    {
        header("location:/user/receptionUser.php?error=1");
    }
    $data = json_decode($response, true);
    $lon = $data[0]['centre']['coordinates'][0];
    $lat = $data[0]['centre']['coordinates'][1];
    if($_FILES['image_observation']['name'] === "")
    {
        $linkImg = '';
        $observationManager->saveObservation($_POST['location_observation'],$lat,$lon,0,0,$_POST['description_observation'],$linkImg,floatval($_POST['value_observation']),NULL,$_POST['type_observation'],$_POST['id_user']);  
        header("location:/user/receptionUser.php?send=1");
    }else{
        $linkImg = $observationManager->saveImageObservation($_FILES['image_observation'],date('d/m/Y H:i:s'),$userManager->selectOneUser($_SESSION['user_id'])['alias_user']);
        $observationManager->saveObservation($_POST['location_observation'],$lat,$lon,0,0,$_POST['description_observation'],$linkImg,floatval($_POST['value_observation']),NULL,$_POST['type_observation'],$_POST['id_user']);  
        header("location:/user/receptionUser.php?send=1");
    }
}
else
{
    header("location:/user/receptionUser.php?error=1&description_observation=".$_POST['description_observation']."&location_observation=".$_POST['location_observation']."&type_observation=".$_POST['type_observation']);
}

