<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/protectAdmin.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/UserManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
var_dump($_POST);
if(!empty($_POST['mail_user']) && !empty($_POST['id_user_status']) && !empty($_POST['token']) && !empty($_POST['id_user']) && $_POST['token'] === $_SESSION['token']) 
{
    $userArchive = 0;
    if(!empty($_POST['delete']) && $_POST['delete'])
    {
        $userArchive = 1;
    }
    if($_POST['member_user'] === "")
    {
        $memberUser = NULL;
    }
    else 
    {
        $memberUser = $_POST['member_user'];
    }
    var_dump($memberUser);
    $database = new Connect();
    $db = $database->getConnection();
    $userManager = new UserManager($db);
    $sql = "UPDATE `users_app` SET `mail_user`=:mail_user, `member_user`=:member_user, `id_user_status`=:id_user_status, `user_archive`=:user_archive WHERE id_user = :id_user";
    $stmt = $db->prepare($sql);
    $stmt->execute([
    'mail_user' => $_POST['mail_user'],
    'id_user_status' => $_POST['id_user_status'],
    'member_user' => $memberUser,
    'id_user' => $_POST['id_user'],
    'user_archive'=>$userArchive
]);
}
header("location: ../userList.php");
