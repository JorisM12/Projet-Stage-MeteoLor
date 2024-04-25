<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
$token = token();
$_SESSION['token'] = $token;
$messageView = 0;
if(isset($_GET['error']) && ($_GET['error'] === '1' || $_GET['error'] === '2' || $_GET['error'] === '3' || $_GET['error'] === '4' || $_GET['error'] === '5'  || $_GET['error'] === '6')) 
{
    $messageView = 1;
    switch ($_GET['error']) {
        case '1':
            $error = "Mot de passe non identique";
            break;
        case '2':
            $error = "Alias déjà utilisé";
            break;
        case '3':
            $error = "Mail déjà utilisé";
            break;
        case '4':
            $error = "Mail et alias déjà utilisés";
            break;
        case '5':
            $error = "L'alias doit faire moins de 50 caractères";
            break;
        case '6':
            $error = "Une erreur est survenue";
            break;
        default:
            $error = "Une erreur est survenue";
            break;
    }
}
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
        <h2 class="title-type-1">INSCRIPTION</h2>
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
                Veuillez renseigner les champs ci-dessous
            </p>
        </div>
        <form action="../other/Treatment/registration_treatment.php" method="POST">
            <label for="alias_user">Pseudonyme</label>
            <input class="input-type-1" type="text" name="alias_user" value = <?= isset($_GET['alias']) ? $_GET['alias'] : "" ;?>>
            <label for="mail_user">E-mail</label>
            <input class="input-type-1" type="text" name="mail_user" value = <?= isset($_GET['mail']) ? $_GET['mail'] : "" ;?>>
            <label for="password_user">Mot de passe</label>
            <input class="input-type-1" type="password" name="password_user">
            <label for="password_user_confirm">Confirmation de mot de passe</label>
            <input class="input-type-1" type="password" name="password_user_confirm">
            <label for="password_user">Votre ville (suivie du code postal)</label>
            <input class="input-type-1" type="text" name="city_user";?>
            <label for="protect">Veuillez répondre à cette question en toute lettre: <img src="../style/images/img-protect.png" alt="" id="img-protect"></label>
            <img src="../style/images/img-protect.png" alt="" id="img-protect">
            <input class="input-type-1" type="text" id="last-input" name="protect";?>
            <input type="hidden" name="token" value=<?=$token;?>>
            <button class="button-type-1" type="submit"> ENVOYER</button>
            <a class="button-type-2 "href="https://perso.meteolor.fr" title="retour sur le site">Revenir sur le site</a>
        </form>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
</html>