<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/UserManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
$db = new Connect();
if(isset($_POST['alias_user']) && $_POST['alias_user'] != '' && isset($_POST['mail_user']) && $_POST['mail_user'] != '' && isset($_POST['password_user']) && $_POST['password_user'] != '' && isset($_POST['password_user_confirm']) && $_POST['password_user_confirm'] != '' &&  $_POST['token'] === $_SESSION['token'] &&  $_POST['protect'] === "deux")
{
    if($_POST['password_user_confirm'] != $_POST['password_user'])
    {
        header("location: ../../index.php?error=1");
        exit();
    }else{
        if(aliasLength($_POST['alias_user']) > 50 )
        {
            header("location: ../../user/registration.php?error=5&mail=".$_POST['mail_user']);
            exit();
        }
        $aliasChecked = findUniqueAlias($db->getConnection(),$_POST['alias_user']);
        $mailChecked = findUniqueMail($db->getConnection(),$_POST['mail_user']);
        if($aliasChecked === true)
        {
            header("location: ../../user/registration.php?error=2&mail=".$_POST['mail_user']);
            exit();
        }elseif ($mailChecked === true) {
            header("location: ../../user/registration.php?error=3&alias=".$_POST['alias_user']);
            exit();
        }elseif($aliasChecked === true && $mailChecked === true){
            header("location: ../../user/registration.php?error=4");
            exit();
        }
        $idUser = 0;
        $db = new Connect();
        $newRegistration = new UserManager($db->getConnection());
        $passwordHash = password_hash($_POST['password_user'],PASSWORD_DEFAULT);
        $newRegistration->saveUser($idUser,$_POST['alias_user'],$_POST['mail_user'],$passwordHash,NULL,$_POST['city_user']);
    }
}
else
{
    header("location: ../../user/registration.php?error=6");
    exit();
}
header("location: /index.php?info=1");
exit();
