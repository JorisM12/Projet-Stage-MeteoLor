<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';

$db = new Connect();
$userManager = new UserManager($db->getConnection());
if(isset($_GET['delete']) && $_GET['delete'] == 1 && isset($_GET['id']) && !empty($_GET['id']))
{
    $userManager->archiveUser($_GET['id']);
    $_SESSION = array();
    header("location: /index.php");
    exit();
}elseif (isset($_GET['anonymize']) && $_GET['anonymize'] == 1 && isset($_GET['id']) && !empty($_GET['id'])) {
    $userManager->anonymizeUser($_GET['id']);
    $_SESSION = array();
    header("location: /index.php");
    exit();
    
}
if(isset($_POST['email_user']) && !empty($_POST['email_user']) && isset($_POST['pseudo_user'])&& !empty($_POST['user_id']) && isset($_POST['user_id']) && !empty($_POST['pseudo_user']) && isset($_POST['city_user']) && !empty($_POST['city_user']) && isset($_POST['token']) && $_POST['token'] = $_SESSION['token'])
{
    $userManager->saveUser($_POST['user_id'],$_POST['pseudo_user'],$_POST['email_user'],$_POST['password_user'],$_POST['member_user'],$_POST['city_user']);
    header("location: ../../user/dashboardUser.php"); 
}
else
{
    header("location: ../../user/myAccount.php");
}
