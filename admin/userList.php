<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/User.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
$db = new Connect();
$userManager = new UserManager($db->getConnection());
$allUsers = $userManager->selectAllUsers();
$users = [];
foreach ($allUsers as $user ) {
    $user = new User($user['id_user'],$user['alias_user'],$user['mail_user'],$user['password_user'],$user['member_user'],$user['registration_date_user'],$user['city_user'],$user['id_user_status'],$user['user_archive']);
    $users[] = $user;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/userList.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <title>Gestion des utilisateurs</title>  
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
        <h2 class="title-type-1">Gestion des utilisateurs</h2>
    </header>
    <main>
        <aside class="container-type-2">
            <div>
                <h3>Détails de l'utilisateur</h3>
            </div>
            <form action="#" method="post">
                <div>
                    <p>
                        N°Utilisateur
                    </p>
                    <div>
                        <p id="#areaId">
                            45
                        </p>
                    </div>
                </div>
                <div>
                    <p>
                        Pseudonyme
                    </p>
                    <div>
                        <p id="areaAlias">
                            
                        </p>
                    </div>
                </div>
                <div>
                    <p>
                        Date d'inscription
                    </p>
                    <div>
                        <p id="areaSubscription">
                            
                        </p>
                    </div>
                </div>
                <div>
                    <p>
                        Lieu favoris
                    </p>
                    <div>
                        <p id="areaCity">
                            
                        </p>
                    </div>
                </div>
                <div>
                    <p>
                        Date d'adhésion
                    </p>
                    <div>
                        <p id="areaMember">
                            
                        </p>
                    </div>
                </div>
                <label for="member_user">Nouvelle adhésion</label>
                <input type="date" name="member_user ">
                <input type="hidden" name="token" value="">
                <button class="button-type-1" type="submit">MODIFIER</button>
                <a id="closePopUp" class="button-type-2" href="#" title="retour">RETOUR</a>
            </form>
        </aside>
        <script>
            const areaWindow =  document.querySelector('aside');
            const areaId = document.querySelector('#areaId');
            const areaAlias = document.querySelector('#areaAlias');
            const areaSubscription = document.querySelector('#areaSubscription');
            const areaCity = document.querySelector('#areaCity');
            const areaMember = document.querySelector('#areaMember');
            document.querySelectorAll('#closePopUp').forEach(btn => {btn.addEventListener('click',()=> {popUp.style.setProperty("display","none");})})
        </script>
        <section>
            <table>
                <thead>
                    <th>
                        N°Utilisateur
                    </th>
                    <th>
                        Pseudonyme
                    </th>
                    <th>
                        Date d'inscription
                    </th>
                    <th>
                        Date d'adhesion 
                    </th>
                    <th>
                        Adresse e-mail
                    </th>
                    <th>
                        Statut de l'utilisateur
                    </th>
                    <th>
                    </th>
                </thead>
                <tbody>
                    <?php
                        foreach ($users as $row) {
                    ?>   
                    <tr>
                        <td>
                            <?=htmlspecialchars($row->getIdUser());?>
                        </td>
                        <td>
                            <?=htmlspecialchars($row->getUserAlias());?>
                        </td>
                        <td>
                            <?=htmlspecialchars(date('d/m/Y',strtotime( $row->getUserRegistration())));?>
                        </td>
                        <td>
                            <?=htmlspecialchars($row->getUserMember());?>
                        </td>
                        <td>
                            <?=htmlspecialchars($row->getUserMail());?>
                        </td>
                        <td>
                            <?=htmlspecialchars($row->getUserArchive()) ? 'Utilisateur désactivé'  : 'Utilisateur actif' ;?>
                        </td>
                        <td>
                            <a id="viewInfo" href="./data/userForm.php?id=<?=htmlspecialchars($row->getIdUser());?>" title="Traiter"><img src="../style/images/search.png" alt="pictogramme"></a>
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
</html>