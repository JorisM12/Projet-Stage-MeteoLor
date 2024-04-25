<?php
//header("location: ../../user/buildPage.html");
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/ObservationsManager.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";

$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$data = $observationManager->selectAllObservations();
$observationTypes = $observationManager->selectAllObservationTypes();
$jsonData = json_encode($data);
$token = token();
$_SESSION['token'] = $token;
$userManager = new UserManager($db->getConnection());
$userData = $userManager->selectOneUser($_SESSION['user_id']);
$displayError = false;
$displayConfirm = false;
$displayForm = false;
$displayMap = false;
// Remplissage du formulaire
$descriptionForm = '';
$typeObsForm = '';
$locationForm = '';

if(isset($_GET['error']) && $_GET['error']== 1)
{
    $displayError = true;
    $descriptionForm = $_GET['description_observation'];
    $typeObsForm = $_GET['type_observation'];
    $locationForm = $_GET['location_observation'];
}
if(isset($_GET['send']) && $_GET['send']== 1)
{
    $displayConfirm = true;
}
if(isset($_GET['mobile-view']) && $_GET['mobile-view']== 'form')
{
   $displayForm = true;
}
elseif(isset($_GET['mobile-view']) &&  $_GET['mobile-view']== 'map')
{
    $displayMap = true;
}
if($userData['member_user'] != NULL)
{
    $imgObs = "";
}
else
{
    $imgObs = "img-obs-hidden";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/receptionUserMobile.css">
    <link rel="icon" type="image/x-icon" href="../../style/images/logo_mini.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <title>Accueil</title> 
</head>
<body>
    <header>
        <div class="container-logo">
            <a href="#"><img src="../../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <img src="../../style/images/logo_mini.png" alt="logo" id="logoMobile">
        <h2>Bienvenue <?=$userData['alias_user'];?> !</h2>
        <a id="btn-exit" href="../receptionUser.php"></a>
    </header>
    <main>
        <?php
            if($displayError == true)
            {
        ?>
        <script>
            window.alert("La saisie du formulaire est incorrecte");
        </script>
        <?php
            }
        ?>
        <?php
            if($displayConfirm == true)
            {
        ?>
        <script>
            window.alert("Observation envoyée!");
        </script>
        <?php
            }
        ?>
        <section id="desktop-view-choice">
            <section class="container-type-1">
                <h3>Poster une observation</h3>
                <form action="../../other/Treatment/observationTreatment.php" method="post" enctype="multipart/form-data">
                    <div id="liste-mobile-view">
                        <select class="input-type-1" name="type_observation" id="type_observation">
                        <option value="" selected>Choisir un phénomène</option>
                            <?php
                                foreach ($observationTypes as $type ) {   
                            ?>
                            <option value=<?= $type['id_type_observation'];?> <?=$typeObsForm != '' ? 'selected':'';?>><?=$type['name_observation_type'];?></option>
                            <?php
                                }
                            ?>
                        </select>                               
                    </div>
                    <div>
                        <label for="description_observation">Description:</label>
                        <input class="input-type-1" type="text" name="description_observation" value=<?=$descriptionForm;?>>
                        <label for="location_observation">Localisation: (ville et code postal)</label>
                        <input class="input-type-1"  id='cityName' type="text" name="location_observation" value=<?=$locationForm;?>>
                        <div id="suggestions"></div>
                        <label for="image_observation" class=<?=$imgObs;?>>Joindre une image:</label>
                        <input class="input-type-1 <?=$imgObs;?>" type="file" name="image_observation">
                    </div>
                    <input type="hidden" name="token" value=<?=$token;?>>
                    <input type="hidden" name="id_user" value=<?=$_SESSION['user_id'];?>>
                    <button class="button-type-1" type="submit">ENVOYER</button>
                </form>
                <a href="../../other/Treatment/deleteLastObservation.php" id="delete-obs" class="button-type-2">Supprimer ma dernière observation</a>
            </section>
        </section>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>  
</body>
<script src="../../script/script-city-suggestion.js"></script>
</html>