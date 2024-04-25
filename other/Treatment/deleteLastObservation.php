<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/ObservationsManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$res = $observationManager->archiveLastObservationByUser($_SESSION['user_id']);
header("location:/user/receptionUser.php");

