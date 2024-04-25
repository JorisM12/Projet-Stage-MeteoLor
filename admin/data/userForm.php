<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/protectAdmin.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/UserManager.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
if(empty($_GET['id']))
{
    header("location: ../userList.php");
}
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$userStatus = $userManager->getAllUserStatus();
$userStatusSelected = $userManager->getUserStatusById($_GET['id']);
$userSelected = $userManager->selectOneUser($_GET['id']);
$token = token();
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/css/registration.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <title>Inscription</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="https://meteolor.fr"><img src="../../style/images/logo_mini.png" alt="logo"></a>
        </div>
        <div class="container-logo">
            <a href="https://meteolor.fr"><img src="../../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <h2 class="title-type-1">MODIFIER UN UTILISATEUR</h2>
    </header>
    <main>
        <div>
            <p class="text-type-1">
                Champs modifiables
            </p>
        </div>
        <form action="../data/userFormTreatment.php" method="POST">
            <label for="mail_user">E-mail</label>
            <input class="input-type-1" type="text" name="mail_user" value = <?=$userSelected['mail_user'] ;?>>
            <label for="member_user"> Adhesion</label>
            <input class="input-type-1" type="date" name="member_user" value=<?=$userSelected['member_user'] ;?>>
            <label>Statut</label>
            <select name="id_user_status" class="input-type-1">
                <?php foreach ($userStatus as $status) {
                ?>
                    <option value=<?=$status['id_user_status'];?> <?= $userSelected['id_user_status'] === $status['id_user_status'] ? 'selected': '';?>><?=$status['name_user_status'];?></option>
                <?php
                }
                ?>
            </select>
            <div>
                 <input type="checkbox" name="delete"/>
                 <label for="delete">Supprimer cet utilisateur</label>
            </div>
            <input type="hidden" name="token" value=<?=$token;?>>
            <input type="hidden" name="id_user" value=<?=$_GET['id'];?>>
            <button class="button-type-1" type="submit">MODIFIER</button>
            <a class="button-type-2 "href="../userList.php" title="retour sur le site">Revenir à la liste</a>
        </form>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
</html>