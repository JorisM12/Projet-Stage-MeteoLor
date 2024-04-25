<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/ObservationsManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
$token = token();
$_SESSION['token'] = $token;
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$allObservations = $observationManager->selectAllObservationsByUser($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/pastObservation.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Mes observations passées</title>  
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
                         <li><img src=<?=$memberStatus['pictogramme'];?> alt="statut adhérent" title=<?=$memberStatus['member title'];?> class="picto"></li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> <img id="btn-logout" src="../style/images/login.png" alt=""></a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><img src="../style/images/g.png" alt="statut adhérent" title="Adhérent"></li>
            </ul>
            <div id="log-out">
                <a href="../other/Functions/logout.php" title="Se déconnecter"> <img src="../style/images/login.png" alt=""></a>
            </div>
        </nav>
        <h2 class="title-type-1">MES OBSVERVATIONS PASSÉES</h2>
    </header>
    <main>
    <div class="container-type-2 windowDeleteConfirm">
        <p>
            Voulez-vous vraimer supprimer ?
        </p>
        <form action="#" method="post" id="formAction">
            <input type="hidden" value="true" name="delete">
            <input type="hidden" value=<?=$token;?> name="token">
            <div class="button-type-3">NON</div>
            <button class="button-type-4" type="submit" >OUI</button>
        </form>
    </div>
        <section class="container-type-1">
            <table>
                <thead>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Heure
                        </th>
                        <th>
                            Lieux
                        </th>
                        <th>
                            Type d'observation
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Photo
                        </th>
                        <th>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($allObservations as $observation) {
                    ?>
                    <tr>
                        <td>
                            <?=htmlspecialchars($observation['date']);;?>
                        </td>
                        <td>
                            <?=htmlspecialchars($observation['hour']);;?>
                        </td>
                        <td>
                            <?=htmlspecialchars($observation['location_observation']);?>
                        </td>
                        <td>
                            <?php
                                echo $observationManager->selectOneObservationType($observation['id_type_observation'])['name_observation_type'];

                            ?>
                        </td>
                        <td>
                            <?=htmlspecialchars($observation['description_observation']);?>
                            
                        </td>
                        <td>
                            <a href=<?=htmlspecialchars($observation['link_picture_observation']);?> target="_blank" title="voir l'image"><img src="../style/images/search.png" alt="pictogramme"></a>
                        </td>
                        <td>
                            <a id="<?=$observation['id_observation'];?>" class='btn-delete' href="../other/Treatment/observationTreatment.php?id=<?=htmlspecialchars($observation['id_observation']);?>&delete=true" title="Supprimer l'observation"><img src="../style/images/close.png" alt="pictogramme"></a>  
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script src="../script/script-burger-menu.js"></script>
<script src="../script/script-window-delete-confirm.js"></script>
</html>