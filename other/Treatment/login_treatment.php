<?php
session_start();
require_once '../Class/Connect.php';
require_once '../Class/UserApp.php';
require_once '../Class/Authentification.php';
$database = new Connect();
$db = $database->getConnection();
$authentification =  new  Authentication($db);
if(isset($_POST['mail_user']) && $_POST['mail_user'] !="" && isset($_POST['password_user']) && $_POST['password_user'] !="")
{
    if($authentification->login($_POST['mail_user'],$_POST['password_user'],$_SESSION['token'] === $_POST['token']))
    {
        $userConnected =  new UserApp($db);
        $user = $userConnected->getUserByMail($_POST['mail_user']);
        if($user['user_archive'] == true)
        {
            header("location: /index.php?error=3"); 
            exit();
        }
        $userStatus = $user['id_user_status'];
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_status'] = $userStatus;
        $_SESSION['user_member'] = $user['member_user'];
        $userStatus === 1 ? $_SESSION['session-token'] = 'admin' : $_SESSION['session-token'] = 'connected';

        switch ($userStatus) {
            case '1':
                header("location: ../../admin/dashboardAdmin.php"); 
                break;
            case '2':
                header("location: ../../user/receptionUser.php"); 
                break;
            default:
                header("location: ../../index.php"); 
                break;
        }
    }else{
        header("location: ../../index.php?error=1"); 
    }
} else {
    header("location: ../../index.php?error=2");   
}
?>

