<?php
session_start();
require_once './other/Functions/Token.php';
$_SESSION['token'] = token();
$messageView = 0;
if(isset($_GET['error']) && ($_GET['error'] === '1' || $_GET['error'] === '2'|| $_GET['error'] === '3')) 
{
    $messageView = 1;
    if($_GET['error'] === '1')
    {
        $error="Erreur dans les identifiants de connexion";
    }elseif ($_GET['error'] === '2') {
        $error="Erreur de saisie";
    }elseif ($_GET['error'] === '3') {
        $error="Votre compte est déactivé, veuillez contacter l'association pour le récuperer";
    }
}
if(isset($_GET['info']) && ($_GET['info'] === '1' || $_GET['info'] === '2'))
{
    $messageView = 2;
    if($_GET['info'] === '2') 
    {
        $message = "Mot de passe actualisé !";
    }
    else
    {
        $message = "Inscription réussie !  Veuillez vous connecter";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/logIn.css">
    <link rel="icon" type="image/x-icon" href="./style/images/logo_mini.ico">
    <title>Connexion</title>
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
    <?php
    if($messageView === 2) {
        ?>
        <div id="bloc-error"  class="container-type-2 info">
            <p><?=$message;?></p>
        </div>
    <?php
    }
    ?>
    <main>
        <div>
            <p class="text-type-1">
                Bienvenue sur l'espace personnel ! Veuillez vous connecter ou <a href="./user/registration.php" title="Créer un compte">créer un compte</a>
            </p>
        </div>
        <form action="./other/Treatment/login_treatment.php" method="POST">
            <label class="text-type-1" for="mail_user">E-mail</label>
            <input class="input-type-1" type="text" name="mail_user">
            <label class="text-type-1" for="password_user">Mot de passe</label>
            <input class="input-type-1" type="password" name="password_user">
            <input type="hidden" value="<?=$token;?>" name="token">
            <button class="button-type-1" type="submit">CONNEXION</button>
        </form>
        <div>
            <p>
                <a href="./user/forgotPwd.php" title="Mot de passe oublié"> <span>mot de passe oublié ?</span></a>
            </p>
        </div>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
</html>