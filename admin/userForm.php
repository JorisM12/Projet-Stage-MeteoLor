<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
$token = token();
$_SESSION['token'] = $token;
$messageView = 0;
if(!isset($_GET['id']) && empty($_GET['id']))
{
    header("location: ../../admin/userList.php");
}
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$user = $userManager->selectOneUser($_GET['id']);
$userAllStatus = $userManager->getAllUserStatus();
var_dump($user);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/registration.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <title>Inscription</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="https://meteolor.fr"><img src="../style/images/logo_mini.png" alt="logo"></a>
        </div>
        <div class="container-logo">
            <a href="https://meteolor.fr"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <h2 class="title-type-1">Modification d'un utilisateur</h2>
    </header>
    </header>
    <?php
    if($messageView === 1) {
            ?>
        <div id="bloc-error"  class="container-type-2">
            <p><?=$error;?></p>
        </div>
        <?php
        }
    ?>
    <main>
        <div>
            <p class="text-type-1">
                Modifications de l'utilisateur:
            </p>
        </div>
        <form action="../other/Treatment/registration_treatment.php" method="POST">
            <label for="alias_user">Date d'adhésion</label>
            <input class="input-type-1" type="date" name="member_user" value=<?= $user['member_user']!= NULL ? $user['member_user'] : '' ;?>>
            <label for="id_user_status">Rôle</label>
            <select name="id_user_status" class="input-type-1">
                <?php
                    foreach ($userAllStatus as $status => $value) {
                        ?>
                        <option value=<?=$value['id_user_status'];?> <?=$user['id_user_status'] === $value['id_user_status'] ? 'selected' : '' ;?>>  <?=$value['name_user_status'];?></option >
                    <?php
                     }
                    ?>
            </select>
            <label for="mail_user">Archiver l'utilisateur</label>
            <div>
                <input type="radio" name="archive_user" value=0 <?= $user['user_archive'] == false ? 'checked' : '';?>>
                <label for="level_alert">Non</label>
            </div>
            <div>
                <input type="radio" name="archive_user" value=1 <?= $user['user_archive'] == true ? 'checked' : '';?>>
                <label for="archive_user">Oui</label>
            </div>
            <input type="hidden" name="token" value=<?=$token;?>>
            <button class="button-type-1" type="submit"> ENVOYER</button>
            <a class="button-type-2 "href="https://www.meteolor.fr" title="retour sur le site">Revenir à la liste</a>
        </form>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
</html>