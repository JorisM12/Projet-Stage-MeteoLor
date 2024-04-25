<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/ObservationsManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
$token = token();
$_SESSION['token'] = $token;
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$allObservations = $observationManager->selectAllObservations();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/pastObservation.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Gestion des observations</title>  
</head>
<body>
<header>
        <div id="header-mobile-view">
            <a href="../admin/dashboardAdmin.php"><img src="../style/images/logo_mini.png" alt="logo"></a>
            <div id="burger-menu"> 
            </div>
            <div class="bloc-burger-menu">
                <nav>
                    <img src="../style/images/x.png" alt="fermer le menu" id="btn-close-menu">
                    <ul>
                        <li><a href="../admin/userList.php" title="Liste des utilisateurs">Liste des utilisateurs</a></li>
                        <li><a href="../admin/observationsList.php" title="Liste des observations">Liste des observations</a></li>
                        <li><a href="../admin/stationsList.php" title="Liste des stations">Liste des stations</a></li>
                        <li><a href="#" title="Mon compte">Mon compte</a></li>
                        <li>Administrateur</li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> <img id="btn-logout" src="../style/images/login.png" alt=""></a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../admin/dashboardAdmin.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../admin/userList.php" title="Liste des utilisateurs">Liste des utilisateurs</a></li>
                <li><a href="../admin/observationsList.php" title="Liste des observations">Liste des observations</a></li>
                <li><a href="../admin/stationsList.php" title="Liste des stations">Liste des stations</a></li>
                <li><a href="#" title="Mon compte"></a>Mon compte</li>
                <li>Vous êtes Administrateur</li>
            </ul>
            <div id="log-out">
                <a href="../other/Functions/logout.php" title="Se déconnecter"> <img src="../style/images/login.png" alt=""></a>
            </div>
        </nav>
        <h2 class="title-type-1">Gestion des observations</h2>
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
                            Utilisateur
                        </th>
                        <th>
                            Date et heure 
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
                            <?=htmlspecialchars($observation['alias_user']);;?>
                        </td>
                        <td>
                            <?=htmlspecialchars($observation['date'].' '.$observation['hour']);;?>
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
