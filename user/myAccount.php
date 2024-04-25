<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Functions/Functions.php';
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$userData = $userManager->selectOneUser($_SESSION['user_id']);
$token = token();
$_SESSION['token'] = $token;
$memberStatus =  memberVerification($_SESSION['user_member']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/myAccount.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Mon compte</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo_mini.png" alt="logo"></a>
            <div id="burger-menu">
                
            </div>
            <div class="bloc-burger-menu">
                <nav>
                    <img src="../style/images/x.png" alt="fermer le menu" id="btn-close-menu">
                    <ul>
                        <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                        <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                        <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                        <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                        <li><?=$memberStatus['pictogramme'];?></li>
                        <li><a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><?=$memberStatus['pictogramme'];?></li>
                <li><a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a></li>
            </ul>
        </nav>
        <h2 class="title-type-1">MON COMPTE</h2>
    </header>
    <main>
        <section class="container-type-1">
            <form action="../other/Treatment/accountTreatment.php" method="POST" class="container-type-2">
                <div>
                    <h3>Informations personnelles</h3>
                    <label for="email_user">E-mail</label>
                    <input class="input-type-1" type="text" name="email_user" value=<?=htmlspecialchars($userData['mail_user']);?>>
                    <label for="pseudo_user">Pseudonyme</label>
                    <input class="input-type-1" type="text" name="pseudo_user" value=<?=htmlspecialchars($userData['alias_user']);?>>
                    <label>Mot de passe</label>
                    <a class="input-type-1" href="forgotPwd.php"changer de mot de passe">Changer de mot de passe</a>
                    <label for="membership_user">Date d'adhésion</label>
                    <input class="input-type-1" type="date" name="member_user" value=<?=htmlspecialchars($userData['member_user']);?> disabled>
                    <input class="input-type-1" type="hidden" name="member_user" value=<?=htmlspecialchars($userData['member_user']);?>>
                    <a class="button-type-2" href="http://meteolorapp/user/dashboardUser.php" title="Annuler les modifications">ANNULER</a>
                </div>
                <div>
                    <h3>Préférences</h3>
                    <label for="city_user">Ville favorite avec le code postal</label>
                    <input class="input-type-1" type="text" name="city_user" id="cityName" value="<?=htmlspecialchars($userData['city_user']);?>" placeholder="Nom de ville et le code postal">
                    <label for="station_user_1">Station météo favorite</label>
                    <input  class="input-type-1" type="text" name="station_user_1" disabled  value="Valleroy(54)">
                    <label for="station_user_snow">Météo des neiges</label>
                    <input class="input-type-1" type="text" disabled name="station_user_snow" value="Hautes-Vosges">
                    <input type="hidden" name="token" value=<?=$token;?>>
                    <input type="hidden" name="password_user" value=<?=$userData['password_user'];?>>
                    <input type="hidden" name="user_id" value=<?=$_SESSION['user_id']?>>
                    <button class="button-type-1" type="submit">ENREGISTRER</button>
                </div>
            </form>
            <div id="suggestions" ></div>
        </section>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script src="../script/script-burger-menu.js"></script>
<script src="../script/script-city-suggestion.js"></script>
</html>

